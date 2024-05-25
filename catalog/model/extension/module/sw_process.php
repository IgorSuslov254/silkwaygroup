<?php
include_once "sw_module.php";

class ModelExtensionModuleSwProcess extends ModelExtensionModuleSwModule
{
    public function __construct($registry)
    {
        parent::__construct($registry);
        $this->module_name = 'sw_process';
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return [];
    }
}