<?php
include_once "sw_module.php";

class ModelExtensionModuleSwOurPartners extends ModelExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_our_partners";

    /**
     * @var array|string[]
     */
    protected array $data_base = ['sw_our_partners'];

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param array $data
     * @param string $table_name
     * @return int
     */
    public function create(array $data = [], string $table_name = ''): int
    {
        return 0;
    }

    /**
     * @param array $data
     * @param string $table_name
     * @return int
     */
    public function update(array $data = [], string $table_name = ''): int
    {
        return 0;
    }

    /**
     * @param array $data
     * @param string $table_name
     * @return int
     */
    public function delete(array $data = [], string $table_name = ''): int
    {
        return 0;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return [];
    }

    /**
     * @return void
     */
    public function install(): void {}

    /**
     * @return void
     */
    public function uninstall(): void {}
}