<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#loginips2').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
		"oLanguage": {
       "sUrl": "lang/dataTables.txt"
         }
    });
} );
</script>
<?php
               error_reporting(0);
               /////////////////////////////////////////////////////
			   /////////  ALGEMENE GEGEVENS SAVEN           ///////
			   //////////////////////////////////////////////////
			   if(isset($_POST['opslaan_account'])){
			   
			   $opslaan_email = $_POST['email'];
			   $opslaan_postcode = $_POST['postcode'];
			   $opslaan_adres = $_POST['adres'];
			   $opslaan_huisnummer = $_POST['huisnummer'];
			   $opslaan_toevoeging = $_POST['toevoeging'];
			   $opslaan_telefoon = $_POST['telefoon'];
			   $opslaan_mobiel = $_POST['mobiel'];
			   $opslaan_land = $_POST['land'];
			   $opslaan_wachtwoordcheck1 = sha1($_POST['wachtwoordcheck1']);
			   
			   if(empty($opslaan_postcode)){
			   $fout = $lang_account_fout_postcode;
			   } elseif(empty($opslaan_adres)){
			   $fout = $lang_account_fout_adres;
			   } elseif(empty($opslaan_huisnummer)){
			   $fout = $lang_account_fout_huisnummer;
			   } elseif(empty($opslaan_telefoon) / empty($opslaan_mobiel)){
			   $fout = $lang_account_fout_telefoonnummer;
			   } else {
			   
			   if($opslaan_wachtwoordcheck1 == $gev2['wachtwoord']){
			   
			   mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS . ' SET postcode="'.$opslaan_postcode.'", adres="'.$opslaan_adres.'", huisnummer="'.$opslaan_huisnummer.'", toevoeginghn="'.$opslaan_toevoeging.'", land="'.$opslaan_land.'", telefoon="'.$opslaan_telefoon.'", mobile="'.$opslaan_mobiel.'" WHERE klantnummer="'.KLANTNUMMER.'"');
			   	
			    $goed_vak = 1;
			   
			   } else {
			   $fout = $lang_account_fout_wachtwoordcheck1;
			   }
			   
			   }
			   
			   }
			   
               /////////////////////////////////////////////////////
			   /////////  Pass saven          ///////
			   //////////////////////////////////////////////////
			   if(isset($_POST['opslaan_pass'])){
			   
			   $opslaan_pass_huidig = sha1($_POST['wachtwoordhuidig1']);
			   $opslaan_pass_nieuw1 = $_POST['wachtwoordnieuw1'];
			   $opslaan_pass_nieuw2 = $_POST['wachtwoordnieuw2'];
			   
			   if($opslaan_pass_huidig == $gev2['wachtwoord']){
			   if($opslaan_pass_nieuw1 == $opslaan_pass_nieuw2){
			   if(empty($opslaan_pass_nieuw1)){
			   $fout = $lang_wachtwoord_fout_leeg;
			   } else { 
			   
			   // UITVOEREN
			   $goed_vak = 2;
			   mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS . ' SET wachtwoord="'.sha1($opslaan_pass_nieuw1).'" WHERE klantnummer="'.KLANTNUMMER.'"');
			  
			   }
			   } else {
			   // Wachtwoord niet zelfde
			   $fout = $lang_wachtwoord_fout_nietzelfde;
			   }
			   } else {
			   // Wachtwoord fout met db
			   $fout = "Uw huidige wachtwoord is niet correct";
			   }
			   }
			   
			   /////////////////////////////////////////////////////
			   /////////  EMAIL saven         ///////
			   //////////////////////////////////////////////////
			   if(isset($_POST['opslaan_email'])){
			   
			   $email_nieuw1 = $_POST['email_nieuw1'];
			   $email_nieuw2 = $_POST['email_nieuw2'];
			   $email_activatie = mt_rand();
			   $email_terug_code = mt_rand();
			   
			   if(empty($email_nieuw1)){
			   $fout = "Er is geen nieuwe email ingevoerd.";
			   } elseif(empty($email_nieuw2)){
			   $fout = "Er is geen herhaal nieuwe email ingevoerd.";
			   } elseif(!$email_nieuw1 == $email_nieuw2){
			   $fout = "Uw nieuwe email is niet hetzelfde als het uw herhaal nieuwe email.";
			   } elseif(filter_var($email_nieuw1, FILTER_VALIDATE_EMAIL)){
			   
			   // Uitvoeren
			   $goed_vak = 3;
			   mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS . ' SET email="'.$email_nieuw1.'" WHERE klantnummer="'.KLANTNUMMER.'"');
			   mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_EMAIL_CHANGES . ' SET email_verfi=0, email_verfi_code="'.$email_activatie.'", email_verfi_terug_code="'.$email_terug_code.'", email_verfi_geldig=1, email_verfi_terug_geldig=1, ip="'.$_SERVER["REMOTE_ADDR"].'" WHERE klantnummer="'.KLANTNUMMER.'"');
			   
			   // Activatie nieuwe email sturen
