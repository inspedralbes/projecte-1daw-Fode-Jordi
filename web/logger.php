<?php
require_once __DIR__ . '/connexio_mongo.php';

function registrarLog() {
    global $coleccioLogs;

    $log = [
        'url'        => $_SERVER['REQUEST_URI'],
        'metode'     => $_SERVER['REQUEST_METHOD'],
        'usuari'     => isset($_SESSION['usuari']) ? $_SESSION['usuari'] : null,
        'timestamp'  => new MongoDB\BSON\UTCDateTime(),
        'navegador'  => $_SERVER['HTTP_USER_AGENT'],
        'ip'         => $_SERVER['REMOTE_ADDR']
    ];

    $coleccioLogs->insertOne($log);
}

registrarLog();