<?php
session_start();

setcookie("USER_SYSTEM", "", time()-3600);
setcookie("SECURITY", "", time()-3600);
setcookie("SECURITY_VAAK", "", time()-3600);

header('Refresh: 5; url='.URL.'/account/login');

echo "Uitgelogd";

?>