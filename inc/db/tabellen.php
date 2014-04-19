<?php

// Tabellen database
// standaard: define("TBL_", $prefix."");
// prefix:
$prefix = "";

///////////////////
// ALLE DEFINES ///
//////////////////

// Standaard belangrijke tabellen defines
define("TBL_STANDAARD_PAGES", $prefix."website_pages");

// Customers define
define("TBL_CUSTOMERS", $prefix."customers");
define("TBL_CUSTOMERS_REGISTRATIE", $prefix."customers_registratie");
define("TBL_CUSTOMERS_ACTIVATION", $prefix."customers_activation");
define("TBL_CUSTOMERS_EMAIL_CHANGES", $prefix."customers_email_changes");
define("TBL_CUSTOMERS_NIEUWS", $prefix."customers_nieuws");
define("TBL_CUSTOMERS_FACTUREN", $prefix."customers_system_facturen");
define("TBL_CUSTOMERS_PRODUCTS", $prefix."customers_system_products");
define("TBL_CUSTOMERS_SUPPORT_TICKETS", $prefix."customers_support_tickets");

// Settings/staff define
define("TBL_SETTINGS", $prefix."staff_settings");
define("TBL_TOEGANG", $prefix."staff_toegang");
define("TBL_SETTINGS_ONDERHOUD", $prefix."staff_settings_onderhoud");
define("TBL_SETTINGS_LOGS", $prefix."staff_settings_logs");
define("TBL_SETTINGS_LOGIN_IPS", $prefix."staff_stafflogin_ips");
define("TBL_LOGS_LOGIN_IPS", $prefix."staff_logs_login_ips");
define("TBL_LOGS_PAGES_VISIT", $prefix."staff_logs_pages_visit");

?>