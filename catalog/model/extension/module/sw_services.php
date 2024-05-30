<?php
include_once "sw_module.php";

class ModelExtensionModuleSwServices extends ModelExtensionModuleSwModule
{
    /**
     * @var array
     */
    protected array $tables_name = ['sw_services'];

    public function __construct($registry)
    {
        parent::__construct($registry);
    }
}