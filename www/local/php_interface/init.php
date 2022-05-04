<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (is_readable($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/constants.php')) {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/constants.php';
}

if (is_readable($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/functions.php')) {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/functions.php';
}

if (is_readable($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/agent.php')) {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/agent.php';
}

if (is_readable($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/event_handlers.php')) {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/event_handlers.php';
}

define('IBLOCK_PRODUCTS', 2);
define('IBLOCK_VACANCIES', 4);