<?php

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

if (! function_exists('nanoid')) {
    function nanoid(int $length = 21): string
    {
        $client = new \Hidehalo\Nanoid\Client();

        return $client->generateId($length, $mode = \Hidehalo\Nanoid\Client::MODE_DYNAMIC);
    }
}
