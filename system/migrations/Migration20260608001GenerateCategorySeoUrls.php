<?php

namespace Silkway\System\Migrations;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR);

// Autoloader
if (is_file(__DIR__ . '/../../../storage/vendor/autoload.php')) {
    require_once(__DIR__ . '/../../../storage/vendor/autoload.php');
}

use Silkway\System\Library\StringNormalizerService;

class Migration20260608001GenerateCategorySeoUrls extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        $categories = $this->db->query("
            SELECT
                `c`.`category_id`,
                `cd`.`language_id`,
                `cd`.`name`
            FROM
                `oc_category` `c`
            INNER JOIN `oc_category_description` `cd` ON
                `cd`.`category_id` = `c`.`category_id`
            LEFT JOIN `oc_seo_url` `su` ON
                `su`.`query` = CONCAT('category_id=', `c`.`category_id`) AND `su`.`language_id` = `cd`.`language_id`
            WHERE
                `su`.`keyword` IS NULL
        ")->rows;

        $seoUrlsArray = $this->db->query("
            SELECT
                LOWER(
                    CONCAT(
                        `store_id`,
                        '-',
                        `language_id`,
                        '-',
                        `keyword`
                    )
                ) AS `seo_url`
            FROM
                `oc_seo_url`
            WHERE
                `query` LIKE '%category_id%'
        ")->rows;

        $seoUrls = [];
        foreach ($seoUrlsArray as $value) {
            $seoUrls[] = $value['seo_url'];
        }

        $insertRows = [];

        foreach ($categories as $category) {
            $keyword = StringNormalizerService::toSeoKeyword($category['name']);

            if (!$keyword) {
                continue;
            }

            $seoUrl = '0-' . (int)$category['language_id'] . '-' . $this->db->escape($keyword);

            if (in_array($seoUrl, $seoUrls, true)) {
                $keyword .= '-' . (int)$category['category_id'];
                $seoUrl = '0-' . (int)$category['language_id'] . '-' . $this->db->escape($keyword);
            }

            $seoUrls[] = $seoUrl;

            $insertRows[] = sprintf(
                "(0, %d, 'category_id=%d', '%s')",
                (int)$category['language_id'],
                (int)$category['category_id'],
                $this->db->escape($keyword)
            );
        }

        if (!empty($insertRows)) {
            $query = $this->db->query("
                INSERT INTO oc_seo_url
                (
                    `store_id`,
                    `language_id`,
                    `query`,
                    `keyword`
                )
                VALUES
                " . implode(',', $insertRows)
            );

            if ($query) {
                var_dump('Миграция успешно выполнена');
            }
        } else {
            var_dump('Все SEO_URL заданы');
        }
    }

    /**
     * @return void
     */
    public function down(): void
    {
        var_dump('Данная миграция не откатывается');
    }
}

$action = strtolower($argv[1] ?? '');

$migration = new Migration20260608001GenerateCategorySeoUrls();

if (!method_exists($migration, $action)) {
    var_dump('Available actions: up, down');
    return;
}

$migration->{$action}();