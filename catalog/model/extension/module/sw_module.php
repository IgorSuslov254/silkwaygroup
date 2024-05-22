<?php

abstract class ModelExtensionModuleSwModule extends Model
{
    /**
     * @var string
     */
    protected string $module_name;

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->db->query("
            SELECT
                *
            FROM
                `{$this->module_name}`
            ORDER BY
                `sort`
            ASC 
        ")->rows;
    }
}