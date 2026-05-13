<?php
require 'vendor/autoload.php';

$clientMongo = new MongoDB\Client("mongodb://admin:pass@mongodb:27017");
$collection = $clientMongo->logs_app->logs;
