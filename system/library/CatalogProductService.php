<?php

namespace Silkway\System\Library;

use Proxy;

class CatalogProductService
{
    private Proxy $model;

    /**
     * @param Proxy $model
     */
    public function __construct(Proxy $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $productId
     * @return int
     */
    public function getCategoryForProductId(int $productId): int
    {
        $categories = $this->model->getCategories($productId) ?? [];
        return $categories[0]['category_id'] ?? 0;
    }
}