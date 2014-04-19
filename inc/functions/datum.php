<?php 
$standaard_datum = date_create();
$standaard_datum1 = date_timestamp_get($standaard_datum);
date_timestamp_set($standaard_datum,$standaard_datum1);
?>