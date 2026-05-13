<?php
require_once __DIR__ . '/vendor/autoload.php';

$mongoUri = getenv('MONGODB_URI') ?: 'mongodb://usuari:12345@mongodb:27017';

$client = new MongoDB\Client($mongoUri);
$db = $client->selectDatabase('logs_app');
$coleccioLogs = $db->selectCollection('logs');