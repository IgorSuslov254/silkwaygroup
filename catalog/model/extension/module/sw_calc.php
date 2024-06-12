<?php
include_once "sw_module.php";

class ModelExtensionModuleSwCalc extends ModelExtensionModuleSwModule
{
    /**
     * @var array
     */
    protected array $tables_name = ['sw_calc' , 'sw_calc_price', 'sw_calc_cloth_type', 'sw_calc_route'];

    public function __construct($registry)
    {
        parent::__construct($registry);
    }

    /**
     * @param int $id_sw_calc_route
     * @param int $id_sw_calc_cloth_type
     * @param int $density
     * @return int
     * @throws Exception
     */
    public function getDensityPrice(int $id_sw_calc_route, int $id_sw_calc_cloth_type, int $density): int
    {
        $res = $this->db->query("
            SELECT
                *
            FROM
                `sw_calc_price`
            WHERE
                `id_sw_calc_route` = {$id_sw_calc_route} AND `id_sw_calc_cloth_type` = {$id_sw_calc_cloth_type} AND `density_from` <= {$density} AND `density_to` > {$density};
        ")->rows;

        if (empty($res)) throw new Exception('no density price');

        return $res[0]['price'];
    }
}