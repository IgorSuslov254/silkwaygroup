<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwServices extends ControllerExtensionModuleSwModule
{
    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->url_module = 'extension/module/sw_services';
        $this->module_name = 'sw_services';
    }
}