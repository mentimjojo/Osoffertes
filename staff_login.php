<!DOCTYPE html>
<?php
include("inc/config.php");
$sessieid = mt_rand();


?>
<html lang="en">
<?php echo $style; ?>
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li><a href="index.php?login=1&sessie=<?php echo $sessieid; ?>&lang=nl" class="hidden-phone visible-tablet visible-desktop" role="button"><img style="margin-bottom: -4px" src="images/lang/flag_nl.png"></a></li>
                    
                </ul>
                <a class="brand" href="#"><span class="second"><?php echo $lang_title;?> - <?php echo $_SESSION['lang']; ?></span></a>
        </div>
    </div>
    

<?php
// SYSTEEM INLOGGEN BEGIN


//Form openen
if(isset($_POST['login'])){

if($_POST['klant'] == ""){
$fout = $lang_fout_geen_klantnummer.'<br/>';
} elseif($_POST['pass'] == ""){
$fout = $lang_fout_geen_wachtwoord.'<br/>';
} else {

$klantnummer = $_POST['klant'];
$wachtwoord = $_POST['pass'];
$ip = $_SERVER["REMOTE_ADDR"];
$pass = sha1($wachtwoord);
$session_id_make = sha1($klantnummer);

$datumnu=date_create();
$datumdb = date_timestamp_get($datumnu);

$gegevens = 'SELECT * FROM ' . TBL_CUSTOMERS . ' WHERE klantnummer = "'.$klantnummer.'"
AND wachtwoord="'.$pass.'"';
$result = mysqli_query($con,$gegevens)or die(mysqli_error());
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$actief = 'SELECT * FROM ' . TBL_CUSTOMERS_ACTIVATION . ' WHERE klantnummer = "'.$klantnummer.'"';
$actief_query = mysqli_query($con,$actief)or die(mysqli_error());
$actief_info = mysqli_fetch_array($actief_query);

if( $num_row ==1 )
     { 
if($actief_info['activatie_status'] == 1){

$_SESSION['user'] = md5($session_id_make);

if(isset($_POST['remember'])){
setcookie("USER_SYSTEM", sha1($klantnummer));
} else {
setcookie("USER_SYSTEM", sha1($klantnummer), time()+3600);
}
echo $_COOKIE['USER_SYSTEM'];

header('Refresh: 5; url=index.php');
$succesvol = 1;

if(LOGS_LOGIN_IPS == 1){
mysqli_query($con,'INSERT INTO ' . TBL_LOGS_LOGIN_IPS . ' (klantnummer, datum, ip) 
VALUES ("'.$klantnummer.'", "'.DATUM.'","'.$ip.'")');
}

 } else {
 $fout = $lang_inlog_fout_activatie.'<br/>';
 }
 } else {
 $fout = $lang_fout.'<br/>';
  }

//Form sluiten
}
}

// SYSTEEM INLOGGEN EINDE


$staff_ip_sql = 'SELECT * FROM ' . TBL_SETTINGS_LOGIN_IPS . ' WHERE ip1 = "'.$_SERVER['REMOTE_ADDR'].'" OR ip2 = "'.$_SERVER['REMOTE_ADDR'].'" OR ip3 = "'.$_SERVER['REMOTE_ADDR'].'" OR ip4 = "'.$_SERVER['REMOTE_ADDR'].'"';
$staff_ip_query = mysqli_query($con,$staff_ip_sql)or die(mysqli_error());
$staff_ip_info = mysqli_num_rows($staff_ip_query);


if($staff_ip_info == 1){

if($succesvol == ""){
?>


    

    
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading"><?php echo $lang_login; ?></p>
            <div class="block-body">
             <center><font color="red"><?php echo $fout; ?></font></center>
			 <center><font color="green"><?php echo $goed; ?></font></center>
			   Staff login, dus alleen voor staff:<br/><br/>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <label><?php echo $lang_login_username; ?></label>
                    <input type="text" name="klant" class="span12" value="<?php if(empty($_COOKIE['onthoud_login'])){ echo $klantnummer; } else { echo $onthoud_gegevens['klantnummer']; } ?>">
                    <label><?php echo $lang_login_wachtwoord; ?></label>
                    <input type="password" name="pass" class="span12" value="<?php if(empty($_COOKIE['onthoud_login'])){ echo $wachtwoord; } else { echo $_COOKIE['onthoud_pass']; } ?>">
					<input type="submit" class="btn btn-primary pull-right" name="login" value="<?php echo $lang_login_knop; ?>">
                    <label class="remember-me"><input type="checkbox" name="remember" <?php if($action == 1){ echo 'checked="ja"'; } else { } ?>> <?php echo $lang_login_rember; ?></label>
					<br/><br/>
					<a href="aanmelden.php?sessie=<?php echo $securityid; ?>&lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang_register; ?></a><br/>
					<a href="#"><?php echo $lang_forgot; ?></a>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#"><?php echo $lang_copyby ?></a></p>
    </div>
</div>

<?php 
} else {
header('Refresh: 5; url=index.php');
?>
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading"><?php echo $lang_al_ingelogd; ?></p>
            <div class="block-body">
             <?php echo $lang_ingelogd; ?>
			 <?php echo $lang_login_klikdoor; ?>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
<?php
} 
} else {
?>
<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading" align="center">Geen toegang.</p>
            <div class="block-body">
             <center><font color="red">U heeft geen toegang deze pagina te gebruiken.</font></center>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
<?php } ?>


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


