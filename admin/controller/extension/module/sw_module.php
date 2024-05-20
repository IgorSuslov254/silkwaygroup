<?php

abstract class ControllerExtensionModuleSwModule extends Controller
{
    /**
     * @var string
     */
    protected string $url_module;

    /**
     * @var string
     */
    protected string $module_name;

    /**
     * @var array
     */
    private array $data;

    /**
     * @return void
     */
    public function index(): void
    {
        $this->data = $this->load->language($this->url_module);
        $this->load->model($this->url_module);

        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->addScript("view/javascript/extension/module/sw_module.js");
        $this->document->addStyle("view/stylesheet/extension/module/sw_module.css");

        $this->data["status"] = $this->config->get("module_{$this->module_name}_status");
        $this->data['breadcrumbs'] = $this->getBreadCrumbs();
        $this->data['header'] = $this->load->controller('common/header');
        $this->data['column_left'] = $this->load->controller('common/column_left');
        $this->data['footer'] = $this->load->controller('common/footer');
        $this->data['sw_module'] = $this->{"model_extension_module_{$this->module_name}"}->get();
        $this->data['module_name'] = $this->module_name;

        $this->setLinks(['enable', 'cud']);

        $this->response->setOutput($this->load->view('extension/module/sw_module', $this->data));
    }

    /**
     * @param array $links
     * @return void
     */
    private function setLinks(array $links = []): void
    {
        foreach ($links as $link) {
            $this->data["{$link}_link"] = $this->url->link("{$this->url_module}/". $link .'&user_token=' . $this->session->data['user_token'], '', true);
        }
    }

    public function cud():void
    {
        $method = $this->request->post['method'];
        unset($this->request->post['method']);

        $this->load->language($this->url_module);
        $this->response->addHeader('Content-Type: application/json');

        try {
            $this->load->model($this->url_module);

            $res = $this->{"model_extension_module_{$this->module_name}"}->$method($this->request->post);

            if (!$res) throw new Exception("");
        } catch (Exception $e) {
            $this->response->setOutput(json_encode(
                ['response' => str_replace('$error', $this->language->get("{$method}_error") . $e->getMessage(), $this->language->get('alert_danger'))]
            ));
            return;
        }

        $this->response->setOutput(json_encode(
            [
                'response' => str_replace('$success', $this->language->get("{$method}_success"), $this->language->get('alert_success')),
                'id' => $res
            ]
        ));
    }

    /**
     * @return void
     */
    public function enable(): void
    {
        $this->load->language($this->url_module);
        $this->response->addHeader('Content-Type: application/json');

        try {
            $this->load->model('setting/setting');
            $this->model_setting_setting->editSetting("module_{$this->module_name}_status", $this->request->post);
        } catch (Exception $e) {
            $error = ($this->request->post["module_{$this->module_name}_status"]) ? $this->language->get('enable_error') . $e->getMessage() : $this->language->get('disabled_error') . $e->getMessage();
            $this->response->setOutput(json_encode(
                ['response' => str_replace('$error', $error, $this->language->get('alert_danger'))]
            ));
            return;
        }

        $success = ($this->request->post["module_{$this->module_name}_status"]) ? $this->language->get('enable_success') : $this->language->get('disabled_success');
        $this->response->setOutput(json_encode(
            ['response' => str_replace('$success', $success, $this->language->get('alert_success'))]
        ));
    }

    /**
     * @return array
     */
    private function getBreadCrumbs(): array
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
                'href' => $this->url->link($this->url_module, 'user_token=' . $this->session->data['user_token'], true)
            ]
        ];
    }

    /**
     * @return void
     */
    public function install(): void
    {
        $this->load->language($this->url_module);
        $this->document->setTitle($this->language->get('heading_title'));

        try {
            $this->load->model($this->url_module);
            $this->{"model_extension_module_{$this->module_name}"}->install();
        } catch (Exception $e) {
            $error = $this->language->get('install_error') . $e->getMessage();
            $this->log->write($error);

            $this->load->model('setting/extension');
            $this->load->model('setting/module');

            $this->model_setting_extension->uninstall('module', $this->module_name);
            $this->model_setting_module->deleteModulesByCode($this->module_name);

            die(str_replace('$error', $error, $this->language->get('alert_danger')));
        }
    }

    /**
     * @return void
     */
    public function uninstall(): void
    {
        try {
            $this->load->model($this->url_module);
            $this->{"model_extension_module_{$this->module_name}"}->uninstall();
        } catch (Exception $e) {
            $this->load->language($this->url_module);

            $error = $this->language->get('uninstall_error') . $e->getMessage();
            $this->log->write($error);

            $this->load->model('setting/extension');
            $this->load->model('user/user_group');

            $this->model_setting_extension->install('module', $this->module_name);
            $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', $this->url_module);
            $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', $this->url_module);

            die(str_replace('$error', $error, $this->language->get('alert_danger')));
        }
    }
}