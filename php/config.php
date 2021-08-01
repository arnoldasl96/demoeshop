<?php

define("DB_HOST", 'localhost');
define("DB_DATABASE", 'demoeshop');
define("DB_USERNAME", 'root');
define("DB_PASSWORD", '');

date_default_timezone_set("Europe/Vilnius");
error_reporting(0);
session_set_cookie_params(['samesite' => 'Strict']);
?>