<?php
define('DIRECTORY', '../API');
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', 'root');
define('DBNAME', 'triosolenergy');

global $config;

// $dateIni = new DateTime();
// $dateIni->setTimezone(new DateTimeZone('Europe/Istanbul'));
// $date = $dateIni->format('Y-m-d H:i:s');
// TODO: Tüm işlemler bittikten sonra $_SESSION silinecek.

$_SESSION['email'] = "alihan.acikgoz@gmail.com";

$config = [
    "home" => [
        "module" => "home",
        "method" => "home",
    ],
    "returnArray" => [
        "status" => false,
        "message" => "",
        "data" => [],
    ]
];