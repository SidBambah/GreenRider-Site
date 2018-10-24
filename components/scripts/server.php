<?php

//Global Variables
$credentials = parse_ini_file("$root/credentials.ini", true);


DEFINE ('DB_USER', $credentials["database"]["database_username"]);
DEFINE ('DB_PSWD', $credentials["database"]["database_password"]);
DEFINE ('DB_HOST', $credentials["database"]["database_host"]);
DEFINE ('DB_NAME', $credentials["database"]["database_name"]);


//Connect to the GreenRider database

$db = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
