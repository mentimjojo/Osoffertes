<!DOCTYPE html>
<?php

/////////////////////////////////
// INDEX STANDAARD ZAKEN BEGIN //
////////////////////////////////

// include //
include("inc/config.php");

// Page system

if($_GET['page'] == ""){
    define("PAGE_INCLUDE", "pages/home.php");
    $page = "Bestaat niet";
} else {


    if(SEO == 0){
        $page_name = $page_system_info['page_name'];
    } elseif(SEO == 1){
        $page_name = $page_system_info['page_seo'];
    }

switch($_GET['page']) {

	     case $page_name:
	     define("PAGE_INCLUDE", "pages/".$page_system_info['page_link'].".".$page_system_info['page_ext']);
	     define("PAGE_TOEGANG", $page_system_info['page_toegang']);
	     break;
        echo "Test<br/>";

   }
}

if($_GET['page'] == ""){
    define("PAGE_INCLUDE", "pages/error/bestaat_niet.php");
}

    // Geen toegang system
    if(PAGE_TOEGANG == 1){
	if(TOEGANG > 0){ } ELSE { 
	header('Refresh: 0; url=index.php?page=geen_toegang');
	}
	}

    // Page namen
    $page_system3 = mysqli_query($con, 'SELECT * FROM ' . TBL_STANDAARD_PAGES . ' WHERE page_name = "'.$_GET['page'].'"');
    $page_system_info3 = mysqli_fetch_array($page_system3);
    $page = $page_system_info3['page_titel'];


// ONDERHOUD CHECK BEGIN //
if(TOEGANG < "6"){ // Staff enzo
if(ONDERHOUD == 1){
include("pages/error/onderhoud.php");
} else {
// ONDERHOUD CHECK EINDE //

// LOGIN CHECKS BEGIN //
if($_COOKIE['USER_SYSTEM'] == ""){
include("pages/login.php");
} else {

$cookie_test_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_REGISTRATIE . ' WHERE cookie_hash = "'.$_COOKIE['USER_SYSTEM'].'"');
$cookie_test_tel = mysqli_num_rows($cookie_test_sql);
if($cookie_test_tel == 0){
header('Refresh: 0; url=index.php?page=uitloggen');
}
// LOGIN CHECKS EINDE // 

/////////////////////////////////
// HIER GEWOON STANDAARD BEGIN //
include("inc/theme/theme.php");//
// HIER GEWOON STANDAARD EINDE //
/////////////////////////////////


}
}
} else {
include("inc/theme/theme.php"); // staff erin
}

// Log page system begin //
if(LOGS_VISIT_ON == 1){
mysqli_query($con,'INSERT INTO ' . TBL_LOGS_PAGES_VISIT . ' (klantnummer, datum, page, ip) 
VALUES ("'.KLANTNUMMER.'", "'.DATUM.'", "'.$page.'", "'.$_SERVER['REMOTE_ADDR'].'")');
}
// Log page system einde //
?>


