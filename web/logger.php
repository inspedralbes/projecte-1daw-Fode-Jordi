<?php
require_once 'connexio_mongo.php';

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$url = $_SERVER['REQUEST_URI'] ?? 'unknown';
$metode = $_SERVER['REQUEST_METHOD'] ?? 'unknown';
$navegador = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$timestamp = date("Y-m-d H:i:s");

$collection->insertOne([
    'url'       => $url,
    'metode'    => $metode,
    'usuari'    => null,
    'timestamp' => $timestamp,
    'navegador' => $navegador,
    'ip'        => $ip
]);
