<?php
include_once "sw_module.php";
include_once DIR_SYSTEM . "library/SwTelegram.php";

class ControllerExtensionModuleSwTelegram extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_telegram";

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->links['send_telegram_link'] = $this->url->link("extension/module/{$this->module_name}/sendTelegram", '', true);

        if (empty($this->document->getScripts()['https://unpkg.com/imask'])) $this->document->addScript('https://unpkg.com/imask');
    }

    /**
     * @return void
     */
    public function sendTelegram()
    {
        $res = '';
        $this->load->language("extension/module/{$this->module_name}");

        try {
            $this->load->model("extension/module/{$this->module_name}");
            $data = $this->{"model_extension_module_{$this->module_name}"}->get();

            if (empty($data['sw_telegram_settings']) || empty($this->request->post)) throw new Exception($this->language->get('no_data_found'));
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

        foreach ($data['sw_telegram_settings'] as $sw_telegram_settings) {
            $telegram = new SwTelegram($sw_telegram_settings);

            $message = "<b>{$this->language->get('form_name')}</b>\r\n";
            foreach ($this->request->post as $name => $value) {
                $message .= "{$name} : <i>{$value}</i>\r\n";
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