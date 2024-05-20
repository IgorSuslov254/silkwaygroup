<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwShippingInformation extends ControllerExtensionModuleSwModule
{
    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->url_module = 'extension/module/sw_shipping_information';
        $this->module_name = 'sw_shipping_information';
    }
}