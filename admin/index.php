<?php
//Include
include_once("inc/config.php");

// Login check
if($_COOKIE['ADMIN_SYSTEM'] == ""){
    include_once("login.php");
} else {
    // Ingelogd
}
?>