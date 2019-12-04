<?php
require_once("User.php");

$unUser = new User("bob@example.com");
$unUser->setPassword("Abcd12@:");
$unUser->setDateConnexion("20191204");

print_r($unUser->toArray());
