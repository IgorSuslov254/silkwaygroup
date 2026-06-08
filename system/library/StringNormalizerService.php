<?php

namespace Silkway\System\Library;

class StringNormalizerService
{
    /**
     * @param string $value
     * @return string
     */
    public static function toSeoKeyword(string $value): string
    {
        $value = mb_strtolower($value);

        $value = preg_replace('/[^a-zа-яё0-9\s]+/iu', ' ', $value);

        $value = preg_replace('/\s+/u', '_', trim($value));

        return trim($value, '_');
    }
}