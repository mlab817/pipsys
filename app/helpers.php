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

        return $client->generateId($length, $mode = \Hidehalo\Nanoid\Client::MODE_DYNAMIC);
    }
}

/**
 * Highlight the results of the search case-insensitive
 */
if (! function_exists('highlight_search')) {
    function highlight_search(string $text, string $q) {
        $highlighted = "<span class='search-result'>".$q."</span>";

        return str_ireplace($q, $highlighted, $text);
    }
}