$to  = $email_nieuw1;
$subject = 'Email gewijzigd - Developers4you!';
$message = '<html>
<body>
Hallo ' . KLANTNAAM . ',
<br/><br/>
U heeft uw email adres gewijzigd naar dit adres. Hierbij u email activatie link!<br/>
Klik of kopieer het linkje hier onder om uw nieuwe email adres te activeren:
<br/><br/>
<a href="http://www.customers.developers4you.nl/activatie.php?email_activation=' .$email_activatie. '">http://www.customers.developers4you.nl/activatie.php?email_activation=' .$email_activatie. '</a>
<br/><br/>
Met vriendelijke groeten,<br/>
Developers4you.nl
</body>
</html>
';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'To: '.KLANTNAAM.' <'.$email_nieuw1.'>' . "\r\n";
$headers .= 'From: Developers4you <no-reply@developers4you.nl>' . "\r\n";
mail($to, $subject, $message, $headers);

$to1  = $gev2['email'];
$subject1 = 'Email gewijzigd - Developers4you!';
$message1 = '<html>
<body>
Hallo ' . KLANTNAAM . ',
<br/><br/>
U ontvangt dit mailtje omdat uw email adres op developers4you is gewijzigd naar '.$email_nieuw1.'.<br/>
Indien u dit zelf niet heeft gedaan kunt u met de onderstaande link u oude email terug zetten. Let op, deze link is maar 14 dagen geldig.
<br/><br/>
<a href="http://www.customers.developers4you.nl/activatie.php?email_activation=' .$email_terug_code. '&oude_email='.$gev2['email'].'">http://www.customers.developers4you.nl/activatie.php?email_activation=' .$email_terug_code. '&oude_email='.$gev2['email'].'</a>
<br/><br/>
Met vriendelijke groeten,<br/>
Developers4you.nl
</body>
</html>
';
$headers1  = 'MIME-Version: 1.0' . "\r\n";
$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers1 .= 'To: '.KLANTNAAM.' <'.$email_nieuw1.'>' . "\r\n";
$headers1 .= 'From: Developers4you <no-reply@developers4you.nl>' . "\r\n";
mail($to1, $subject1, $message1, $headers1);
			   // Email sturen einden
			   
			   } else {
			   $fout = "Dit is geen geldig email adres";
			   }
			   }

         if(isset($_POST['opslaan_staff'])){
             mysqli_query($con,'UPDATE ' . TBL_TOEGANG . ' SET toegang_loc="'.$_POST['staff_locatie'].'" WHERE klantnummer="'.KLANTNUMMER.'"');
             $goed_vak = 4;
         }
			   

?>

		 <center><h3><font color="green"><?php echo $goed; ?></font></h3></center>
		 <center><h3><font color="red"><?php echo $fout; ?></font></h3></center>
	
