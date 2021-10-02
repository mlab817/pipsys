<?php

/**
 * Generate gravatar given email
 */
if (! function_exists('generate_avatar')) {
    function generate_avatar(string $email) {
        // Trim leading and trailing whitespace from
        // an email address and force all characters
        // to lower case
        $address = strtolower( trim( $email ) );

        // Create an MD5 hash of the final string
        $hash = md5( $address );

        // Grab the actual image URL
        return 'https://www.gravatar.com/avatar/' . $hash;
    }
}

/**
 * Generate nano id with given length
 *
 * @params int $length
 * @returns string $nanoid
 */
if (! function_exists('nanoid')) {
    function nanoid(int $length = 21): string
    {
        $client = new \Hidehalo\Nanoid\Client();

        $client->formatedId('0123456789abcdefg');

        return $client->generateId($length, $mode = \Hidehalo\Nanoid\Client::MODE_DYNAMIC);
    }
}

/**
 * Highlight the results of the search case-insensitive
 */
if (! function_exists('highlight_search')) {
    function highlight_search(string $text, string $q): string
    {
        $highlighted = "<span class='search-result'>".$q."</span>";

        return str_ireplace($q, $highlighted, $text);
    }
}

if (! function_exists('slugify')) {
    function slugify($text): string
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $text)));
    }
}

if (! function_exists('shorten')) {
    function shorten(mixed $value, $short = true): string
    {
        if (! is_numeric($value)) {
            $value = 0;
        }

        $value = (float) $value;

        if ($value >= 10 ** 9) {
            return number_format($value / 10 ** 9, 2) . ($short ? ' B' : ' billion');
        }

        if ($value >= 10 ** 6) {
            return number_format($value / 10 ** 6, 2) . ($short ? ' M' : ' million');
        }

        if ($value >= 10 ** 3) {
            return number_format($value / 10 ** 3, 2) . ($short ? ' K' : ' thousand');
        }

        return (string) number_format($value, 2);
    }
}
