<?php

/////////////////////////////////////////
// CONFIG BEGIN INCLUDE IN ELK BESTAND //
////////////////////////////////////////

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

// Include important //
include("db/database.php"); // Db connectie
include("db/tabellen.php"); // Db tabellen
include("db/querys.php");   // Db querys
include("functions/datum.php"); // Datum
include("functions/defines.php"); // Defines
include("functions/dirs.php"); // Dirs function
include("functions/mailer.php"); // Mail function
include("lang/nl/index.php");  // Taal

// Include theme site
include("theme/footer.php"); // Footer
include("theme/style.php"); // Style
include("theme/links_menu.php"); // Menus
include("theme/balk.php"); // Menu(Balk boven)
?>