<?php

class ModelExtensionModuleSwShippingInformation extends Model
{
    /**
     * @param array $data
     * @return int
     */
    public function create(array $data = []): int
    {
        $names = '`id`';
        $values = 'NULL';
        unset($data['id']);

        foreach ($data as $key => $value) {
            $names .= ",`{$key}`";
            $values .= ",'{$value}'";
        }

        if ($this->db->query("
            INSERT INTO `sw_shipping_information`({$names})
            VALUES($values);
        ")) {
            return $this->db->query("
                SELECT
                    LAST_INSERT_ID() as LAST_INSERT_ID;
            ")->rows[0]['LAST_INSERT_ID'];
        } else {
            return 0;
        }
    }

    /**
     * @param array $data
     * @return int
     */
    public function update(array $data = []): int
    {
        $update = '';
        $i = 1;
        foreach ($data as $key => $value) {
            $update .= '`' . $key . '`' . '=' . '\'' . $value . '\'' . (count($data) == $i ? '' : ',');
            $i++;
        }

        return $this->db->query("
            UPDATE
                `sw_shipping_information`
            SET
                {$update}
            WHERE
                `sw_shipping_information`.`id` = {$data['id']}; 
        ");
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(array $data = []): int
    {
        return $this->db->query("
            DELETE
            FROM
                sw_shipping_information
            WHERE
                `sw_shipping_information`.`id` = {$data['id']} 
        ");
    }

    /**
     * @return array
     */
    public function get(): array
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
    public function install(): void
    {
        $this->load->language('extension/module/sw_shipping_information');

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `sw_shipping_information`(
                `id` INT NOT NULL AUTO_INCREMENT COMMENT '{$this->language->get('db_fields')["id"]}',
                `name` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$this->language->get('db_fields')["name"]}',
                `description` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$this->language->get('db_fields')["description"]}',
                `photo` TEXT COLLATE utf8mb4_general_ci NOT NULL COMMENT '{$this->language->get('db_fields')["photo"]}',
                `price` TEXT NOT NULL COMMENT '{$this->language->get('db_fields')["price"]}',
                `payment` TEXT NOT NULL COMMENT '{$this->language->get('db_fields')["payment"]}',
                `sort` INT NOT NULL COMMENT '{$this->language->get('db_fields')["sort"]}',
                PRIMARY KEY(`id`)
            ) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '{$this->language->get('heading_title')}';
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