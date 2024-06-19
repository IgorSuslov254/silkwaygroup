<?php

abstract class ModelExtensionModuleSwModule extends Model
{
    /**
     * @var string
     */
    protected array $tables_name;

    /**
     * @return array
     */
    public function get(): array
    {
        $res = [];

        foreach ($this->tables_name as $table_name) {
            $res[$table_name] = $this->db->query("
                SELECT
                    *
                FROM
                    `{$table_name}`
                ORDER BY
                    `sort`
                ASC 
            ")->rows;
        }

        return $res;
    }
}