<?php

abstract class ModelExtensionModuleSwModule extends Model
{
    /**
     * @var string
     */
    protected string $module_name;

    /**
     * @var array|string[]
     */
    protected array $data_base;

    /**
     * @param array $data
     * @param string $table_name
     * @return int
     */
    public function create(array $data = [], string $table_name = ''): int
    {
        $names = '`id`';
        $values = 'NULL';
        unset($data['id']);

        foreach ($data as $key => $value) {
            $names .= ",`{$key}`";
            $values .= ",'{$value}'";
        }

        if ($this->db->query("
            INSERT INTO `{$table_name}`({$names})
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
     * @param string $table_name
     * @return int
     */
    public function update(array $data = [], string $table_name = ''): int
    {
        $update = '';
        $i = 1;
        foreach ($data as $key => $value) {
            $update .= '`' . $key . '`' . '=' . '\'' . $value . '\'' . (count($data) == $i ? '' : ',');
            $i++;
        }

        return $this->db->query("
            UPDATE
                `{$table_name}`
            SET
                {$update}
            WHERE
                `{$this->module_name}`.`id` = {$data['id']}; 
        ");
    }

    /**
     * @param array $data
     * @param string $table_name
     * @return int
     */
    public function delete(array $data = [], string $table_name = ''): int
    {
        return $this->db->query("
            DELETE
            FROM
                {$table_name}
            WHERE
                `{$this->module_name}`.`id` = {$data['id']} 
        ");
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $response = [];

        foreach ($this->data_base as $data_base) {
            $query = $this->db->query("
                SHOW FULL COLUMNS
                FROM
                    {$data_base};
            ");

            foreach ($query->rows as $value) {
                $response[$data_base]['info'][$value['Field']] = $value;
            }

            $query = $this->db->query("
                SELECT
                    *
                FROM
                    `{$data_base}`
                ORDER BY
                    `sort`
                ASC 
            ");

            $response[$data_base]['data'] = $query->rows;
        }

        return $response;
    }

    /**
     * @return void
     */
     abstract public function install(): void;

    /**
     * @return void
     */
    public function uninstall(): void
    {
        foreach ($this->data_base as $data_base) {
            $this->db->query("
                DROP TABLE IF EXISTS
                    `{$data_base}`
            ");
        }
    }
}