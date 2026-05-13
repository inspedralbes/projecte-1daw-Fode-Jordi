<?php
require 'vendor/autoload.php';

$clientMongo = new MongoDB\Client("mongodb://usuari:12345@mongodb:27017");
$collection = $clientMongo->logs_app->logs;
