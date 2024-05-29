<?php
include_once "sw_module.php";

class ModelExtensionModuleSwProcess extends ModelExtensionModuleSwModule
{
    /**
     * @var string
     */
    protected string $module_name = "sw_process";

    /**
     * @var array|string[]
     */
    protected array $data_base = ['sw_process'];

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param array $data
     * @return int
     */
    public function create(array $data = []): int
    {
        return 0;
    }

    /**
     * @param array $data
     * @return int
     */
    public function update(array $data = []): int
    {
        return 0;
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(array $data = []): int
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