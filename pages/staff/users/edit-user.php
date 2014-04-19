<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#products').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
		"oLanguage": {
       "sUrl": "lang/dataTables.txt"
         }
    });
} );
</script>
<?php  

// Gegevens informatie klant
$klantid = $_GET['klantnummer'];
$klant_sql1 = 'SELECT * FROM ' . TBL_CUSTOMERS . ' WHERE klantnummer = "'.$klantid.'"';
$klant_query1 = mysqli_query($con,$klant_sql1)or die(mysqli_error());
$klant_info1 = mysqli_fetch_array($klant_query1);
$klant_sql2 = 'SELECT * FROM ' . TBL_CUSTOMERS_ACTIVATION . ' WHERE klantnummer = "'.$klantid.'"';
$klant_query2 = mysqli_query($con,$klant_sql2)or die(mysqli_error());
$klant_info2 = mysqli_fetch_array($klant_query2);
$klant_sql3 = 'SELECT * FROM ' . TBL_CUSTOMERS_EMAIL_CHANGES . ' WHERE klantnummer = "'.$klantid.'"';
$klant_query3 = mysqli_query($con,$klant_sql3)or die(mysqli_error());
$klant_info3 = mysqli_fetch_array($klant_query3);
$klant_sql4 = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.$klantid.'" AND project_map = 1';
$klant_query4 = mysqli_query($con,$klant_sql4)or die(mysqli_error());
$klant_info4 = mysqli_fetch_array($klant_query4);
$klant_tel4 = mysqli_num_rows($klant_query4);
define("KLANTUSERNAAM", $klant_info1['initalen'].'.'.$klant_info1['achternaam']);


// Gebruiker opslaan
if(isset($_POST['opslaan_gebruiker'])){
$geboortedatum = $_POST['geboorte_dag'].'-'.$_POST['geboorte_maand'].'-'.$_POST['geboorte_jaar'];
header('Refresh: 0; url='.SEO_LINK.''.STAFF_USERS_EDIT.'&klantnummer='.$klantid.'&goed=1');
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS . ' SET geboortedatum = "'.$geboortedatum.'", postcode="'.$_POST['postcode'].'", adres="'.$_POST['adres'].'", huisnummer="'.$_POST['huisnummer'].'", toevoeginghn="'.$_POST['toevoeging'].'", land="'.$_POST['land'].'", telefoon="'.$_POST['telefoon'].'", mobile="'.$_POST['mobiel'].'" WHERE klantnummer="'.$klantid.'"');
}


// Mail
 if($_GET['verstuur_mail'] == 1){
$klantnummermail = $_GET['klantnummer'];
$_POST['opslaan_activatie'] = "ja";

$mail_sql1 = 'SELECT * FROM ' . TBL_CUSTOMERS . ' WHERE klantnummer = "'.$klantnummermail.'"';
$mail_query1 = mysqli_query($con,$mail_sql1)or die(mysqli_error());
$mail_info1 = mysqli_fetch_array($mail_query1);
$mail_sql2 = 'SELECT * FROM ' . TBL_CUSTOMERS_ACTIVATION . ' WHERE klantnummer = "'.$klantnummermail.'"';
$mail_query2 = mysqli_query($con,$mail_sql2)or die(mysqli_error());
$mail_info2 = mysqli_fetch_array($mail_query2);
$volledigmailnaam = $mail_info1['initalen'].'.'.$mail_info1['achternaam'];
$goed = "Activatie mail verstuurd.";

 // Activatie mail sturen
$to  = $mail_info1['email'];
$subject = "Welkom en activatie mail";
$message = '<html>
<body>
Hallo ' . $volledigmailnaam . ',
<br/><br/>
Dit is een herstuurde activatie mail. Uw wachtwoord word hierin niet vermeld i.v.m veiligheids overwegingen. 
<br/><br/>
Klantnummer: '.$mail_info1['klantnummer'].'<br/><br/>
Het enigste wat u nu nog hoeft te doen is je account activeren.<br/>
Klik of kopieer het linkje hier onder om uw account te activeren:
<br/><br/>
<a href="' . URL . '/activatie.php?account_activatie=' .$mail_info2['activatie_code']. '&klantnummer=' .$mail_info1['klantnummer']. '">' . URL . '/activatie.php?account_activatie=' .$mail_info2['activatie_code']. '&klantnummer=' .$mail_info1['klantnummer']. '</a>
<br/><br/>
Met vriendelijke groeten,<br/>
Developers4you.nl
</body>
</html>
';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'To: '.$volledigmailnaam.' <'.$mail_info1['email'].'>' . "\r\n";
$headers .= 'From: Developers4you <no-reply@developers4you.nl>' . "\r\n";
mail($to, $subject, $message, $headers);

}

