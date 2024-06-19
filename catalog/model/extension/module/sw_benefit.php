<?php
include_once "sw_module.php";

class ModelExtensionModuleSwBenefit extends ModelExtensionModuleSwModule
{
    /**
     * @var array
     */
    protected array $tables_name = ['sw_benefit'];

    public function __construct($registry)
    {
        parent::__construct($registry);
    }
}