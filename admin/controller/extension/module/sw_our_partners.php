<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwOurPartners extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_our_partners";

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }

    public function cud():void {}

    /**
     * @return void
     */
    public function install(): void {}

    /**
     * @return void
     */
    public function uninstall(): void {}
}