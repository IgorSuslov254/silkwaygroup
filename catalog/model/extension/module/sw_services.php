<?php
include_once "sw_module.php";

class ModelExtensionModuleSwServices extends ModelExtensionModuleSwModule
{
    public function __construct($registry)
    {
        parent::__construct($registry);
        $this->module_name = 'sw_services';
    }
}