<?php
include_once "sw_module.php";

class ControllerExtensionModuleSwCalc extends ControllerExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_calc";

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;

        $file_js = 'view/javascript/extension/module/sw_calc.js';
        if (file_exists($file_js)) {
            $this->document->addScript($file_js);
        }
    }

    /**
     * @return void
     */
    public function getRouteAndClothType()
    {
        $this->load->model("extension/module/{$this->module_name}");
        $data = $this->{"model_extension_module_{$this->module_name}"}->get();

        $res = [];
        $entities = ['sw_calc_route', 'sw_calc_cloth_type'];

        foreach ($entities as $entity) {
            $res[$entity][0] = [
                'id' => '',
                'name' => 'Выбере значение'
            ];

            foreach ($data[$entity]['data'] as $key => $value) {
                $res[$entity][$value['id']] = [
                    'id' => $value['id'],
                    'name' => $value['name']
                ];
            }
        }

        $this->response->setOutput(json_encode($res));
    }
}