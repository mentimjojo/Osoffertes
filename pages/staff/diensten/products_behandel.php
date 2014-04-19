<?php 

// Product informatie
$product_id = $_GET['product_id'];
$product_info_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE id = "'.$product_id.'"';
$product_info_query = mysqli_query($con,$product_info_sql)or die(mysqli_error());
$product_info = mysqli_fetch_array($product_info_query);
if($product_info['gewijzigd'] == 1) {
define("PRODUCT_NAAM", $product_info['product']);
define("PRODUCT_BUDGET", $product_info['budget_wijzig']);
define("PRODUCT_TIJD", $product_info['tijd_wijzig']);
define("PRODUCT_OMS", $product_info['omschrijving_wijzig']);
} else {
define("PRODUCT_NAAM", $product_info['product']);
define("PRODUCT_BUDGET", $product_info['budget']);
define("PRODUCT_TIJD", $product_info['tijd']);
define("PRODUCT_OMS", $product_info['omschrijving']);
}

// Gegevens opslaan
if(isset($_POST['offerte_opslaan'])) {
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_PRODUCTS . ' SET status = "'.$_POST['status_offerte'].'", project_download = "'.$_POST['project_download'].'", status_omschrijving = "'.$_POST['status_reden'].'", project_info = "'.$_POST['status_staff'].'" WHERE id="'.$product_id.'"');
$goed = "Product/offerte behandeld! U kunt een product/offerte vaker behandelen.";

}

//Map dir
$dir1 = "projecten/".$product_info['klantnummer'];
$dir2 = "projecten/".$product_info['klantnummer']."/".$product_info['id'];
$dir3 = "projecten/".$product_info['klantnummer']."/".$product_info['id']."/download";
$file1 = "index.php";
// Map verwijder
if($_GET['verwijder_map'] == 1){
deleteDir($dir3);
deleteDir($dir2);
$project_link1 = "";
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_PRODUCTS . ' SET project_map=0 WHERE id = "'.$product_id.'"');
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_PRODUCTS . ' SET project_link = "'.$project_link1.'" WHERE id = "'.$product_id.'"');
$goed = 'Project map verwijderd!';
}
// Map maak
if($_GET['maak_map'] == 1){

if(PROJECT_MAP == 0){
createDir($dir1, $file1);
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS . ' SET project_map=1 WHERE klantnummer = "'.$product_info['klantnummer'].'"');

$filename = 'projecten/'.$product_info['klantnummer'].'/index.php';
$string = MAP_INDEX;
$fp = fopen($filename, 'w');
fwrite($fp, $string);
fclose($fp);

}

createDir($dir2, $file1);
createDir($dir3, $file1);
$project_link = URL.'/projecten/'.$product_info['klantnummer'].'/'.$product_id.'/index.php';
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_PRODUCTS . ' SET project_map=1 WHERE id = "'.$product_id.'"');
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_PRODUCTS . ' SET project_link = "'.$project_link.'" WHERE id = "'.$product_id.'"');
$goed = 'Project map gemaakt!';

$filename1 = 'projecten/'.$product_info['klantnummer'].'/'.$product_info['id'].'/index.php';
$string1 = "<center><strong>Dit is de standaard index van een product/offerte map</strong></center>";
$fp1 = fopen($filename1, 'w');
fwrite($fp1, $string1);
fclose($fp1);

$filename2 = 'projecten/'.$product_info['klantnummer'].'/'.$product_info['id'].'/download/index.php';
$string2 = "<center><strong>Dit is de standaard index van een download map.</strong></center>";
$fp2 = fopen($filename2, 'w');
fwrite($fp2, $string2);
fclose($fp2);

}
if($_GET['maak_ftp'] == 1) {
$pass = mt_rand();
system("useradd ".$product_info['klantnummer']."_".$product_info['id']." -p ".$pass." -d /home/$user");
$goed = 'Ftp user gemaakt.';
}