<div class="well">
    <ul class="nav nav-tabs">
      <li <?php if(isset($_POST['opslaan_account'])){ echo 'class="active"'; } if($_POST['opslaan_account'] == "" AND $_POST['opslaan_email'] == "" AND $_POST['opslaan_pass'] == "" AND $_POST['opslaan_staff'] == ""){ echo 'class="active"'; } ?>><a href="#account" data-toggle="tab"><?php echo $lang_account_tab_profiel; ?></a></li>
	  <li <?php if(isset($_POST['opslaan_email'])){ echo 'class="active"'; } ?>><a href="#email" data-toggle="tab">Email</a></li>
      <li <?php if(isset($_POST['opslaan_pass'])){ echo 'class="active"'; } ?>><a href="#wachtwoord" data-toggle="tab"><?php echo $lang_account_tab_pass; ?></a></li>
      <li><a href="#loginips" data-toggle="tab">Inlog ips</a></li>
      <?php if(TOEGANG > 0) { ?>
      <li <?php if(isset($_POST['opslaan_staff'])){ echo 'class="active"'; } ?>><a href="#staff" data-toggle="tab">Staff instellingen</a></li>
      <?php } ?>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div <?php if(isset($_POST['opslaan_account'])){ echo 'class="tab-pane active in"'; } elseif($_POST['opslaan_email'] == "" AND $_POST['opslaan_pass'] == "" AND $_POST['opslaan_staff'] == ""){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="account">
	 <?php 		 if($_GET['bewerken'] == ""){ ?>
	 
        <label><?php echo $lang_account_vak_kn; ?></label>
        <input type="text" class="input-xlarge" value="<?php echo $gev2['klantnummer']; ?>" disabled>
		<?php if(TOEGANG >= 10){ ?>
        <label>Login id (Dit is voor de veiligheid. <font color="red">Geef deze code aan niemand!</font>)</label>
        <input type="text" class="input-xlarge" style="width:400px;" value="<?= $standaard_reg_info['cookie_hash']; ?>" disabled>
		<?php } ?>
        <label><?php echo $lang_account_vak_geslacht; ?></label>
        <input type="text" class="input-xlarge" value="<?php if($gev2['geslacht'] == 1){ echo $lang_account_vak_geslacht_dhr; } elseif($gev2['geslacht'] == 2){ echo $lang_account_vak_geslacht_mvr; } else { echo $lang_account_vak_geslacht_onbekend; } ?>" disabled>
        <label>Geboortedatum</label>
        <input type="text" class="input-xlarge" value="<?php echo $gev2['geboortedatum']; ?>" disabled>
        <label><?php echo $lang_account_vak_voorletters; ?></label>
        <input type="text" class="input-xlarge" value="<?php echo $gev2['initalen']; ?>" disabled>
        <label><?php echo $lang_account_vak_achternaam; ?></label>
        <input type="text" class="input-xlarge" value="<?php echo $gev2['achternaam']; ?>" disabled>
        <label><?php echo $lang_account_vak_email; ?></label>
        <input type="text" class="input-xlarge" name="email" value="<?php echo $gev2['email']; ?>" disabled>
        <label><?php echo $lang_account_vak_adres; ?></label>
        <input type="text" class="input-xlarge" name="adres" value="<?php echo $gev2['adres']; ?>" disabled>	
        <label><?php echo $lang_account_vak_huisnummer; ?></label>
        <input type="text" class="input-xlarge" name="huisnummer" value="<?php echo $gev2['huisnummer']; ?>" disabled>
        <label><?php echo $lang_account_vak_toevoeging; ?></label>
        <input type="text" class="input-xlarge" name="toevoeging" value="<?php echo $gev2['toevoeginghn']; ?>" disabled>
        <label><?php echo $lang_account_vak_postcode; ?></label>
        <input type="text" class="input-xlarge" name="postcode" value="<?php echo $gev2['postcode']; ?>" disabled>	
        <label><?php echo $lang_account_vak_huistelefoon; ?></label>
        <input type="text" class="input-xlarge" name="telefoon" value="<?php echo $gev2['telefoon']; ?>" disabled>	
        <label><?php echo $lang_account_vak_mobiel; ?></label>
        <input type="text" class="input-xlarge" name="mobiel" value="<?php echo $gev2['mobile']; ?>" disabled>	
        <label><?php echo $lang_account_land; ?></label>
        <select name="land" id="DropDownTimezone" class="input-xlarge" disabled>
          <option value="nl" <?php if($gev2['land'] == 'nl'){?> selected <?php } ?> ><?php echo $lang_account_land_nl; ?></option>
          <option value="be" <?php if($gev2['land'] == 'be'){?> selected <?php } ?> ><?php echo $lang_account_land_be; ?></option>
    </select><br/><br/>
	 <br/><p><a class="btn btn-primary btn-large" href="index.php?page=account&bewerken=1&security=<?php echo $sessieids; ?>&sessie=<?php echo $securityid; ?>"><?php echo $lang_account_vak_bewerk; ?></a></p>
	 <?php } elseif($_GET['bewerken'] == "1"){   ?>
    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab">
        <label><?php echo $lang_account_vak_kn; ?></label>
        <input type="text" class="input-xlarge" value="<?php echo $gev2['klantnummer']; ?>" disabled>
        <label><?php echo $lang_account_vak_geslacht; ?></label>
        <input type="text" class="input-xlarge" value="<?php if($gev2['geslacht'] == 1){ echo $lang_account_vak_geslacht_dhr; } elseif($gev2['geslacht'] == 2){ echo $lang_account_vak_geslacht_mvr; } else { echo $lang_account_vak_geslacht_onbekend; } ?>" disabled>
        <label><?php echo $lang_account_vak_voorletters; ?></label>
        <input type="text" class="input-xlarge" value="<?php echo $gev2['initalen']; ?>" disabled>
        <label><?php echo $lang_account_vak_achternaam; ?></label>
        <input type="text" class="input-xlarge" value="<?php echo $gev2['achternaam']; ?>" disabled>
        <label><?php echo $lang_account_vak_adres; ?><font color="red">*</font></label>
        <input type="text" class="input-xlarge" name="adres" value="<?php echo $gev2['adres']; ?>">	
        <label><?php echo $lang_account_vak_huisnummer; ?><font color="red">*</font></label>
        <input type="text" class="input-xlarge" name="huisnummer" value="<?php echo $gev2['huisnummer']; ?>">
        <label><?php echo $lang_account_vak_toevoeging; ?><font color="red">*</font></label>
        <input type="text" class="input-xlarge" name="toevoeging" value="<?php echo $gev2['toevoeginghn']; ?>">
        <label><?php echo $lang_account_vak_postcode; ?><font color="red">*</font></label>
        <input type="text" class="input-xlarge" name="postcode" value="<?php echo $gev2['postcode']; ?>">
        <label><?php echo $lang_account_vak_huistelefoon; ?><font color="red">**</font></label>
        <input type="text" class="input-xlarge" name="telefoon" value="<?php echo $gev2['telefoon']; ?>">
        <label><?php echo $lang_account_vak_mobiel; ?><font color="red">**</font></label>
        <input type="text" class="input-xlarge" name="mobiel" value="<?php echo $gev2['mobile']; ?>">
        <label><?php echo $lang_account_land; ?></label>
        <select name="land" id="DropDownTimezone" class="input-xlarge">
          <option value="nl" <?php if($gev2['land'] == 'nl'){?> selected <?php } ?> ><?php echo $lang_account_land_nl; ?></option>
          <option value="be" <?php if($gev2['land'] == 'be'){?> selected <?php } ?> ><?php echo $lang_account_land_be; ?></option>
    </select>
	<hr size=1>
        <label><?php echo $lang_account_vak_wachtwoordcheck1; ?><font color="red">*</font></label>
        <input type="password" class="input-xlarge" name="wachtwoordcheck1">
	<br/><br/><input type="submit" class="btn btn-primary btn-large" name="opslaan_account" value="<?php echo $lang_account_vak_opslaan; ?>">
    </form>
	<br/><br/>
	<font color="red">*</font> <?php echo $lang_account_verplicht1; ?><br/>
	<font color="red">**</font> <?php echo $lang_account_verplicht2; ?>
	<?php } ?>
      </div>
	    <div <?php if(isset($_POST['opslaan_email'])){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="email">
		<?php if(EMAIL_VERIFEER == 0) { ?>
		<center><h3><font color="red">Uw email adres is recentelijk gewijzigd. U heeft u nieuwe email adres nog niet geverifieerd. Voordat u uw email weer kunt wijzigen moet u uw email adres verifi&euml;ren.<br/>
		U kunt de verifieer link op dit email adres vinden: <?php echo $gev2['email']; ?>. Heeft u geen mailtje gehad? Klik hier op nieuw te sturen.
		</font></h3></center>
		<?php } else { ?>
		Hier kun je je email wijzigen. <strong>Let op:</strong> U nieuwe email moet worden geverifieerd.<br/><br/>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab2">
        <label>Huidige emailadres</label>
        <input type="text" class="input-xlarge" name="email_huidig" value="<?php echo $gev2['email']; ?>" disabled>
	    <hr size=1>
        <label>Nieuwe email</label>
        <input type="text" class="input-xlarge" name="email_nieuw1" value="<?php echo $email_nieuw1; ?>">
        <label>Herhaal nieuwe email</label>
        <input type="text" class="input-xlarge" name="email_nieuw2" value="<?php echo $email_nieuw2; ?>">
        <br/><br/><input type="submit" class="btn btn-primary btn-large" name="opslaan_email" value="<?php echo $lang_account_vak_opslaan; ?>">
        </form>
	    <?php } ?>
      </div>
      <div <?php if(isset($_POST['opslaan_pass'])){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="wachtwoord">
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab3">
        <label><?php echo $lang_wachtwoord_vak_huidig; ?></label>
        <input type="password" class="input-xlarge" name="wachtwoordhuidig1">
	    <hr size=1>
        <label><?php echo $lang_wachtwoord_vak_nieuw; ?></label>
        <input type="password" class="input-xlarge" name="wachtwoordnieuw1" value="<?php echo $opslaan_pass_nieuw1; ?>">
        <label><?php echo $lang_wachtwoord_vak_nieuw1; ?></label>
        <input type="password" class="input-xlarge" name="wachtwoordnieuw2" value="<?php echo $opslaan_pass_nieuw2; ?>">
        <br/><br/><input type="submit" class="btn btn-primary btn-large" name="opslaan_pass" value="<?php echo $lang_account_vak_opslaan; ?>">
    </form>
      </div>
	    <div id="loginips" class="tab-pane fade">
		<?php if(LOGS_LOGIN_IPS == 1){ ?>
		<center>Alle ips waarmee op jou account is ingelogd. Zie je een ip die je niet herkent en denk je dat je gehackt bent? Neem dan contact op.</center>
		<hr size="1">
        <table class="display" id="loginips2">
      <thead>
        <tr>
          <th>IP</th>
          <th>Datum</th>
        </tr>
      </thead>
      <tbody>
 <?php
 
 $ips_sql = mysqli_query($con,'SELECT * FROM ' . TBL_LOGS_LOGIN_IPS. ' WHERE klantnummer = "'.KLANTNUMMER.'"');
while($ips_info = mysqli_fetch_array($ips_sql)) {

  ?> 
        <tr>
          <td><center><?php echo $ips_info['ip']; ?></center></td>
          <td><center><?php echo $ips_info['datum']; ?></center></td>
        </tr>
		<?php 
		} 
		?>
	</tbody>
    </table>
	<?php } else { ?>
		<center><h3><font color="red">IP logs staan op dit moment uit. Voor meer informatie neem contact op.</font></h3></center>
	<?php } ?>
      </div>
        <div <?php if(isset($_POST['opslaan_staff'])){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="staff">
            Staff instelinngen:
            <hr size="1" >
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab5">
                <label>Locatie staff menu:</label>
                <select name="staff_locatie" class="input-xlarge">
                    <option value="0" <?php if(TOEGANG_LOC == '0'){?> selected <?php } ?> >Links onder in het menu</option>
                    <option value="1" <?php if(TOEGANG_LOC == '1'){?> selected <?php } ?> >Boven als dropdown naast <?= KLANTNAAM; ?></option>
                </select>
                <br/><br/><input type="submit" class="btn btn-primary btn-large" name="opslaan_staff" value="Opslaan">
            </form>
        </div>
  </div>
 

</div>

<?php if($goed_vak == 1){ ?>
<div class="modal small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel"><?php echo $lang_wachtwoord_goed_vak_title; ?></h3>
  </div>
  <div class="modal-body">
    
    <p class="error-text"><i class="icon-warning-sign modal-icon"></i><?php echo $lang_wachtwoord_goed_vak_zin; ?></p>
  </div>
  <div class="modal-footer">
    <p><a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=account&security=<?php echo $sessieids; ?>&sessie=<?php echo $securityid; ?>"><?php echo $lang_wachtwoord_goed_vak_door; ?></a></p>
  </div>
</div>
<?php } ?>

<?php if($goed_vak == 2){ ?>
<div class="modal small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel"><?php echo $lang_wachtwoord_goed_vak_title; ?></h3>
  </div>
  <div class="modal-body">
    
    <p class="error-text"><i class="icon-warning-sign modal-icon"></i><?php echo $lang_wachtwoord_goed_vak_zin1; ?></p>
  </div>
  <div class="modal-footer">
    <p><a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=account&security=<?php echo $sessieids; ?>&sessie=<?php echo $securityid; ?>"><?php echo $lang_wachtwoord_goed_vak_door; ?></a></p>
  </div>
</div>
<?php } ?>

<?php if($goed_vak == 3){ ?>
<div class="modal small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel">Email succesvol opgeslagen</h3>
  </div>
  <div class="modal-body">
    
    <p class="error-text"><i class="icon-warning-sign modal-icon"></i>U nieuwe email adres is succesvol opgeslagen. Er is een mailtje verstuurd naar uw nieuwe en oude email. U nieuwe email adres dient geverifieerd te worden. Klik hiervoor op de link in de email die gestuurd is naar u nieuwe email adres.</p>
  </div>
  <div class="modal-footer">
    <p><a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=account&security=<?php echo $sessieids; ?>&sessie=<?php echo $securityid; ?>"><?php echo $lang_wachtwoord_goed_vak_door; ?></a></p>
  </div>
</div>
<?php } ?>

<?php if($goed_vak == 4){ ?>
    <div class="modal small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h3 id="myModalLabel">Staff instellingen opgeslagen.</h3>
        </div>
        <div class="modal-body">

            <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Uw nieuwe staff instellingen zijn succeslvol opgeslagen..</p>
        </div>
        <div class="modal-footer">
            <p><a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=account&security=<?php echo $sessieids; ?>&sessie=<?php echo $securityid; ?>"><?php echo $lang_wachtwoord_goed_vak_door; ?></a></p>
        </div>
    </div>
<?php } ?>






                    

