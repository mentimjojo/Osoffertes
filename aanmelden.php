<!DOCTYPE html>
<?php
error_reporting(0);
//include
include("inc/config.php");

if(isset($_POST['register'])){

$register_voorletter = $_POST['naam'];
$register_tussen = $_POST['tussen'];
$register_achternaam = $_POST['achternaam'];
$register_email = $_POST['email'];
$register_telefoon = $_POST['telefoon'];
$register_mobiel = $_POST['mobiel'];
$register_wachtwoord = $_POST['wachtwoord1'];
$register_wachtwoordr = $_POST['wachtwoord2'];
$register_check = $_POST['check'];
$register_land = $_POST['land'];
$register_geslacht = $_POST['geslacht'];
$register_activatie = mt_rand();
$register_ip = $_SERVER["REMOTE_ADDR"];
$register_geboortedatum = $_POST['geboorte_dag'].'-'.$_POST['geboorte_maand'].'-'.$_POST['geboorte_jaar'];
$registernaam = $register_voorletter.".".$register_achternaam;

$register_sql = 'SELECT * FROM ' . TBL_CUSTOMERS . ' WHERE email = "' . $register_email . '"';
$register_sql_result = mysqli_query($con,$register_sql)or die(mysqli_error());
$register_sql_email = mysqli_num_rows($register_sql_result);
$register_sql2 = 'SELECT * FROM ' . TBL_CUSTOMERS_REGISTRATIE . ' WHERE register_ip = "' . $register_ip . '"';
$register_sql2_result = mysqli_query($con,$register_sql2)or die(mysqli_error());
$register_sql2_ip = mysqli_num_rows($register_sql2_result);

$register_klant1 = mt_rand(0, 9);
$register_klant2 = mt_rand(0, 9);
$register_klant3 = mt_rand(0, 9);
$register_klant4 = mt_rand(0, 9);
$register_klant5 = mt_rand(0, 9);
$register_klant6 = mt_rand(0, 9);
$register_klantnummer = $register_klant1.$register_klant2.$register_klant3.$register_klant4.$register_klant5.$register_klant6;


if(empty($register_voorletter)){
$fout = $lang_register_fout_naam;
} elseif(empty($register_achternaam)){
$fout = $lang_register_fout_achternaam;
} elseif(empty($register_email)){
$fout = $lang_register_fout_email;
} elseif(empty($register_wachtwoord)){
$fout = $lang_register_fout_ww1;
} elseif(empty($register_wachtwoordr)){
$fout = $lang_register_fout_ww2;
} elseif($register_wachtwoord == $register_wachtwoordr){
if(filter_var($register_email, FILTER_VALIDATE_EMAIL)) {
if(empty($register_check)){
$fout = $lang_register_fout_akkoord;
} else {

if(empty($register_telefoon) / empty($register_mobiel)){
$fout = $lang_register_fout_phone;
} else {


if($register_sql_email == 1){
$fout = $lang_register_fout_email5;
} else {
if($register_sql2_ip == 1){
$fout = $lang_register_fout_ip;
} else {

// uitvoeren
header('Refresh: 0; url=/account/aanmelden?gelukt=1');

// User in database zetten
mysqli_query($con,'INSERT INTO ' . TBL_CUSTOMERS . ' (klantnummer, initalen, tussenvoegsel, achternaam, geboortedatum, land, telefoon, mobile, wachtwoord, email, geslacht)
VALUES ("'.$register_klantnummer.'", "'.$register_voorletter.'", "'.$register_tussen.'", "'.$register_achternaam.'", "'.$register_geboortedatum.'", "'.$register_land.'", "'.$register_telefoon.'", "'.$register_mobiel.'", "'.sha1($register_wachtwoord).'","'.$register_email.'", "'.$register_geslacht.'")');
mysqli_query($con,'INSERT INTO ' . TBL_CUSTOMERS_EMAIL_CHANGES . ' (klantnummer) 
VALUES ("'.$register_klantnummer.'")');
mysqli_query($con,'INSERT INTO ' . TBL_CUSTOMERS_ACTIVATION . ' (klantnummer, activatie_code) 
VALUES ("'.$register_klantnummer.'", "'.$register_activatie.'")');
mysqli_query($con,'INSERT INTO ' . TBL_CUSTOMERS_REGISTRATIE . ' (klantnummer, cookie_hash, register_ip) 
VALUES ("'.$register_klantnummer.'", "'.sha1($register_klantnummer).'", "'.$register_ip.'")');

$message1 = '<html>
<body>
Welkom ' . $registernaam . ',
<br/><br/>
U bent succesvol geregisteerd. Hierbij u gegevens!
<br/><br/>
Klantnummer: ' . $register_klantnummer . '<br/>
Wachtwoord: ' . $register_wachtwoord . '
<br/><br/>
Het enigste wat u nu nog hoeft te doen is je account activeren.<br/>
Klik of kopieer het linkje hier onder om uw account te activeren:
<br/><br/>
<a href="' . URL . '/activatie.php?account_activatie=' . $register_activatie . '&klantnummer=' . $register_klantnummer . '">' .URL . '/activatie.php?account_activatie=' . $register_activatie . '&klantnummer=' . $register_klantnummer . '</a>
<br/><br/>
Met vriendelijke groeten,<br/>
Developers4you.nl
</body>
</html>
';
mailNow($register_email, "Welkom bij Developers4you.nl", $message1, $registernaam);

}
}
}
}
} else {
$fout = $lang_register_fout_emailf;
}
} else {
$fout = $lang_register_fout_ww3;
}

}
$goed = $lang_register_goed;
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

    <?php if($_COOKIE['USER_SYSTEM'] == ""){ ?>
       <div class="row-fluid" >
       <div class="row-fluid">			
        <div class="block">
            <p class="block-heading"><?php echo $lang_register_aanmelden; ?></p>
            <div class="block-body">
			<?php if($_GET['gelukt'] == ""){ ?>
		 <center><font color="red"><?php if(isset($fout)){ ?><strong>Error:</strong> <?php echo $fout; } ?></font></center>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <label><?php echo $lang_register_naam; ?><font color="red">*</font></label>
                    <input type="text" name="naam" value="<?php echo $register_voorletter; ?>">
                    <label><?php echo $lang_register_tussen; ?></label>
                    <input type="text" name="tussen" value="<?php echo $register_tussen; ?>">
                    <label><?php echo $lang_register_achternaam; ?><font color="red">*</font></label>
                    <input type="text" name="achternaam" value="<?php echo $register_achternaam; ?>" >
                    <label><?php echo $lang_register_geslacht; ?><font color="red">*</font></label>
					<select name="geslacht" id="DropDownTimezone" class="input-xlarge">
                    <option value="1" <?php if($register_geslacht == '1'){?> selected <?php } ?> ><?php echo $lang_register_geslacht1; ?></option>
                    <option value="2" <?php if($register_geslacht == '2'){?> selected <?php } ?> ><?php echo $lang_register_geslacht2; ?></option>
                    </select>
					<label>Geboortedatum<font color="red">*</font></label>
<?php
echo("<select name=geboorte_dag>\r\n");
for($x = '31'; $x > '1' - 1; $x--) {
  echo("<option value=" . $x . ">" . $x . "</option>\r\n");
}
echo("</select>");

echo("<select name=geboorte_maand>\r\n");
for($x = '12'; $x > '1' - 1; $x--) {
  echo("<option value=" . $x . ">" . $x . "</option>\r\n");
}
echo("</select>");

echo("<select name=geboorte_jaar>\r\n");
for($x = date("Y") - 13; $x > date("Y") - 50; $x--) {
  echo("<option value=" . $x . ">" . $x . "</option>\r\n");
}
echo("</select>");
?>
					<label><?php echo $lang_register_land; ?><font color="red">*</font></label>
	                 <select name="land" id="DropDownTimezone" class="input-xlarge">
                     <option value="nl" <?php if($register_land == 'nl'){?> selected <?php } ?> ><?php echo $lang_account_land_nl; ?></option>
                     <option value="be" <?php if($register_land == 'be'){?> selected <?php } ?> ><?php echo $lang_account_land_be; ?></option>
                    </select>
                    <label><?php echo $lang_register_email; ?><font color="red">*</font></label>
                    <input type="text" name="email" value="<?php echo $register_email; ?>" >
                    <label><?php echo $lang_register_telefoon; ?><font color="red">**</font></label>
                    <input type="text" name="telefoon" value="<?php echo $register_telefoon; ?>" >
                    <label><?php echo $lang_register_mobiel; ?><font color="red">**</font></label>
                    <input type="text" name="mobiel" value="<?php echo $register_mobiel; ?>" >
                    <label><?php echo $lang_register_wachtwoord; ?><font color="red">*</font></label>
                    <input type="password" name="wachtwoord1" value="<?php echo $register_wachtwoord; ?>" >
                    <label><?php echo $lang_register_wachtwoord2; ?><font color="red">*</font></label>
                    <input type="password" name="wachtwoord2" value="<?php echo $register_wachtwoordr; ?>" >
                    <label class="remember-me"><input type="checkbox" name="check"> <?php echo $lang_register_akkoord; ?> <a href="terms-and-conditions.html"><?php echo $lang_register_akkoord1; ?></a></label><br/>
                    <input type="submit" class="btn btn-primary btn-large" name="register" value="<?php echo $lang_register_meldaan; ?>">
					</form>
					<br/>
					<br/>
					<font color="red">*</font> <?php echo $lang_register_verplicht; ?><br/>
					<font color="red">**</font> <?php echo $lang_register_verplicht1; ?>
					<?php } elseif($_GET['gelukt'] == 1) { 
					header('Refresh: 5; url=/index.php');
					?>
				    <center><font color="green"><?php echo $goed; ?></font></center>
					<?php } ?>
                    <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
       <div class="row-fluid" >
       <div class="dialog">			
        <div class="block">
            <p class="block-heading">Ingelogd!</p>
            <div class="block-body">
		 <center><font color="red">Je bent ingelogd? Wat doe je hier op de registratie pagina?! <a href="index.php?page=<?= HOME; ?>">Klik hier om naar de home pagina te gaan</a></font></center>
                    <div class="clearfix"></div>
            </div>
        </div>
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