?>
<center><h3><font color="green"><?php echo $goed; ?></font></h3></center>
<div class="well">
    <ul class="nav nav-tabs">
      <li <?php if($_POST['offerte_opslaan'] == ""){ ?>class="active"<?php } ?>><a href="#info" data-toggle="tab">Product/offerte informatie</a></li>
      <li <?php if($_POST['offerte_opslaan'] == ""){ } else {?>class="active"<?php } ?>><a href="#change" data-toggle="tab">Product/offerte behandelen&edit</a></li>
      <li><a href="#project" data-toggle="tab">Project info</a></li>
	  <li><a href="#factuur" data-toggle="tab">Product/offerte factuur toevoegen</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div <?php if($_POST['offerte_opslaan'] == ""){ ?>class="tab-pane active in"<?php } else { ?>class="tab-pane fade"<?php } ?> id="info">
        Informatie over het product/offerte:
		<hr size="1">
		<label><strong>Product naam</strong></label>
		<?php echo PRODUCT_NAAM; ?><br/><br/>
		<label><strong>product status</strong></label>
		<?php if($product_info['status'] == 0){ echo 'In afwachting'; } elseif($product_info['status'] == 1){ echo 'In behandeling'; } elseif($product_info['status'] == 2){ echo 'Geannuleerd(Door Klant)'; } elseif($product_info['status'] == 3){ echo 'Afgekeurd'; } elseif($product_info['status'] == 4){ echo 'Goedgekeurd. Word ontwikkeld.'; } elseif($product_info['status'] == 5){ echo 'Klaar'; } ?><br/><br/>
		<label><strong>Budget</strong></label>
		<?php echo PRODUCT_BUDGET; ?> Euro<br/><br/>
		<label><strong>Tijd</strong></label>
		<?php echo PRODUCT_TIJD; ?><br/><br/>
		<label>Link van het project (Onder welke link word aan het project gewerkt):</label>
		<?php if($product_info['project_link'] == "") { echo 'Geen'; } else { echo '<a href="'.$product_info['project_link'].'" target="_blank">Klik hier</a>'; } ?><br/><br/>
		<label><strong>Product omschrijving</strong></label>
		<hr size="1">
		<?php echo PRODUCT_OMS; ?>
		<hr size="1">
		<label><strong>Product (project) link</strong></label>
		<?php  if(empty($product_info['project_link'])) { echo 'Geen'; } else { echo $product_info['project_link']; } ?><br/><br/>
		<label><strong>Product (project) status info</strong></label>
		<hr size="1">
		<?php  if(empty($product_info['project_info'])) { echo 'Geen'; } else { echo $product_info['project_info']; } ?>
      </div>
      <div <?php if($_POST['offerte_opslaan'] == ""){ ?>class="tab-pane fade"<?php } else { ?>class="tab-pane active in"<?php } ?> id="change">
      Hier kun je dit product/offerte behandelen:
		<hr size="1">
	  	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<label>Status aanpassen:</label>
	<select name="status_offerte" id="DropDownTimezone" class="input-xlarge">
          <option value="1" <?php if($product_info['status'] == 1){ echo 'selected'; } ?> >In behandeling zetten</option>
          <option value="3" <?php if($product_info['status'] == 3){ echo 'selected'; } ?>>Afkeuren</option>
		  <option value="4" <?php if($product_info['status'] == 4){ echo 'selected'; } ?>>Goedkeuren</option>
		  <option value="5" <?php if($product_info['status'] == 5){ echo 'selected'; } ?>>Klaar</option>
    </select><br/><Br/>
		<label>Link van het project (Onder welke link word aan het project gewerkt):</label>
		<?php if($product_info['project_link'] == "") { echo 'Geen'; } else { echo '<a href="'.$product_info['project_link'].'" target="_blank">Klik hier</a>'; } ?><br/><br/>
		<label>Download link(Als het project/offerte/product klaar is voor de klant):</label>
		<input type="text" name="project_download" value="<?php echo $product_info['project_download']; ?>" >
	    <label>Reden van status:</label>
		<textarea name="status_reden" id="textarea"><?php echo $product_info['status_omschrijving']; ?></textarea><br/><br/>
	    <label>Informatie voor staff:</label>
		<textarea name="status_staff" id="textarea1"><?php echo $product_info['project_info']; ?></textarea><br/><br/>
		<input type="submit" class="btn btn-primary btn-large" name="offerte_opslaan" value="Offerte behandelen!">
		</form>
      </div>
      <div class="tab-pane fade" id="project">
      Project map/ftp informatie:
	  <hr size="1">
	  <label><strong>Project map van offerte: </label></strong>
	  <?php if($product_info['project_map'] == 0){ ?>
	  <a href="<?= SEO_LINK.STAFF_DIENSTEN_BEHANDEL; ?>&product_id=<?= $product_id; ?>&maak_map=1">Maak map</a><br/>
	  <?php } else { ?>
	  <a href="<?= URL.'/projecten/'.$product_info['klantnummer'].'/'.$product_info['id'].'/'; ?>" target="_blank">Klik hier voor de project map.</a><br/>
	  <?php if(TOEGANG == 10) { ?>
	  <a href="<?= SEO_LINK.STAFF_DIENSTEN_BEHANDEL; ?>&product_id=<?= $product_id; ?>&verwijder_map=1">Verwijder map</a>
	  <?php } } ?>
	  <br/><br/><label><strong>Download map van offerte:</strong></label>
	  <?php if($product_info['project_map'] == 1){ ?>
	  <a href="<?= URL.'/projecten/'.$product_info['klantnummer'].'/'.$product_info['id'].'/download/'; ?>" target="_blank"><?= URL.'/projecten/'.$product_info['klantnummer'].'/'.$product_info['id'].'/download/'; ?></a><br/>
	  <?php } else { ?>
	   Nog geen download map.
	   <?php } ?>
      </div>
      <div class="tab-pane fade" id="factuur">
      Voeg een factuur toe aan dit product/offerte:
      </div>
  </div>

</div>