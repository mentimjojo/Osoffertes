<!DOCTYPE html>
<?php

$sessieid = mt_rand();

?>
<html lang="en">
<?php echo $style; ?>
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    
                </ul>
                <a class="brand" href="#"><span class="second"><?php echo $lang_title;?></span></a>
        </div>
    </div>
    

<?php
// SYSTEEM INLOGGEN BEGIN
if(isset($_COOKIE['SECURITY'])){ } else {
setcookie("SECURITY", 0);
}
if(isset($_COOKIE['SECURITY_VAAK'])){} else {
setcookie("SECURITY_VAAK", 5);
header('Refresh: 0; url=index.php');
}

//Form openen
if(isset($_POST['login'])){

if($_POST['klant'] == ""){
$fout = $lang_fout_geen_klantnummer.'<br/>';
setcookie("SECURITY", $_COOKIE['SECURITY']+1, time()+7200);
setcookie("SECURITY_VAAK", $_COOKIE['SECURITY_VAAK']-1, time()+7200);
} elseif($_POST['pass'] == ""){
$fout = $lang_fout_geen_wachtwoord.'<br/>';
setcookie("SECURITY", $_COOKIE['SECURITY']+1, time()+7200);
setcookie("SECURITY_VAAK", $_COOKIE['SECURITY_VAAK']-1, time()+7200);
} else {

$klantnummer = htmlentities($_POST['klant']);
$wachtwoord = htmlentities($_POST['pass']);
$ip = $_SERVER["REMOTE_ADDR"];
$pass = sha1($wachtwoord);
$session_id_make = sha1($klantnummer);

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
 setcookie("SECURITY", $_COOKIE['SECURITY']+1, time()+7200);
 setcookie("SECURITY_VAAK", $_COOKIE['SECURITY_VAAK']-1, time()+7200);
 }
 } else {
 $fout = $lang_fout.'<br/>';
 setcookie("SECURITY", $_COOKIE['SECURITY']+1, time()+7200);
 setcookie("SECURITY_VAAK", $_COOKIE['SECURITY_VAAK']-1, time()+7200);
  }

//Form sluiten
}
}

// SYSTEEM INLOGGEN EINDE
if($_COOKIE['SECURITY'] < 5){
if($succesvol == ""){
?>
    

    
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading"><?php echo $lang_login; ?></p>
            <div class="block-body">
		     Hier kun je inloggen:
			 <hr size="1">
             <center><font color="red"><?php echo $fout; ?></font></center>
			 <center><font color="green"><?php echo $goed; ?></font></center>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <label><?php echo $lang_login_username; ?></label>
                    <input type="text" name="klant" class="span12" value="<?= $_POST['klant']; ?>">
                    <label><?php echo $lang_login_wachtwoord; ?></label>
                    <input type="password" name="pass" class="span12" value="<?= $_POST['pass']; ?>">
					<input type="submit" class="btn btn-primary pull-right" name="login" value="<?php echo $lang_login_knop; ?>">
                    <label class="remember-me"><input type="checkbox" name="remember"> <?php echo $lang_login_rember; ?></label>
					</form>
					<hr size="1">
					Je hebt nog <?php echo $_COOKIE['SECURITY_VAAK'] ?> login pogingen.<br/>
					<a href="/account/aanmelden"><?php echo $lang_register; ?></a><br/>
					<a href="/account/forgot-password">Wachtwoord vergeten? Klik hier</a>
                    <div class="clearfix"></div>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#"><?php echo $lang_copyby ?></a></p>
    </div>
</div>

<?php 
}
else {
header('Refresh: 5; url=index.php');
echo $_COOKIE['USER_SYSTEM'];
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
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
<?php
} 
} else {
?>
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Te vaak geprobeert in te loggen.</p>
            <div class="block-body">
             Je hebt 5 keer geprobeert in te loggen met foutive gegevens. Je moet 2 uur wachten.
            </div>
        </div>
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
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


