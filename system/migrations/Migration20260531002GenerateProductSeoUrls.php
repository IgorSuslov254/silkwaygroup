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

class Migration20260531002GenerateProductSeoUrls extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        $products = $this->db->query("
            SELECT
                `p`.`product_id`,
                `pd`.`language_id`,
                `pd`.`name`
            FROM
                `oc_product` `p`
            INNER JOIN `oc_product_description` `pd` ON
                `pd`.`product_id` = `p`.`product_id`
            LEFT JOIN `oc_seo_url` `su` ON
                `su`.`query` = CONCAT('product_id=', `p`.`product_id`)
            WHERE
                `su`.`seo_url_id` IS NULL
            ORDER BY
                `p`.`product_id`
            DESC
        ")->rows;

        $insertRows = $seoUrls = [];

        foreach ($products as $product) {
            $keyword = StringNormalizerService::toSeoKeyword($product['name']);

            if (!$keyword) {
                continue;
            }

            $seoUrl = '0-' . (int)$product['language_id'] . $this->db->escape($keyword);

            if (in_array($seoUrl, $seoUrls, true)) {
                $keyword .= '-' . (int)$product['product_id'];
                $seoUrl = '0-' . (int)$product['language_id'] . $this->db->escape($keyword);
            }

            $seoUrls[] = $seoUrl;

            $insertRows[] = sprintf(
                "(0, %d, 'product_id=%d', '%s')",
                (int)$product['language_id'],
                (int)$product['product_id'],
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
$migration = new Migration20260531002GenerateProductSeoUrls();

if (!method_exists($migration, $action)) {
    var_dump('Available actions: up, down');
    return;
}

$migration->{$action}();