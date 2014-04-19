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

$(document).ready(function() {
    oTable = $('#products-annuleer').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
		"oLanguage": {
       "sUrl": "lang/dataTables.txt"
         }
    });
} );
</script>
<?php

if($_GET['annuleer'] == 2){

// uitvoeren
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_PRODUCTS . ' SET verwijderd = 1 WHERE id = "'.$_GET['product_id'].'"');

$goed = 'Product/offerte verwijderd!';
echo '<center><h3><font color="green">' . $goed . '</font></h3></center>';
}
?>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#productss" data-toggle="tab">Producten/offertes</a></li>
	  <li><a href="#productsnee" data-toggle="tab">Verwijderde/geanuleerde/afgewezen Producten/offertes</a></li>
    </ul>
	
	<div id="myTabContent" class="tab-content">
	<div class="tab-pane active in" id="productss">
<center>Hier onder vind u een overzicht van alle offertes en producten. Hier kunt u de producten behandelen, verwijderen, aanpassen, etc.</center>
<hr size="1">
    <table class="display" id="products">
      <thead>
        <tr>
		  <th>ID</th>
		  <th>Van</th>
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
 $product_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE verwijderd = 0 ORDER BY datum');
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
$pr_user_tel = mysqli_num_rows($pr_user_query);
if($pr_user_tel == 1){
$pr_user_naam = $pr_user_info['initalen'].'.'.$pr_user_info['achternaam'];
} else {
$pr_user_naam = 'Account verwijderd.';
}
  ?> 
        <tr>
          <td><center><?php echo $product_info['id']; ?></center></td>
		  <td><center><?php echo $product_info['klantnummer'].' - '.$pr_user_naam; ?></center></td>
          <td><center><?php echo $product_info['product']; ?></center></td>
          <td><center><?php echo $product_budget; ?></center></td>
          <td><center><?php echo $product_info['tijd']; ?></center></td>
          <td><center><?php echo $product_info['datum']; ?></center></td>
          <td><center><?php if($product_info['status'] == 0){ echo 'In afwachting'; } elseif($product_info['status'] == 1){ echo 'In behandeling'; } elseif($product_info['status'] == 2){ echo 'Geannuleerd(Door Klant)'; } elseif($product_info['status'] == 3){ echo 'Afgekeurd'; } elseif($product_info['status'] == 4){ echo 'Goedgekeurd. Word ontwikkeld.'; } elseif($product_info['status'] == 5){ echo 'Klaar'; } ?></center></td>
          <td><center><?php if($product_info['behandeltdoor'] == ""){ echo '----'; } else { echo $product_info['behandeltdoor']; } ?></center></td>
		  <td><center><?php if($product_info['project_map'] == 1) { echo 'Aanwezig(<a href="'.URL.'/projecten/'.$product_info['klantnummer'].'/'.$product_info['id'].'" target="_blank">Linkje</a>)'; } else { echo 'Geen'; } ?></center></td>
          <td><center><?php if($pr_tel_query == 0){ echo 'Geen'; } else { echo '<a href="">Bekijk factuur</a>'; } ?></center></td>
          <td><center>
		      <a href="<?= SEO_LINK.STAFF_DIENSTEN_BEHANDEL; ?>&product_id=<?php echo $product_info['id']; ?>" role="button" data-toggle="modal"><img src="images/icons/icon_behandelen.png" alt="Product behandelen."></a>
			  <a href="<?= SEO_LINK.STAFF_DIENSTEN; ?>&annuleer=1&product_id=<?php echo $product_info['id']; ?>" role="button" data-toggle="modal"><img src="images/icons/icon_delete.png" alt="Delete uw offerte/product"></a>
          </center></td>
        </tr>

		<?php } ?>
      </tbody>
    </table>
	</div>
	
	<div class="tab-pane fade" id="productsnee">
	<center>Hier onder vind je de producten/offertes die verwijderd/geannuleerd/afgewezen zijn.</center>
<hr size="1">
    <table class="display" id="products-annuleer">
      <thead>
        <tr>
		  <th>Van</th>
          <th><?php echo $lang_products_naam; ?></th>
          <th><?php echo $lang_products_budget; ?></th>
          <th><?php echo $lang_products_tijd; ?></th>
          <th><?php echo $lang_products_aanvraag; ?></th>
		  <th><?php echo $lang_products_statust; ?></th>
          <th><?php echo $lang_products_behandeld; ?></th>
          <th>Factuur</th>
          <th>Opties</th>
        </tr>
      </thead>
      <tbody>
 <?php
 $product_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE verwijderd = 1 ORDER BY datum');
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
$pr_user_tel = mysqli_num_rows($pr_user_query);
if($pr_user_tel == 1){
$pr_user_naam = $pr_user_info['initalen'].'.'.$pr_user_info['achternaam'];
} else {
$pr_user_naam = 'Account verwijderd.';
}
  ?> 
        <tr>
		  <td><center><?php echo $product_info['klantnummer'].' - '.$pr_user_naam; ?></center></td>
          <td><center><?php echo $product_info['product']; ?></center></td>
          <td><center><?php echo $product_budget; ?></center></td>
          <td><center><?php echo $product_info['tijd']; ?></center></td>
          <td><center><?php echo $product_info['datum']; ?></center></td>
          <td><center><?php if($product_info['status'] == 0){ echo 'In afwachting'; } elseif($product_info['status'] == 1){ echo 'In behandeling'; } elseif($product_info['status'] == 2){ echo 'Geannuleerd(Door Klant)'; } elseif($product_info['status'] == 3){ echo 'Afgekeurd'; } elseif($product_info['status'] == 4){ echo 'Goedgekeurd. Word ontwikkeld.'; } elseif($product_info['status'] == 5){ echo 'Klaar'; } ?></center></td>
          <td><center><?php if($product_info['behandeltdoor'] == ""){ echo '----'; } else { echo $product_info['behandeltdoor']; } ?></center></td>
          <td><center><?php if($pr_tel_query == 0){} else { echo '<a href="">Bekijk factuur</a>'; } ?></center></td>
          <td><center>
          </center></td>
        </tr>
		
		<?php } ?>
      </tbody>
    </table>
	</div>
	</div>
</div>


<?php if($_GET['annuleer'] == 1){ 
$newsid = $_GET['product_id'];
?>
<div class="modal small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel">Product/offerte verwijderen.</h3>
  </div>
  <div class="modal-body"> 
    <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Weet u zeker dat u dit product/offerte wilt verwijderen?</p>
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary btn-large" id="modal_close" class="close" href="<?= SEO_LINK.STAFF_DIENSTEN; ?>">Nee stop.</a>
    <a class="btn btn-primary btn-large" id="modal_close" class="close" href="<?= SEO_LINK.STAFF_DIENSTEN; ?>&annuleer=2&product_id=<?php echo $_GET['product_id']; ?>">Ja verwijderd.</a>
  </div>
</div>
<?php } ?>
