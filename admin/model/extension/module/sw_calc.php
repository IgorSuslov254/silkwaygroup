<?php
include_once "sw_module.php";

class ModelExtensionModuleSwCalc extends ModelExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_calc";

    /**
     * @var array|string[]
     */
    protected array $data_base = ['sw_calc' , 'sw_calc_price', 'sw_calc_cloth_type', 'sw_calc_route'];

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return void
     * @throws exception
     */
    public function install(): void
    {
        $this->load->language("extension/module/{$this->module_name}");
        $db = $this->language->get('db');

        $this->db->query("
            CREATE TABLE IF NOT EXISTS sw_calc_route(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['sw_calc_route']['id']}',
                `name` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_calc_route']['name']}',
                `sort` INT NOT NULL COMMENT '{$db['sw_calc_route']['sort']}',
                PRIMARY KEY(`id`)
            ) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['sw_calc_route']['comment']}'
        ");
        $this->isErrorCreateTable('sw_calc_route', $this->language->get('error_create_table'));

        $this->db->query("
            CREATE TABLE IF NOT EXISTS sw_calc_cloth_type(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['sw_calc_cloth_type']['id']}',
                `name` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_calc_cloth_type']['name']}',
                `sort` INT NOT NULL COMMENT '{$db['sw_calc_cloth_type']['sort']}',
                PRIMARY KEY(`id`)
            ) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['sw_calc_cloth_type']['comment']}'
        ");
        $this->isErrorCreateTable('sw_calc_cloth_type', $this->language->get('error_create_table'));

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `sw_calc`(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['sw_calc']['id']}',
                `text_banner` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_calc']['text_banner']}',
                `text_button` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_calc']['text_button']}',
                `photo` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_calc']['photo']}',
                `sort` INT NOT NULL COMMENT '{$db['sw_calc']['sort']}',
                PRIMARY KEY(`id`)
            ) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['sw_calc']['comment']}';
        ");
        $this->isErrorCreateTable('sw_calc', $this->language->get('error_create_table'));

        $this->db->query("
            CREATE TABLE IF NOT EXISTS sw_calc_price(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['sw_calc_price']['id']}',
                `id_sw_calc_route` INT UNIQUE NOT NULL COMMENT '{$db['sw_calc_price']['id_sw_calc_route']}',
                `id_sw_calc_cloth_type` INT UNIQUE NOT NULL COMMENT '{$db['sw_calc_price']['id_sw_calc_cloth_type']}',
                `price` INT NOT NULL COMMENT '{$db['sw_calc_price']['price']}',
                `sort` INT NOT NULL COMMENT '{$db['sw_calc_price']['sort']}',
                PRIMARY KEY(`id`),
                FOREIGN KEY(`id_sw_calc_cloth_type`) REFERENCES `sw_calc_cloth_type`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY(`id_sw_calc_route`) REFERENCES `sw_calc_route`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['sw_calc_price']['comment']}'
        ");
        $this->isErrorCreateTable('sw_calc_price', $this->language->get('error_create_table'));
    }

    /**
     * @param string $table
     * @param string $error_message
     * @return void
     * @throws exception
     */
    private function isErrorCreateTable(string $table, string $error_message): void
    {
        $query = $this->db->query("
            SHOW TABLES LIKE
                '{$table}';
        ");

        if (empty($query->rows)) {
            $this->db->query("
                DROP TABLE IF EXISTS
                    `sw_calc`,
                    `sw_calc_cloth_type`,
                    `sw_calc_price`,
                    `sw_calc_route`;
            ");

            throw new exception($error_message);
        }
    }
}