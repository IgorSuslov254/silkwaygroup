<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwProcess extends ControllerExtensionModuleSwModule
{
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->module_name = 'sw_process';
    }
}