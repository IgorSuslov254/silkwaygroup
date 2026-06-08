<?php

namespace Silkway\System\Library;

use Config;
class ConfigService
{
    private Config $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getLanguageId(): int
    {
        return (int)$this->config->get('config_language_id') ?? 0;
    }
}