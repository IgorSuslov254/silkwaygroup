<?php

namespace Silkway\System\Library;

use DB;
class UrlService
{
    private DB $db;

    /**
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * @param string $query
     * @param int $language_id
     * @return string
     */
    public function getSeoUrl(string $query = '', int $language_id = 0): string
    {
        if (empty($query) || $language_id === 0) {
            return '';
        }

        $query = $this->db->query("
            SELECT
                `keyword`
            FROM
                `oc_seo_url`
            WHERE
                `language_id` = $language_id AND `query` = '$query'
        ");

        $keyword = '';
        if ($query->num_rows) {
            $keyword = $query->row['keyword'];
        }

        return $keyword;
    }
}