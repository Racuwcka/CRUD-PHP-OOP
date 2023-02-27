<?php

include_once 'config/database.php';
include_once 'objects/city/City.php';
include_once 'objects/user/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->id = 1;
$user->name = 'Alex';
$user->city_id = 1;
$user->update();
print_r($user->name);