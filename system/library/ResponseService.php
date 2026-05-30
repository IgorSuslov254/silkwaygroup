<?php

namespace Silkway\System\Library;

class ResponseService
{
    private object $response;

    /**
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * @param string $url
     * @return void
     */
    public function redirect301(string $url): void
    {
        if (!empty($url)) {
            if (headers_sent()) {
                return;
            }

            $this->response->redirect($url, 301);
        }
    }
}