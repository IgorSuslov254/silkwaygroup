<?php
include_once "sw_module.php";

class ModelExtensionModuleSwBenefit extends ModelExtensionModuleSwModule
{
    public function __construct($registry)
    {
        parent::__construct($registry);
        $this->module_name = 'sw_benefit';
    }
}