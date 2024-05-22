<?php
include_once "sw_module.php";

class ModelExtensionModuleSwServices extends ModelExtensionModuleSwModule
{
    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->module_name = 'sw_services';
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
            `name` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['name']}',
            `description` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['description']}',
            `sort` INT NOT NULL COMMENT '{$db['sort']}',
            PRIMARY KEY(`id`)
        ) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['comment']}';
        ");
    }
}