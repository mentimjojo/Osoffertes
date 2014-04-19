<?php  
/////////////////////////////////
// ALLE STANDAARD QUARYS  !!!! //
/////////////////////////////////

// Settings standaard
$settingsdb = 'SELECT * FROM ' . TBL_SETTINGS . ' WHERE id = 1';
$settingsdbeen = mysqli_query($con, $settingsdb) or die(mysqli_error());
$settingsgev = mysqli_fetch_array($settingsdbeen);

// Settings onderhoud
$settings_onderhoud_sql = 'SELECT * FROM ' . TBL_SETTINGS_ONDERHOUD . ' WHERE id = 1';
$settings_onderhoud_query = mysqli_query($con,$settings_onderhoud_sql)or die(mysqli_error());
$settings_onderhoud_info = mysqli_fetch_array($settings_onderhoud_query);

// Settings logs
$settings_logs_sql = 'SELECT * FROM ' . TBL_SETTINGS_LOGS . ' WHERE id = 1';
$settings_logs_query = mysqli_query($con,$settings_logs_sql)or die(mysqli_error());
$settings_logs_info = mysqli_fetch_array($settings_logs_query);

// Defines querys etc
$page_system_sql = 'SELECT * FROM ' . TBL_STANDAARD_PAGES . ' WHERE page_name = "'.$_GET['page'].'"';
$page_system_query = mysqli_query($con,$page_system_sql)or die(mysqli_error());
$page_system_sql1 = 'SELECT * FROM ' . TBL_STANDAARD_PAGES . ' WHERE page_seo = "'.$_GET['page'].'"';
$page_system_query1 = mysqli_query($con,$page_system_sql1)or die(mysqli_error());

if($settingsgev['site_seo'] == 1){
    $page_system_info = mysqli_fetch_array($page_system_query1);
} else {
    $page_system_info = mysqli_fetch_array($page_system_query);
}
$page_system = mysqli_query($con, 'SELECT * FROM ' . TBL_STANDAARD_PAGES . ' WHERE page_name = "'.$_GET['page'].'"');
$page_system2 = mysqli_query($con, 'SELECT * FROM ' . TBL_STANDAARD_PAGES . '');



if(isset($_COOKIE['USER_SYSTEM'])){

// Database checks registratie
$standaard_reg_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_REGISTRATIE . ' WHERE cookie_hash = "'.$_COOKIE['USER_SYSTEM'].'"';
$standaard_reg_query = mysqli_query($con,$standaard_reg_sql)or die(mysqli_error());
$standaard_reg_info = mysqli_fetch_array($standaard_reg_query);

// Database customers
$standaardgev = 'SELECT * FROM ' . TBL_CUSTOMERS . ' WHERE klantnummer = "'.$standaard_reg_info['klantnummer'].'"';
$gev1 = mysqli_query($con,$standaardgev)or die(mysqli_error());
$gev2 = mysqli_fetch_array($gev1);

$standaard_toegang_sql = 'SELECT * FROM ' . TBL_TOEGANG . ' WHERE klantnummer = "'.$gev2['klantnummer'].'"';
$standaard_toegang_query = mysqli_query($con,$standaard_toegang_sql)or die(mysqli_error());
$standaard_toegang_info = mysqli_fetch_array($standaard_toegang_query);

// Products voor tellen met hoger status dan 4
$standaard_product_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.$gev2['klantnummer'].'" AND verwijderd = 0 AND status >= 4';
$standaard_product_query = mysqli_query($con,$standaard_product_sql)or die(mysqli_error());
$standaard_product_info = mysqli_fetch_array($standaard_product_query);

// Standaard products
$standaard_products_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.$gev2['klantnummer'].'" AND verwijderd = 0';
$standaard_products_query = mysqli_query($con,$standaard_products_sql)or die(mysqli_error());
$standaard_products_info = mysqli_fetch_array($standaard_products_query);

// Factuur standaard
$standaard_factuur_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_FACTUREN . ' WHERE factuur_klantnummer = "'.$gev2['klantnummer'].'" AND factuur_delete = 0';
$standaard_factuur_query = mysqli_query($con,$standaard_factuur_sql)or die(mysqli_error());
$standaard_factuur_info = mysqli_fetch_array($standaard_factuur_query);

// Factuur voor tellen
$standaard_facturen_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_FACTUREN . ' WHERE factuur_klantnummer = "'.$gev2['klantnummer'].'" AND factuur_delete = 0 AND factuur_status >= 1';
$standaard_facturen_query = mysqli_query($con,$standaard_facturen_sql)or die(mysqli_error());

// Factuur voor tellen
$standaard_tickets_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_SUPPORT_TICKETS . ' WHERE klantnummer = "'.$gev2['klantnummer'].'" AND ticket_verwijderd = 0 AND ticket_status = 0';
$standaard_tickets_query = mysqli_query($con,$standaard_tickets_sql)or die(mysqli_error());

// Email changes standaard
$email_codes_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_EMAIL_CHANGES . ' WHERE klantnummer = "'.$gev2['klantnummer'].'"';
$email_codes_query = mysqli_query($con,$email_codes_sql)or die(mysqli_error());
$email_codes_info = mysqli_fetch_array($email_codes_query);

}
?>