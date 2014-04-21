<?php
//Include
include_once("inc/config.php");

// Login check
if($_COOKIE['ADMIN_SYSTEM'] == ""){
    // Login include
    include_once("login.php");
} else {
    // Ingelogd
    include_once("theme/index.php");
}
?>