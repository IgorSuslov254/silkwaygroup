<?php
class ControllerExtensionModuleSwShippingInformation extends Controller {

    public function index() {
        echo "Hello World!";
    }

    public function install(): void
    {
        try {
            $this->load->model('extension/module/sw_shipping_information');
            $this->model_extension_module_sw_shipping_information->install();
        } catch (Exception $e) {
            $error = "Ошибка при активации модуля sw-shipping-information: {$e->getMessage()}";
            $this->log->write($error);

            $this->load->model('setting/extension');
            $this->load->model('setting/module');

            $this->model_setting_extension->uninstall('module', 'sw_shipping_information');
            $this->model_setting_module->deleteModulesByCode('sw_shipping_information');

            die('
                <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i>'.$error.'
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            ');
        }
    }

    public function uninstall()
    {
        $this->load->model('extension/module/sw_shipping_information');
        $this->model_extension_module_sw_shipping_information->uninstall();

//        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module/' . $this->request->get['extension']);
//        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module/' . $this->request->get['extension']);
    }
}