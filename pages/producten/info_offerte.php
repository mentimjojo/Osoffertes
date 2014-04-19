<?php

define("PRODUCT_ID", $_GET['product_id']); 

$pr_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE id = "'.PRODUCT_ID.'" AND klantnummer = "'.KLANTNUMMER.'"';
$pr_query = mysqli_query($con, $pr_sql)or die(mysqli_error());
$pr_info = mysqli_fetch_array($pr_query);

if($pr_info['gewijzigd'] == 0){
define("PRODUCT_NAAM", $pr_info['product']);
define("PRODUCT_BUDGET", $pr_info['budget']);
define("PRODUCT_TIJD", $pr_info['tijd']);
define("PRODUCT_OMS", $pr_info['omschrijving']);
} elseif($pr_info['gewijzigd'] == 1){
define("PRODUCT_NAAM", $pr_info['product']);
define("PRODUCT_BUDGET", $pr_info['budget_wijzig']);
define("PRODUCT_TIJD", $pr_info['tijd_wijzig']);
define("PRODUCT_OMS", $pr_info['omschrijving_wijzig']);
}

?>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Gegevens offerte</a></li>
      <li><a href="#status" data-toggle="tab">Status(ontwikkeling) offerte</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="info">
        <h4>Alle gegevens over uw product/offerte <u><?php echo PRODUCT_NAAM; ?></u></h4>
		<hr size="1">
		<strong>Product/offerte naam</strong><br/>	
		<?php echo PRODUCT_NAAM; ?><br/><br/>	
		<strong>Product/offerte budget</strong><br/>	
		&euro;<?php echo PRODUCT_BUDGET; ?><br/><br/>	
		<strong>Product/offerte tijdsbestek</strong><br/>	
		<?php echo PRODUCT_TIJD; ?><br/><br/>	
		<?php if($pr_info['status'] == 4){ ?>
		<strong>Project link (Via hier kun je mee kijken)</strong><br/>	
		<a href="<?= $pr_info['project_link'] ?>" target="_blank">Klik hier</a><br/><br/>	
		<?php } ?>
		<?php if($pr_info['status'] == 5){ ?>
		<strong>Download link van uw product/offerte</strong><br/>	
		<a href="<?php echo URL."/pages/producten/download/".$pr_info['project_download']; ?>" target="_blank">Klik hier</a><br/><br/>	
		<?php } ?>
		<strong>Product/offerte omschrijving</strong>
		<hr size="1">
		<?php echo PRODUCT_OMS; ?>
      </div>
      <div class="tab-pane fade" id="status">
	  	<h4>Alle status informatie</h4>
		<hr size="1">
        <strong>Status</strong><br/>
		<?php if($pr_info['status'] == 0){ echo 'In afwachting'; } elseif($pr_info['status'] == 1){ echo 'In behandeling'; } elseif($pr_info['status'] == 2){ echo 'Geannuleerd(Door Klant)'; } elseif($pr_info['status'] == 3){ echo 'Afgekeurd'; } elseif($pr_info['status'] == 4){ echo 'Goedgekeurd. Word ontwikkeld.'; } elseif($pr_info['status'] == 5){ echo 'Klaar'; } ?><br/><br/>
		<strong>Status omschrijving(Waarom deze status?)</strong>
		<hr size="1">
		<?php if($pr_info['status_omschrijving'] == ""){ echo 'Nog geen status omschrijving'; } else { echo $pr_info['status_omschrijving']; } ?>
      </div>
  </div>

</div>