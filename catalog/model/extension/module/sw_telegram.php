<?php
include_once "sw_module.php";

class ModelExtensionModuleSwTelegram extends ModelExtensionModuleSwModule
{
    /**
     * @var array
     */
    protected array $tables_name = ['sw_telegram', 'sw_telegram_settings'];

    public function __construct($registry)
    {
        parent::__construct($registry);
    }
}