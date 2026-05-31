<?php

namespace Silkway\System\Migrations;

class Migration20260531001AddUniqueSeoUrlIndex extends Migration
{
    public function up(): void
    {
        $query = $this->db->query(
            "
            SELECT 1
            FROM oc_seo_url
            GROUP BY store_id, language_id, keyword
            HAVING COUNT(*) > 1
            LIMIT 1
        "
        );

        if ($query->num_rows) {
            throw new \RuntimeException(
                'Duplicate SEO keywords found in oc_seo_url'
            );
        }

        $this->db->query(
            "
            ALTER TABLE oc_seo_url
            DROP INDEX keyword
        "
        );

        $this->db->query(
            "
            ALTER TABLE oc_seo_url
            ADD UNIQUE KEY uk_store_language_keyword (
                store_id,
                language_id,
                keyword
            )
        "
        );
    }

    public function down(): void
    {
        $this->db->query(
            "
            ALTER TABLE oc_seo_url
            DROP INDEX uk_store_language_keyword
        "
        );

        $this->db->query(
            "
            ALTER TABLE oc_seo_url
            ADD KEY keyword (keyword)
        "
        );
    }
}
