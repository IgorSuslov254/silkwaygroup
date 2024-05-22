<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwBenefit extends ControllerExtensionModuleSwModule
{
    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->url_module = 'extension/module/sw_benefit';
        $this->module_name = 'sw_benefit';
    }
}