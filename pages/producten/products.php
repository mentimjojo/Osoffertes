<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#users').dataTable({
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

$goed = $lang_products_delete_bericht;
echo '<center><h3><font color="green">' . $goed . '</font></h3></center>';
}
?>
<div class="well">
<center>Hier onder vind u een overzicht van al uw producten/offertes.</center>
<hr size="1">
    <table class="display" id="users">
      <thead>
        <tr>
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
 $product_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.KLANTNUMMER.'" AND verwijderd = 0 ORDER BY datum');
while($product_info = mysqli_fetch_array($product_sql))
{
$product_budget = $product_info['budget'].'  '.$product_info['valuta'];

$pr_factuur_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_FACTUREN . ' WHERE factuur_klantnummer = "'.KLANTNUMMER.'" AND factuur_koppeling_id = "'.$product_info['id'].'"';
$pr_factuur_query = mysqli_query($con,$pr_factuur_sql)or die(mysqli_error());
$pr_factuur_info = mysqli_fetch_array($pr_factuur_query);
$pr_tel_query = mysqli_num_rows($pr_factuur_query);
  ?> 
        <tr>
          <td><center><?php echo $product_info['product']; ?></center></td>
          <td><center><?php echo $product_budget; ?></center></td>
          <td><center><?php echo $product_info['tijd']; ?></center></td>
          <td><center><?php echo $product_info['datum']; ?></center></td>
          <td><center><?php if($product_info['status'] == 0){ echo 'In afwachting'; } elseif($product_info['status'] == 1){ echo 'In behandeling'; } elseif($product_info['status'] == 2){ echo 'Geannuleerd(Door Klant)'; } elseif($product_info['status'] == 3){ echo 'Afgekeurd'; } elseif($product_info['status'] == 4){ echo 'Goedgekeurd. Word ontwikkeld.'; } elseif($product_info['status'] == 5){ echo 'Klaar'; } ?></center></td>
          <td><center><?php if($product_info['behandeltdoor'] == ""){ echo '----'; } else { echo $product_info['behandeltdoor']; } ?></center></td>
          <td><center><?php if($pr_tel_query == 0){} else { echo '<a href="">Bekijk factuur</a>'; } ?></center></td>
          <td><center>
		      <a href="index.php?page=<?php echo INFO_OFFERTE; ?>&product_id=<?php echo $product_info['id']; ?>" role="button" data-toggle="modal"><img src="images/icons/icon_info.png" alt="Informatie over uw product"></a>
			  <?php if($product_info['status'] >= 3){} else { ?>
              <a href="index.php?page=<?php echo EDIT_OFFERTE; ?>&product_id=<?php echo $product_info['id']; ?>"><img src="images/icons/icon_wijzig.png" alt="Wijzig u offerte/product"></a>
			  <?php } if($product_info['status'] >= 4){} else { ?>
			  <a href="index.php?page=<?php echo PRODUCTS; ?>&annuleer=1&product_id=<?php echo $product_info['id']; ?>" role="button" data-toggle="modal"><img src="images/icons/icon_delete.png" alt="Delete uw offerte/product"></a>
			  <?php } if($product_info['status'] == 5) { ?>
			  <a href="<?php echo URL.'/pages/producten/download'; ?>" role="button" data-toggle="modal"><img src="images/icons/icon_download.png" alt="Download uw product"></a>
			  <?php } ?>
          </center></td>
        </tr>
		
		<?php } ?>
      </tbody>
    </table>
</div>


<?php if($_GET['annuleer'] == 1){ 
$newsid = $_GET['product_id'];
?>
<div class="modal small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel"><?php echo $lang_products_delete_titel; ?></h3>
  </div>
  <div class="modal-body"> 
    <p class="error-text"><i class="icon-warning-sign modal-icon"></i><?php echo $lang_products_delete_delete; ?></p>
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=<?php echo PRODUCTS; ?>"><?php echo $lang_products_delete_cancel; ?></a>
    <a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=<?php echo PRODUCTS; ?>&annuleer=2&product_id=<?php echo $_GET['product_id']; ?>"><?php echo $lang_products_delete_ok; ?></a>
  </div>
</div>
<?php } ?>
