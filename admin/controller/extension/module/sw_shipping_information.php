<?php
class ControllerExtensionModuleSwShippingInformation extends Controller {

    public function index() {
        $data = $this->load->language('extension/module/sw_shipping_information');
        $this->load->model('extension/module/sw_shipping_information');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['module_sw_shipping_information_status'] = $this->config->get('module_sw_shipping_information_status');
        $data['breadcrumbs'] = $this->GetBreadCrumbs();
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/sw_shipping_information', $data));
    }

    /**
     * @return array
     */
    private function GetBreadCrumbs(): array
    {
        return [
            [
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
            ],
            [
                'text' => $this->language->get('text_extension'),
                'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
            ],
            [
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/sw_shipping_information', 'user_token=' . $this->session->data['user_token'], true)
            ]
        ];
    }

    /**
     * @return void
     */
    public function install(): void
    {
        $this->load->language('extension/module/sw_shipping_information');
        $this->document->setTitle($this->language->get('heading_title'));

        try {
            $this->load->model('extension/module/sw_shipping_information');
            $this->model_extension_module_sw_shipping_information->install();
        } catch (Exception $e) {
            $error = $this->language->get('install_error') . $e->getMessage();
            $this->log->write($error);

            $this->load->model('setting/extension');
            $this->load->model('setting/module');

            $this->model_setting_extension->uninstall('module', 'sw_shipping_information');
            $this->model_setting_module->deleteModulesByCode('sw_shipping_information');

            die(str_replace('$error', $error, $this->language->get('alert_danger')));
        }
    }

    /**
     * @return void
     */
    public function uninstall(): void
    {
        try {
            $this->load->model('extension/module/sw_shipping_information');
            $this->model_extension_module_sw_shipping_information->uninstall();
        } catch (Exception $e) {
            $this->load->language('extension/module/sw_shipping_information');

            $error = $this->language->get('uninstall_error') . $e->getMessage();
            $this->log->write($error);

            $this->load->model('setting/extension');
            $this->load->model('user/user_group');

            $this->model_setting_extension->install('module', 'sw_shipping_information');
            $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module/sw_shipping_information');
            $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module/sw_shipping_information');

            die(str_replace('$error', $error, $this->language->get('alert_danger')));
        }
    }
}