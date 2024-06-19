<?php
abstract class ControllerExtensionModuleSwModule extends Controller
{
    /**
     * @var string
     */
    protected string $module_name;

    /**
     * @var array
     */
    protected array $links = [];

    /**
     * @return string
     */
    public function index(): string
    {
        $data['lang'] = $this->load->language("extension/module/{$this->module_name}");

        $file_css = "catalog/view/theme/silkway/stylesheet/extension/module/{$this->module_name}.css";
        $file_js = "catalog/view/javascript/extension/module/{$this->module_name}.js";

        if (file_exists($file_css)) {
            $this->document->addStyle($file_css);
        }
        if (file_exists($file_js)) {
            $this->document->addScript($file_js);
        }

        try {
            $this->load->model("extension/module/{$this->module_name}");
            $data['data'] = $this->{"model_extension_module_{$this->module_name}"}->get();
        } catch (exception $e) {
            die($this->language->get('get_error'));
        }

        if (!empty($this->links)) {
            $data["links"] = json_encode($this->links);
        }

        return $this->load->view("extension/module/{$this->module_name}", $data);
    }
}