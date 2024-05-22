<?php
include_once "sw_module.php";

class ModelExtensionModuleSwAboutUs extends ModelExtensionModuleSwModule
{
    public function __construct($registry)
    {
        parent::__construct($registry);
        $this->module_name = 'sw_about_us';
    }
}