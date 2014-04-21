<?php
// Session
session_start();
ob_start();

// Security
$sessieids = mt_rand();
$securityid = sha1($sessieids);

// Titel site
$title = $lang_title;

// Taal
$settings_nieuws = $settingsgev['bericht_nieuws_nl'];
$news = "nl";
?>