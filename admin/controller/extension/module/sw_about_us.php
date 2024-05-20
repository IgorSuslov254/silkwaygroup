<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwAboutUs extends ControllerExtensionModuleSwModule
{
    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->url_module = 'extension/module/sw_about_us';
        $this->module_name = 'sw_about_us';
    }
}