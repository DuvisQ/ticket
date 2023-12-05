<?php

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNOM);
  
if ($dbconn->connect_error) {
  die("ERROR: No se puede conectar al servidor: " . $conn->connect_error);
} 