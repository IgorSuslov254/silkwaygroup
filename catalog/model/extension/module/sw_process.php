<?php
include_once "sw_module.php";

class ModelExtensionModuleSwProcess extends ModelExtensionModuleSwModule
{
    /**
     * @var array
     */
    protected array $tables_name = ['sw_process'];

    public function __construct($registry)
    {
        parent::__construct($registry);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return [];
    }
}