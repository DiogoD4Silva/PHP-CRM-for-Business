<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER', 'simpleadmin');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));

require_once BASE_PATH . '/lib/MysqliDb/MysqliDb.php';
require_once BASE_PATH . '/helpers/helpers.php';

/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
 */

define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "crm");

$conn = mysqli_connect(/*Host*/"localhost",/*User*/  "root",/*Password*/  "",/*DB*/  "crm");

function getDbInstance()
{
	return new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}
