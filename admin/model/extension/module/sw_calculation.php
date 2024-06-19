<?php
include_once "sw_module.php";

class ModelExtensionModuleSwCalculation extends ModelExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_calculation";

    /**
     * @var array|string[]
     */
    protected array $data_base = ['sw_calculation', 'sw_calculation_telegram'];

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return void
     */
    public function install(): void
    {
        $this->load->language("extension/module/{$this->module_name}");
        $db = $this->language->get('db');

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `sw_calculation`(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['sw_calculation']['id']}',
                `placeholder` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_calculation']['placeholder']}',
                `minlength` INT NOT NULL COMMENT '{$db['sw_calculation']['minlength']}',
                `maxlength` INT NOT NULL COMMENT '{$db['sw_calculation']['maxlength']}',
                `required` BOOLEAN NOT NULL COMMENT '{$db['sw_calculation']['required']}',
                `type` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_calculation']['type']}',
                `mask` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_calculation']['mask']}',
                `sort` INT NOT NULL COMMENT '{$db['sw_calculation']['sort']}',
                PRIMARY KEY(`id`)
            ) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['sw_calculation']['comment']}';
        ");

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `sw_calculation_telegram`(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['sw_calculation_telegram']['id']}',
                `token` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_calculation_telegram']['token']}',
                `chat_id` INT NOT NULL COMMENT '{$db['sw_calculation_telegram']['chat_id']}',
                `sort` INT NOT NULL COMMENT '{$db['sw_calculation_telegram']['sort']}',
                PRIMARY KEY(`id`)
            ) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['sw_calculation_telegram']['comment']}';
        ");
    }
}