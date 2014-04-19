<?php

// DATABASE CONNECTIE OPENEN

//Gegevens
$database_host = "localhost";
$database_user = "tnijborg_panel";
$database_pass = "XS8EElpe";
$database_name = "tnijborg_panel";

//Connetie maken
$con = mysqli_connect($database_host,$database_user,$database_pass,$database_name);

//Error weergeven
if (mysqli_connect_errno())
  {
  echo "Niet gelukt om een connetie te maken met: " . mysqli_connect_error();
  }
  
mysqli_report(MYSQLI_REPORT_ERROR);

// DATABASE CONNECTIE SLUITE

?>

