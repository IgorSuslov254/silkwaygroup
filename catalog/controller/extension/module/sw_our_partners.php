<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwOurPartners extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_our_partners";

    public function __construct($registry)
    {
        $this->registry = $registry;
    }
}