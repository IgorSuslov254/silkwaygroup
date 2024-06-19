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

        if (empty($this->document->getScripts()['https://unpkg.com/imask'])) $this->document->addScript('https://unpkg.com/imask');
    }

    public function sendTelegram()
    {
        $res = '';
        $this->load->language("extension/module/{$this->module_name}");

        try {
            $this->load->model("extension/module/{$this->module_name}");
            $data = $this->{"model_extension_module_{$this->module_name}"}->get();

            if (empty($data['sw_calculation_telegram']) || !is_array($data['sw_calculation_telegram'])) throw new Exception($this->language->get('no_data_found'));
        } catch (exception $e) {
            $this->log->write($e->getMessage());

            $this->response->setOutput(json_encode(
                [
                    'status' => 'error',
                    'result' => $e->getMessage()
                ]
            ));
            return;
        }

        $temp_sw_calculation = [];
        foreach ($data['sw_calculation'] as $sw_calculation) {
            $temp_sw_calculation[$sw_calculation['name']] = $sw_calculation;
        }
        $data['sw_calculation'] = $temp_sw_calculation;
        unset($temp_sw_calculation);

        foreach ($data['sw_calculation_telegram'] as $sw_calculation_telegram) {
            $telegram = new SwTelegram($sw_calculation_telegram);

            $message = "<b>{$this->language->get('form_name')}</b>\r\n";
            foreach ($this->request->post as $name => $value) {
                $message .= "{$data['sw_calculation'][$name]['placeholder']}: <i>{$value}</i>\r\n";
            }

            $res = $telegram->sendMessage($message);
            if (!$res) {
                $this->response->setOutput(json_encode(
                    [
                        'status' => 'error',
                        'result' => false
                    ]
                ));
                return;
            }
        }

        $this->response->setOutput(json_encode(
            [
                'status' => 'success',
                'result' => $res
            ]
        ));
    }
}