<?php

abstract class ModelExtensionModuleSwModule extends Model
{
    /**
     * @var string
     */
    protected string $module_name;

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
            INSERT INTO `{$this->module_name}`({$names})
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
                `{$this->module_name}`
            SET
                {$update}
            WHERE
                `{$this->module_name}`.`id` = {$data['id']}; 
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
                {$this->module_name}
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

        $query = $this->db->query("
            SHOW FULL COLUMNS
            FROM
                {$this->module_name};
        ");

        foreach ($query->rows as $value) {
            $response['info'][$value['Field']] = $value;
        }

        $query = $this->db->query("
            SELECT
                *
            FROM
                `{$this->module_name}`
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
     abstract public function install(): void;

    /**
     * @return void
     */
    public function uninstall(): void
    {
        $this->db->query("
            DROP TABLE IF EXISTS
                `{$this->module_name}`
        ");
    }
}