if($_GET['maak_map'] == 1){
$dir1 = "projecten/".$_GET['klantnummer'];
$file1 = "index.php";
$goed = "Klant/project map aangemaakt.";
createDir($dir1, $file1);
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS . ' SET project_map=1 WHERE klantnummer = "'.$_GET['klantnummer'].'"');

$filename = 'projecten/'.$_GET['klantnummer'].'/index.php';
$string = MAP_INDEX;

$fp = fopen($filename, 'w');
fwrite($fp, $string);
fclose($fp);

}

if($_GET['delete_map'] == 1){
$dir1 = "projecten/".$_GET['klantnummer'];
$file1 = "index.php";
$goed = "Klant/project map aangemaakt.";
deleteDir($dir1);
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS . ' SET project_map=0 WHERE klantnummer = "'.$_GET['klantnummer'].'"');
$goed = "Project map verwijderd.";
}

if($_GET['goed'] == 1){
?>
<center><h3><font color="green">Gebruiker succesvol gewijzigd!</font></h3></center>
<?php } ?>
<center><h3><font color="green"><?php echo $goed; ?></font></h3></center>
<div class="well">
    <ul class="nav nav-tabs">
      <li <?php if($_POST['opslaan_gebruiker'] == ""){ echo 'class="active"'; } ?>><a href="#user" data-toggle="tab">Gegevens <?php echo KLANTUSERNAAM; ?></a></li>
      <li <?php if(isset($_POST['opslaan_activatie'])){ echo 'class="active"'; } ?>><a href="#activatie" data-toggle="tab">Activatie info</a></li>
	  <li><a href="#producten" data-toggle="tab">Offertes/Producten</a></li>
	  <li><a href="#map" data-toggle="tab">Map informatie</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div <?php if($_POST['opslaan_activatie'] == ""){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="user">
        Klant gegevens van <?php echo KLANTUSERNAAM; ?>. Wijzig alleen gegevens als het noodzakelijk is:
       <hr size="1">
	    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab">
        <label><?php echo $lang_account_vak_kn; ?></label>
        <input type="text" class="input-xlarge" value="<?php echo $klant_info1['klantnummer']; ?>" disabled>
        <label><?php echo $lang_account_vak_geslacht; ?></label>
        <input type="text" class="input-xlarge" value="<?php if($klant_info1['geslacht'] == 1){ echo $lang_account_vak_geslacht_dhr; } elseif($klant_info1['geslacht'] == 2){ echo $lang_account_vak_geslacht_mvr; } else { echo $lang_account_vak_geslacht_onbekend; } ?>" disabled>
        <label><?php echo $lang_account_vak_voorletters; ?></label>
        <input type="text" class="input-xlarge" value="<?php echo $klant_info1['initalen']; ?>" disabled>
        <label><?php echo $lang_account_vak_achternaam; ?></label>
        <input type="text" class="input-xlarge" value="<?php echo $klant_info1['achternaam']; ?>" disabled>
		<label>Geboortedatum (Geboortedatum nu: <?= $klant_info1['geboortedatum']; ?>)</label>
<?php
echo '<select name=geboorte_dag>';
for($x = '31'; $x > '1' - 1; $x--) {
?>
<option value="<?= $x; ?>"><?= $x; ?></option>
<?php 
}
echo '</select>';
?>

<?php
echo '<select name=geboorte_maand>';
for($x = '12'; $x > '1' - 1; $x--) {
?>
<option value="<?= $x; ?>"><?= $x; ?></option>
<?php
}
echo '</select>';
?>

<?php
echo '<select name=geboorte_jaar>';
for($x = date("Y") - 13; $x > date("Y") - 50; $x--) {
?>
<option value="<?= $x; ?>"><?= $x; ?></option>
<?php
}
echo '</select>';
?>
        <label><?php echo $lang_account_vak_adres; ?></label>
        <input type="text" class="input-xlarge" name="adres" value="<?php echo $klant_info1['adres']; ?>">	
        <label><?php echo $lang_account_vak_huisnummer; ?></label>
        <input type="text" class="input-xlarge" name="huisnummer" value="<?php echo $klant_info1['huisnummer']; ?>">
        <label><?php echo $lang_account_vak_toevoeging; ?></label>
        <input type="text" class="input-xlarge" name="toevoeging" value="<?php echo $klant_info1['toevoeginghn']; ?>">
        <label><?php echo $lang_account_vak_postcode; ?></label>
        <input type="text" class="input-xlarge" name="postcode" value="<?php echo $klant_info1['postcode']; ?>">
        <label><?php echo $lang_account_vak_huistelefoon; ?></label>
        <input type="text" class="input-xlarge" name="telefoon" value="<?php echo $klant_info1['telefoon']; ?>">
        <label><?php echo $lang_account_vak_mobiel; ?></label>
        <input type="text" class="input-xlarge" name="mobiel" value="<?php echo $klant_info1['mobile']; ?>">
        <label><?php echo $lang_account_land; ?></label>
        <select name="land" id="DropDownTimezone" class="input-xlarge">
          <option value="nl" <?php if($klant_info1['land'] == 'nl'){?> selected <?php } ?> ><?php echo $lang_account_land_nl; ?></option>
          <option value="be" <?php if($klant_info1['land'] == 'be'){?> selected <?php } ?> ><?php echo $lang_account_land_be; ?></option>
        </select>
		<hr size="1">
		Weet je zeker dat je de klant wilt wijzigen?
	     <br/><br/><input type="submit" class="btn btn-primary btn-large" name="opslaan_gebruiker" value="Wijzig <?php echo KLANTUSERNAAM; ?>">
        </form>

	   
      </div>
      <div <?php if(isset($_POST['opslaan_activatie'])){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="activatie">
       Alle activatie informatie over <?php echo KLANTUSERNAAM; ?>:
	   <hr size="1">
	   <label><strong>Geactiveerd:</strong></label>
	   <?php if($klant_info2['activatie_status'] == 1){ echo 'Ja'; } else { echo 'Nee'; } ?><br/><br/>
	   <label><strong>Activatie code</strong></label>
	   <?php echo $klant_info2['activatie_code']; ?><br/><br/>
	   <label><strong>Activatie geldig</strong></label>
	   <?php if($klant_info2['activatie_geldig'] == 1){ echo 'Ja'; } else { echo 'Nee'; } ?><br/><br/>
	   <label><strong>Herstuur activatie email:</strong></label>
	   <?php if($klant_info2['activatie_status'] == 1){ echo 'Klant al geactiveerd'; } else { ?>
	   <a href="<?= SEO_LINK.STAFF_USERS_EDIT; ?>&klantnummer=<?php echo $klant_info1['klantnummer']; ?>&verstuur_mail=1">Verstuur activatie mail</a>
	   <?php } ?>
      </div>
      <div class="tab-pane fade" id="producten">
      <center><strong>Alle producten van <?php echo KLANTUSERNAAM; ?></strong></center>
	  <hr size="1">
	   <table class="display" id="products">
      <thead>
        <tr>
		  <th>ID</th>
          <th><?php echo $lang_products_naam; ?></th>
          <th><?php echo $lang_products_budget; ?></th>
          <th><?php echo $lang_products_tijd; ?></th>
          <th><?php echo $lang_products_aanvraag; ?></th>
		  <th><?php echo $lang_products_statust; ?></th>
          <th><?php echo $lang_products_behandeld; ?></th>
		  <th>Map</th>
          <th>Factuur</th>
          <th>Opties</th>
        </tr>
      </thead>
      <tbody>
 <?php
 $product_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.$klantid.'"  AND verwijderd = 0 ORDER BY datum');
while($product_info = mysqli_fetch_array($product_sql))
{
$product_budget = $product_info['budget'].'  '.$product_info['valuta'];

$pr_factuur_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_FACTUREN . ' WHERE factuur_klantnummer = "'.$product_info['klantnummer'].'" AND factuur_koppeling_id = "'.$product_info['id'].'"';
$pr_factuur_query = mysqli_query($con,$pr_factuur_sql)or die(mysqli_error());
$pr_factuur_info = mysqli_fetch_array($pr_factuur_query);
$pr_tel_query = mysqli_num_rows($pr_factuur_query);
$pr_user_sql = 'SELECT * FROM ' . TBL_CUSTOMERS . ' WHERE klantnummer = "'.$product_info['klantnummer'].'"';
$pr_user_query = mysqli_query($con,$pr_user_sql)or die (mysqli_error());
$pr_user_info = mysqli_fetch_array($pr_user_query);
  ?> 
        <tr>
          <td><center><?php echo $product_info['id']; ?></center></td>
          <td><center><?php echo $product_info['product']; ?></center></td>
          <td><center><?php echo $product_budget; ?></center></td>
          <td><center><?php echo $product_info['tijd']; ?></center></td>
          <td><center><?php echo $product_info['datum']; ?></center></td>
          <td><center><?php if($product_info['status'] == 0){ echo 'In afwachting'; } elseif($product_info['status'] == 1){ echo 'In behandeling'; } elseif($product_info['status'] == 2){ echo 'Geannuleerd(Door Klant)'; } elseif($product_info['status'] == 3){ echo 'Afgekeurd'; } elseif($product_info['status'] == 4){ echo 'Goedgekeurd. Word ontwikkeld.'; } elseif($product_info['status'] == 5){ echo 'Klaar'; } ?></center></td>
          <td><center><?php if($product_info['behandeltdoor'] == ""){ echo '----'; } else { echo $product_info['behandeltdoor']; } ?></center></td>
		  <td><center><?php if($product_info['project_map'] == 1) { echo 'Aanwezig(<a href="'.URL.'/projecten/'.$product_info['klantnummer'].'/'.$product_info['id'].'" target="_blank">Linkje</a>)'; } else { echo 'Geen'; } ?></center></td>
          <td><center><?php if($pr_tel_query == 0){ echo 'Geen'; } else { echo '<a href="">Bekijk factuur</a>'; } ?></center></td>
          <td><center>
		      <a href="<?php echo SEO_LINK.STAFF_DIENSTEN_BEHANDEL; ?>&product_id=<?php echo $product_info['id']; ?>" role="button" data-toggle="modal"><img src="images/icons/icon_behandelen.png" alt="Product behandelen."></a>
			  <a href="<?php echo SEO_LINK.STAFF_DIENSTEN; ?>&annuleer=1&product_id=<?php echo $product_info['id']; ?>" role="button" data-toggle="modal"><img src="images/icons/icon_delete.png" alt="Delete uw offerte/product"></a>
          </center></td>
        </tr>
		
		<?php } ?>
      </tbody>
    </table>
      </div>
      <div class="tab-pane fade" id="map">
       <center><strong>Map informatie van <?php echo KLANTUSERNAAM; ?>:</strong></center>
	   <hr size="1">
	   <label><strong>Project map</strong></label>
       <?php if($klant_info1['project_map'] == 0){ ?>
	   Er is nog geen map. <a href="<?= SEO_LINK.STAFF_USERS_EDIT; ?>&klantnummer=<?= $klantid; ?>&maak_map=1">Maak map</a>
	   <?php } else { 
	   if($klant_tel4 >= 1){
	   ?>
	   Er is al een map. Maar er staan ook offerte/product mappen in. Daarom is deze map niet te verwijderen.
	   <?php } else { ?>
	   Er is al een map. Er staan geen offerte/product mappen in. <a href="<?= SEO_LINK.STAFF_USERS_EDIT; ?>&klantnummer=<?= $klantid; ?>&delete_map=1">Verwijder map</a>
	   <?php } ?>
	   <?php  } ?>
      </div>
  </div>

</div>
