<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwShippingInformation extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_shipping_information";

    public function __construct($registry)
    {
        $this->registry = $registry;
    }
}