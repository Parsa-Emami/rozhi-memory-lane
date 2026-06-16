<?php

if (! function_exists('mb_split')) {
    function mb_split(string $pattern, string $string, int $limit = -1): array|false
    {
        $delimiter = '~';
        $regex = $delimiter.str_replace($delimiter, '\\'.$delimiter, $pattern).$delimiter.'u';
        return preg_split($regex, $string, $limit) ?: false;
    }
}

if (! function_exists('mb_strlen')) {
    function mb_strlen(string $string, ?string $encoding = null): int
    {
        if (strtolower((string) $encoding) === '8bit') {
            return strlen($string);
        }

        return preg_match_all('/./us', $string, $matches);
    }
}

if (! function_exists('mb_substr')) {
    function mb_substr(string $string, int $start, ?int $length = null, ?string $encoding = null): string
    {
        if (strtolower((string) $encoding) === '8bit') {
            return substr($string, $start, $length ?? strlen($string));
        }

        $chars = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
        if ($chars === false) {
            return substr($string, $start, $length ?? strlen($string));
        }

        return implode('', array_slice($chars, $start, $length));
    }
}

if (! function_exists('mb_strtolower')) {
    function mb_strtolower(string $string, ?string $encoding = null): string
    {
        return strtolower($string);
    }
}

if (! function_exists('mb_strtoupper')) {
    function mb_strtoupper(string $string, ?string $encoding = null): string
    {
        return strtoupper($string);
    }
}

if (! function_exists('mb_strpos')) {
    function mb_strpos(string $haystack, string $needle, int $offset = 0, ?string $encoding = null): int|false
    {
        return strpos($haystack, $needle, $offset);
    }
}
