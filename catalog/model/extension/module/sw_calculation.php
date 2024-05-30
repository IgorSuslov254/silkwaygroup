<?php
include_once "sw_module.php";

class ModelExtensionModuleSwCalculation extends ModelExtensionModuleSwModule
{
    /**
     * @var array
     */
    protected array $tables_name = ['sw_calculation', 'sw_calculation_telegram'];

    public function __construct($registry)
    {
        parent::__construct($registry);
    }
}