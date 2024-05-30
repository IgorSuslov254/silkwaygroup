<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwCalculation extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_calculation";

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->links['send_telegram_link'] = $this->url->link("extension/module/{$this->module_name}/sendTelegram", '', true);
    }

    public function sendTelegram()
    {
        $telegram = new SwTelegram();

        $this->response->setOutput(json_encode(
            [$this->request->post, $telegram->test()]
        ));
    }
}