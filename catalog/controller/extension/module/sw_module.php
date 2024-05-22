<?php
abstract class ControllerExtensionModuleSwModule extends Controller
{
    /**
     * @var string
     */
    protected string $module_name;

    /**
     * @return string
     */
    public function index(): string
    {
        $data['lang'] = $this->load->language("extension/module/{$this->module_name}");
        $this->document->addStyle("catalog/view/theme/silkway/stylesheet/extension/module/{$this->module_name}.css");

        try {
            $this->load->model("extension/module/{$this->module_name}");
            $data['data'] = $this->{"model_extension_module_{$this->module_name}"}->get();
        } catch (exception $e) {
            die($this->language->get('get_error'));
        }

        return $this->load->view("extension/module/{$this->module_name}", $data);
    }
}