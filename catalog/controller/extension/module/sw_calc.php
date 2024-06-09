<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwCalc extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_calc";

    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->links['calc'] = $this->url->link("extension/module/{$this->module_name}/calc", '', true);
    }

    /**
     * @return void
     */
    public function calc(): void
    {
        $this->response->addHeader('Content-Type: application/json');

        $density = $this->request->post['width'] * $this->request->post['length'] * $this->request->post['depth'] / 1000000 * $this->request->post['weight'];

        try {
            $this->load->model("extension/module/{$this->module_name}");
            $density_price = $this->{"model_extension_module_{$this->module_name}"}->getDensityPrice($this->request->post['route'], $this->request->post['cloth_type'], $density) ?? 0;

            if (!$density_price) throw new Exception('no density price');
        } catch (exception $e) {
            $this->response->setOutput(json_encode([
                'status' => 'error'
            ]));

            return;
        }

        $price = $density_price * $this->request->post['weight'];

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode([
            'status' => 'success',
            'price' => $price
        ]));
    }
}