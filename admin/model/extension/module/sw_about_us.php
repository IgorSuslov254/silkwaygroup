<?php
include_once "sw_module.php";

class ModelExtensionModuleSwAboutUs extends ModelExtensionModuleSwModule
{
    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->module_name = 'sw_about_us';
    }
}