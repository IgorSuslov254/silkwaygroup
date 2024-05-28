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
    protected array $db = ['sw_calculation', 'sw_calculation_telegram'];

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
            CREATE TABLE IF NOT EXISTS `{$this->module_name}`(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['id']}',
                `placeholder` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['placeholder']}',
                `minlength` INT NOT NULL COMMENT '{$db['minlength']}',
                `maxlength` INT NOT NULL COMMENT '{$db['maxlength']}',
                `required` BOOLEAN NOT NULL COMMENT '{$db['required']}',
                `type` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['type']}',
                `mask` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['mask']}',
                `sort` INT NOT NULL COMMENT '{$db['sort']}',
                PRIMARY KEY(`id`)
            ) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['comment']}';
        ");

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `{$this->module_name}`(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['id']}',
                `name` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['name']}',
                `description` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['description']}',
                `photo` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['photo']}',
                `price` TEXT NOT NULL COMMENT '{$db['price']}',
                `payment` TEXT NOT NULL COMMENT '{$db['payment']}',
                `sort` INT NOT NULL COMMENT '{$db['sort']}',
                PRIMARY KEY(`id`)
            ) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['comment']}';
        ");
    }
}