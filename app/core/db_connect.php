<?php

// connection data
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBNAME", "polygon_db");
    define("DBHOST", "localhost");
} else {
    // online defines
}

$dsn = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
$con = new PDO($dsn,DBUSER,DBPASS);

// try {
//   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully"; 
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }