<?php

require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = new Dotenv\Dotenv(__dir__ . '/../');
$dotenv->load();

function env($key, $default = null) {
    $value = getenv($key);

    if ($value === false) {
        return value($default);
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'empty':
        case '(empty)':
            return '';
        case 'null':
        case '(null)':
            return;
    }

    if (strlen($value) > 1 && (substr($value, 0, 1) == '"') && (substr($value, -1, 1) == '"')) {
        return substr($value, 1, -1);
    }

    return $value;
}

function getInput($name, $default = null) {
    if (isset($_GET[$name])) {
        return $_GET[$name];
    } elseif (isset($_POST[$name])) {
        return $_POST[$name];
    } else {
        return $default;
    }
}
