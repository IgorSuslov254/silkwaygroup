<?php

namespace Silkway\System\Migrations;

use Exception;

// Autoloader
if (is_file(__DIR__ . '/../../../storage/vendor/autoload.php')) {
    require_once(__DIR__ . '/../../../storage/vendor/autoload.php');
}

class Migration20260531001AddUniqueSeoUrlIndex extends Migration
{
    public function up(): void
    {
        $query = $this->db->query("
            SELECT
                `seo_url_id`,
                `store_id`,
                `language_id`,
                `keyword`,
                COUNT(*) cnt
            FROM
                `oc_seo_url`
            GROUP BY
                `store_id`,
                `language_id`,
                `keyword`
            HAVING
                cnt > 1
            LIMIT 1;
        ");

        if ($query->num_rows) {
            $seoUrlId = $query->row['seo_url_id'];

            if (!$seoUrlId) {
                return;
            }

            $query = $this->db->query("
                DELETE
                FROM
                    `oc_seo_url`
                WHERE
                    `oc_seo_url`.`seo_url_id` = $seoUrlId
            ");

            if ($query) {
                $this->up();
            }

            return;
        }

        $query = $this->db->query("
            SHOW INDEX
            FROM
                `oc_seo_url`
        ");

        if ($query->num_rows) {
            $isIndex = false;

            foreach ($query->rows as $row) {
                if ($row['Key_name'] === 'keyword') {
                    $isIndex = true;
                }

                if ($row['Key_name'] === 'uk_store_language_keyword') {
                    var_dump('Миграция уже установлена!');
                    return;
                }
            }

            if ($isIndex) {
                $query = $this->db->query("
                    ALTER TABLE
                        oc_seo_url
                    DROP INDEX
                        keyword
                ");

                if (!$query) {
                    return;
                }
            }
        }

        $query = $this->db->query("
            ALTER TABLE
            oc_seo_url ADD UNIQUE KEY uk_store_language_keyword(
                store_id,
                language_id,
                keyword
            )
        ");

        if ($query) {
            var_dump('Миграция успешно выполнена!');
        } else {
            var_dump('Миграция не выполнена!');
        }
    }

    public function down(): void
    {
        $query = $this->db->query("
            SHOW INDEX
            FROM
                `oc_seo_url`
        ");

        if ($query->num_rows) {
            $ukStoreLanguageKeyword = $keyword = false;

            foreach ($query->rows as $row) {
                if ($row['Key_name'] === 'keyword') {
                    $keyword = true;
                }
                if ($row['Key_name'] === 'uk_store_language_keyword') {
                    $ukStoreLanguageKeyword = true;
                }
            }
        }

        if ($ukStoreLanguageKeyword) {
            $query = $this->db->query("
                ALTER TABLE
                    oc_seo_url
                DROP INDEX
                    uk_store_language_keyword
            ");

            if (!$query) {
                var_dump('Ошибка удаления индекса uk_store_language_keyword');
            }
        }

        if (!$keyword) {
            $query = $this->db->query("
                ALTER TABLE
                    oc_seo_url ADD KEY keyword(keyword)
            ");

            if (!$query) {
                var_dump('Ошибка добавления индекса keyword');
            }
        }

        var_dump('Миграция успешна откачена!');
    }
}

if (PHP_SAPI !== 'cli') {
    var_dump('CLI only');
    return;
}

$action = strtolower($argv[1] ?? '');
$migration = new Migration20260531001AddUniqueSeoUrlIndex();

if (!method_exists($migration, $action)) {
   var_dump('Available actions: up, down');
   return;
}

$migration->{$action}();