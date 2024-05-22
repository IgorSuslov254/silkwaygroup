<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwShippingInformation extends ControllerExtensionModuleSwModule
{
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->module_name = 'sw_shipping_information';
    }
}