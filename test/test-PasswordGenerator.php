<?php
require_once("../PasswordGenerator.php");

$password = new PasswordGenerator();
echo "Password:" . $password->getPassword() . PHP_EOL;
echo "Password hash:" . $password->getPasswordHash() . PHP_EOL;
