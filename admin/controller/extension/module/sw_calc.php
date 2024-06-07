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
            foreach ($data[$entity]['data'] as $key => $value) {
                $res[$entity][$value['id']] = [
                    'id' => $value['id'],
                    'name' => $value['name']
                ];
            }
        }

        $this->response->setOutput(json_encode(
            [
                'response' => $res
            ]
        ));
    }

    /**
     * @return void
     */
    public function getSelect()
    {
        $this->load->model("extension/module/{$this->module_name}");
        $data = $this->{"model_extension_module_{$this->module_name}"}->get();

        $entity = $this->request->post['entity'];
        $entities = [
            'id_sw_calc_route' => [
                'choice' => 'sw_calc_route',
                'no_choice' =>'sw_calc_cloth_type'
            ],
            'id_sw_calc_cloth_type' => [
                'choice' => 'sw_calc_cloth_type',
                'no_choice' =>'sw_calc_route'
            ]
        ];

        $entity_count = [];
        foreach ($data['sw_calc_price']['data'] as $sw_calc_price) {
            if (empty($entity_count[$sw_calc_price[$entity]])) {
                $entity_count[$sw_calc_price[$entity]] = 1;
            } else {
                $entity_count[$sw_calc_price[$entity]] += 1;
            }
        }

        foreach ($data[$entities[$entity]['choice']]['data'] as $key => $value) {
            if (!empty($entity_count[$value['id']])) {
                if ($entity_count[$value['id']] == count($data[$entities[$entity]['no_choice']]['data'])) unset($data[$entities[$entity]['choice']]['data'][$key]);
            }
        }

        $res = [];
        foreach ($data[$entities[$entity]['choice']]['data'] as $key => $value) {
            $res[$value['id']] = $value;
        }

        $this->response->setOutput(json_encode(
            [
                'response' => $res
            ]
        ));
    }
}