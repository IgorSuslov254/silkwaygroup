<?php

namespace Silkway\System\Library;

class SeoRedirectService
{
    private UrlService $urlService;
    private RequestService $requestService;
    private ResponseService $responseService;
    private ConfigService $configService;
    private CatalogProductService $catalogProductService;

    /**
     * @param UrlService $urlService
     * @param RequestService $requestService
     * @param ResponseService $responseService
     * @param ConfigService $configService
     * @param CatalogProductService $catalogProductService
     */
    public function __construct(
        UrlService $urlService,
        RequestService $requestService,
        ResponseService $responseService,
        ConfigService $configService,
        CatalogProductService $catalogProductService
    ) {
        $this->urlService = $urlService;
        $this->requestService = $requestService;
        $this->responseService = $responseService;
        $this->configService = $configService;
        $this->catalogProductService = $catalogProductService;
    }

    /**
     * @return void
     */
    public function redirectProductToCanonical(): void
    {
        $languageId = $this->configService->getLanguageId();
        $categoryId = $this->requestService->getCategoryId();
        $productId = $this->requestService->getProductId();

        if ($categoryId === 0 && !empty($productId)) {
            $categoryId = $this->catalogProductService->getCategoryForProductId($productId);
        }

        $seoCategoryUrl = $this->urlService->getSeoUrl("category_id=$categoryId", $languageId);
        $seoProductUrl = $this->urlService->getSeoUrl("product_id=$productId", $languageId);

        $route = $this->requestService->get_Route_();

        $redirectUrl = '';
        if ($seoCategoryUrl && $seoProductUrl && ($seoCategoryUrl . '/' . $seoProductUrl !== $route)) {
            $redirectUrl = $this->requestService->getRedirectUrl($seoCategoryUrl . '/' . $seoProductUrl);
        }

        if ($seoCategoryUrl && !$seoProductUrl && ($seoCategoryUrl !== $route)) {
            $redirectUrl = $this->requestService->getRedirectUrl($seoCategoryUrl, ['product_id']);
        }

        if (!$seoCategoryUrl && $seoProductUrl && ($seoProductUrl !== $route)) {
            $redirectUrl = $this->requestService->getRedirectUrl($seoProductUrl);
        }

        if ($redirectUrl) {
            $this->responseService->redirect301($redirectUrl);
        }
    }

    /**
     * @return void
     */
    public function redirectCategoryCanonical(): void
    {
        $languageId = $this->configService->getLanguageId(); 
        $categoryId = $this->requestService->getCategoryId();
        $seoCategoryUrl = $this->urlService->getSeoUrl("category_id=$categoryId", $languageId);
        $route = $this->requestService->get_Route_();

        $redirectUrl = '';
        if ($seoCategoryUrl && ($seoCategoryUrl !== $route)) {
            $redirectUrl = $this->requestService->getRedirectUrl($seoCategoryUrl);
        }

        if ($redirectUrl) {
            $this->responseService->redirect301($redirectUrl);
        }
    }
}