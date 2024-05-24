<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwProcess extends ControllerExtensionModuleSwModule
{
    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->url_module = 'extension/module/sw_process';
        $this->module_name = 'sw_process';
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