<?php

namespace Silkway\System\Library;

use Request;

class RequestService
{
    private Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        if (empty($this->request->get['path'])) {
            return 0;
        }

        $parts = explode('_', (string)$this->request->get['path']);

        return (int)array_pop($parts);
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        if (empty($this->request->get['product_id'])) {
            return 0;
        }

        return (int)$this->request->get['product_id'];
    }

    /**
     * @return string
     */
    public function get_Route_(): string
    {
        return $this->request->get['_route_'] ?? '';
    }

    /**
     * @param string $request
     * @param array $saveParams
     * @return string
     */
    public function getRedirectUrl(string $request, array $saveParams = []): string
    {
        $scheme = $this->getScheme();
        $host = $this->getHost();
        $queryParams = $this->getQueryParams($saveParams);
        $separate = empty($queryParams) ? '' : '?';

        return $scheme . $host . '/' . $request . $separate . http_build_query($queryParams);
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return !empty($this->request->server['HTTPS']) ? 'https://' : 'http://';
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->request->server['HTTP_HOST'] ?? '';
    }

    /**
     * @param array $saveParams
     * @return array
     */
    public function getQueryParams(array $saveParams = []): array
    {
        $keysToRemove = ['_route_', 'path', 'product_id', 'route'];

        $keysToRemove = array_diff(
            $keysToRemove,
            $saveParams
        );

        return array_diff_key(
            $this->request->get,
            array_flip($keysToRemove)
        );
    }
}