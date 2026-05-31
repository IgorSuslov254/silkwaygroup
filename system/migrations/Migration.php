<?php

namespace Silkway\System\Migrations;

use Silkway\System\Bootstrap;
use Exception;

abstract class Migration
{
    protected \DB $db;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        Bootstrap::run();

        require_once(__DIR__ . '/../../config.php');
        require_once(DIR_SYSTEM . 'startup.php');
        require_once __DIR__ . '/../library/db.php';

        $this->db = new \DB(
            DB_DRIVER,
            DB_HOSTNAME,
            DB_USERNAME,
            DB_PASSWORD,
            DB_DATABASE,
            DB_PORT
        );
    }

    abstract public function up(): void;

    abstract public function down(): void;
}