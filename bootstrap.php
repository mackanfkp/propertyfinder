<?php
/**
 * Set include path
 */
set_include_path(
    get_include_path() . PATH_SEPARATOR .
    __DIR__
);

/**
 * Include autoload
 */
include __DIR__ . '/vendor/autoload.php';

