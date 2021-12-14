<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
// Polyfill for array_key_last() available from PHP 7.3
if (!function_exists('array_key_last')) {

    function array_key_last($array)
    {
        return array_slice(array_keys($array), -1)[0];
    }

}

// Polyfill for array_key_first() available from PHP 7.3
if (!function_exists('array_key_first')) {

    function array_key_first($array)
    {
        return array_slice(array_keys($array), 0)[0];
    }

}

// Polyfill for array_value_last() available from PHP 7.3
if (!function_exists('array_value_last')) {

    function array_value_last($array)
    {
        return $array[array_key_last($array)];
    }

}

// Polyfill for array_value_first() available from PHP 7.3
if (!function_exists('array_value_first')) {

    function array_value_first($array)
    {
        return $array[array_key_first($array)];
    }

}
