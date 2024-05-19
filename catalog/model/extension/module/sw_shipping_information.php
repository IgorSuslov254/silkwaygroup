<?php

class ModelExtensionModuleSwShippingInformation extends Model
{
    /**
     * @return array
     */
    public function get(): array
    {
        return $this->db->query("
            SELECT
                *
            FROM
                `sw_shipping_information`
            ORDER BY
                `sort`
            ASC 
        ")->rows;
    }
}