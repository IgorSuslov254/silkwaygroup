<?php
include_once "sw_module.php";

class ModelExtensionModuleSwTelegram extends ModelExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_telegram";

    /**
     * @var array|string[]
     */
    protected array $data_base = ['sw_telegram', 'sw_telegram_settings'];

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
            CREATE TABLE IF NOT EXISTS `sw_telegram`(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['sw_telegram']['id']}',
                `selector` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_telegram']['selector']}',
                `name` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_telegram']['name']}',
                `description` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_telegram']['description']}',
                `sort` INT NOT NULL COMMENT '{$db['sw_telegram']['sort']}',
                PRIMARY KEY(`id`)
            ) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['sw_telegram']['comment']}';
        ");

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `sw_telegram_settings`(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$db['sw_telegram_settings']['id']}',
                `token` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$db['sw_telegram_settings']['token']}',
                `chat_id` INT NOT NULL COMMENT '{$db['sw_telegram_settings']['chat_id']}',
                `sort` INT NOT NULL COMMENT '{$db['sw_telegram_settings']['sort']}',
                PRIMARY KEY(`id`)
            ) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$db['sw_telegram_settings']['comment']}';
        ");
    }
}