<?php
include_once "sw_module.php";

class ModelExtensionModuleSwOurPartners extends ModelExtensionModuleSwModule
{
    /**
     * @var array
     */
    protected array $tables_name = ['sw_our_partners'];

    public function __construct($registry)
    {
        parent::__construct($registry);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return [];
    }
}