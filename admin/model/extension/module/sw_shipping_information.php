<?php

class ModelExtensionModuleSwShippingInformation extends Model
{
    /**
     * @return array
     */
    public function getSwShippingInformation(): array
    {
        $response = [];

        $query = $this->db->query("
            SHOW FULL COLUMNS
            FROM
                sw_shipping_information;
        ");

        foreach ($query->rows as $value) {
            $response['info'][$value['Field']] = $value;
        }

        $query = $this->db->query("
            SELECT
                *
            FROM
                `sw_shipping_information`
            ORDER BY
                `sort`
            ASC 
        ");
        $response['data'] = $query->rows;

        return $response;
    }

    /**
     * @return void
     */
    public function updateSwShippingInformation(): void
    {
        $query = $this->db->query("
            UPDATE
                `sw_shipping_information`
            SET
                `name` = 'test',
                `description` = 'test'
            WHERE
                `sw_shipping_information`.`id` = 1;
        ");
    }

    /**
     * @return void
     */
    public function install(): void
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

        $this->db->query("
            INSERT INTO `sw_shipping_information`(
                `id`,
                `name`,
                `description`,
                `photo`,
                `price`,
                `payment`,
                `sort`
            )
            VALUES(
                NULL,
                'test',
                'test',
                'test',
                'test',
                'test',
                '1'
            );
        ");
    }

    /**
     * @return void
     */
    public function uninstall(): void
    {
        $this->db->query("
            DROP TABLE IF EXISTS
                `sw_shipping_information`
        ");
    }
}