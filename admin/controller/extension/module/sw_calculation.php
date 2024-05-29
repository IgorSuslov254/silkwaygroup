<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwCalculation extends ControllerExtensionModuleSwModule
{
    protected string $module_name = "sw_calculation";

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }
}