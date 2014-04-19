<?php 
// Alle defines standaard
// define("", ); 

// Standaard site instellingen
define("VERSION", $settingsgev['site_version']);
define("SITETITEL", $settingsgev['site_titel']);
define("URL", $settingsgev['site_url']); // in db altijd link zonder '/'
define("SEO", $settingsgev['site_seo']);

// Onderhoud
define("ONDERHOUD", $settings_onderhoud_info['onderhoud_aan']);
define("ONDERHOUD_BERICHT", $settings_onderhoud_info['onderhoud_bericht']);

// Log settings
define("LOGS_VISIT_ON", $settings_logs_info['log_visit_on']);
define("LOGS_LOGIN_IPS", $settings_logs_info['log_iplogins_on']);
define("SETTINGS_LOG_VISIT", $settingsgev['settings_log_visit']);

// Overige
define("DATUM", date_format($standaard_datum,"d-m-Y"));

// URL DEFINES INC SEO
if(SEO == 0){
define("SEO_LINK", "/index.php?page=");
} else {
define("SEO_LINK", "/page/");
}

while($page_system_info2 = mysqli_fetch_array($page_system2)){
    if(SEO == 1){
        define($page_system_info2['page_define'], $page_system_info2['page_seo']);
    } else {
        define($page_system_info2['page_define'], $page_system_info2['page_name']);
    }
}


// standaard define wel ingelogd
if(isset($_COOKIE['USER_SYSTEM'])){
    define("KLANTNUMMER", $gev2['klantnummer']);
    define("KLANTNAAM", $gev2['initalen'].'.'.$gev2['achternaam']);
    define("KLANT_PASS_CHANGE", $gev2['wachtwoord_change']);
    define("PROJECT_MAP", $gev2['project_map']);
    define("TOEGANG", $standaard_toegang_info['toegang']);
    define("TOEGANG_LOC" , $standaard_toegang_info['toegang_loc']);
    define("KLANT_PRODUCTEN_TOTAAL", mysqli_num_rows($standaard_products_query));
    define("KLANT_PRODUCTEN_TOTAAL_MENU", mysqli_num_rows($standaard_product_query));
    define("KLANT_FACTUUR_TOTAAL_MENU", mysqli_num_rows($standaard_facturen_query));
    define("KLANT_FACTUUR_TOTAAL", mysqli_num_rows($standaard_factuur_query));
    define("KLANT_SUPPORT_TICKETS_TOTAAL" , mysqli_num_rows($standaard_tickets_query));
    define("EMAIL_VERIFEER", $email_codes_info['email_verfi']);
    define("PRODUCT_STATUS", $product_status);
    define("MAP_INDEX", "<center><strong>Standaard index van project map.<strong></center>");
} else {
    define("TOEGANG", 0);
}
?>