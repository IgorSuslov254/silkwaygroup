<?php
include_once "sw_module.php";

class ModelExtensionModuleSwAboutUs extends ModelExtensionModuleSwModule
{
    /**
     * @var array
     */
    protected array $tables_name = ['sw_about_us'];

    public function __construct($registry)
    {
        parent::__construct($registry);
    }
}