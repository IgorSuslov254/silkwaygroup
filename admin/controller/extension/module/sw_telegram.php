<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwTelegram extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_telegram";

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }
}