<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwAboutUs extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_about_us";

    public function __construct($registry)
    {
        $this->registry = $registry;
    }
}