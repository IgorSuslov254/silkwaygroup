<?php

class ModelExtensionModuleSwShippingInformation extends Model
{
    public function install()
    {
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `sw_shipping_information`(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT 'ИД',
                `name` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Название',
                `description` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Описание',
                `photo` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Фото',
                `price` TEXT NOT NULL COMMENT 'Цена и срок доставки',
                `payment` TEXT NOT NULL COMMENT 'Оплата',
                `sort` INT NOT NULL COMMENT 'Сортировка',
                PRIMARY KEY(`id`)
            ) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Информация о доставках';
        ");
    }

    public function uninstall()
    {
        $this->db->query("
            DROP TABLE IF EXISTS
                `sw_shipping_information`
        ");
    }
}