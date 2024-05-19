<?php
class ControllerExtensionModuleSwShippingInformation extends Controller
{
    /**
     * @return string
     */
    public function index(): string
    {
        $this->load->language('extension/module/sw_shipping_information');
        $this->document->addStyle('catalog/view/theme/silkway/stylesheet/extension/module/sw_shipping_information.css');

        try {
            $this->load->model('extension/module/sw_shipping_information');
            $data['sw_shipping_information'] = $this->model_extension_module_sw_shipping_information->get();
        } catch (exception $e) {
            die($this->language->get('get_error'));
        }

        return $this->load->view('extension/module/sw_shipping_information', $data);
    }
}