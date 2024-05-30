<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwProcess extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_process";

    public function __construct($registry)
    {
        $this->registry = $registry;
    }
}