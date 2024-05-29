<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwBenefit extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_benefit";

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }
}