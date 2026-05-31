<?php

namespace Silkway\System\Migrations;

abstract class Migration
{
    protected DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    abstract public function up(): void;
    abstract public function down(): void;
}