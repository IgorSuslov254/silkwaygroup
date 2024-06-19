<?php
include_once "sw_module.php";

class ModelExtensionModuleSwShippingInformation extends ModelExtensionModuleSwModule
{
    /**
     * @var array
     */
    protected array $tables_name = ['sw_shipping_information'];

    public function __construct($registry)
    {
        parent::__construct($registry);
    }
}