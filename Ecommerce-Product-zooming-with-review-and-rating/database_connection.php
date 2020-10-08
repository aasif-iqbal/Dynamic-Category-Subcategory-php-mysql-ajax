<?php

defined('DB_LOCALHOST') ? null : define('DB_LOCALHOST', 'localhost');
defined('DB_USERNAME') ? null : define('DB_USERNAME', 'root');
defined('DB_PASSWORD') ? null : define('DB_PASSWORD', '');
defined('DB_DATABASENAME') ? null : define('DB_DATABASENAME', 'Product_rating_db');

$connection = mysqli_connect(DB_LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);

/*
if ($connection) {
echo ("connected.");
} else {
echo ("Not connected.");
}
 */
?>