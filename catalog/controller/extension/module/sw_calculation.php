<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwCalculation extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_calculation";

    public function __construct($registry)
    {
        $this->registry = $registry;
    }
}