<div class="row-fluid">


	
    <div class="block">
        <a class="block-heading" data-toggle="collapse"><center><?php echo $lang_index_stats; ?></center></a>
        <div id="pages-stats" class="block-body collapse in">

            <div class="stat-widget-container">
                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?php echo KLANT_PRODUCTEN_TOTAAL_MENU; ?></p>
                        <p class="detail">Producten</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?php echo KLANT_FACTUUR_TOTAAL; ?></p>
                        <p class="detail"><?php echo $lang_index_stats_facturen; ?></p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?= KLANT_SUPPORT_TICKETS_TOTAAL; ?></p>
                        <p class="detail"><?php echo $lang_index_stats_tickets; ?></p>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="block span6">
        <a class="block-heading" data-toggle="collapse"><center>Laatste 5 facturen</center></a>
        <div id="tableswidget" class="block-body collapse in">
         		<?php
		 if(KLANT_FACTUUR_TOTAAL > 0){
		?>
        <table class="display" id="facturen">
      <thead>
        <tr>
          <th>Factuur id</th>
          <th>Factuur koppeling offerte</th>
          <th>Factuur prijs</th>
          <th>Factuur status</th>
        </tr>
      </thead>
      <tbody>
 <?php
 
 $factuur_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_FACTUREN . ' WHERE factuur_klantnummer = "'.KLANTNUMMER.'" AND factuur_delete = 0 ORDER BY datum LIMIT 5');
while($factuur_info = mysqli_fetch_array($factuur_sql)) {

$producten_factuur_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.KLANTNUMMER.'" AND id = "'.$factuur_info['factuur_koppeling_id'].'"';
$producten_factuur_query = mysqli_query($con,$producten_factuur_sql)or die(mysqli_error());
$producten_factuur_info = mysqli_fetch_array($producten_factuur_query);

  ?> 
        <tr>
          <td><center><?php echo $factuur_info['factuur_id']; ?></center></td>
          <td><center><?php echo $producten_factuur_info['product']; ?></center></td>
		  <td><center>&euro;<?php echo $factuur_info['factuur_prijs']; ?></center></td>
          <td><center><?php if($factuur_info['factuur_status'] == 0){ echo 'Betaald'; } elseif($factuur_info['factuur_status'] == 1) { echo 'Openstaand'; } elseif($factuur_info['factuur_status'] == 2) { echo 'Verlopen'; }  ?></center></td>
        </tr>
		<?php 
		} 
		?>
	</tbody>
    </table>
	<?php 
		// anders
		} elseif(KLANT_FACTUUR_TOTAAL == 0) {
		?>
        <center><strong>Er zijn nog geen facturen.</strong></center>
		<?php
		}
		?>
        </div>
    </div>
    <div class="block span6">
        <a class="block-heading" data-toggle="collapse"><center>5 nieuwste offertes/producten</center></a>
        <div id="widget1scontainer" class="block-body collapse in">
		<?php
		 if(KLANT_PRODUCTEN_TOTAAL > 0){
		?>
        <table class="display" id="products">
      <thead>
        <tr>
          <th>Product naam</th>
          <th>Aangemaakt op</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
 <?php
 
 $products_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.KLANTNUMMER.'" AND verwijderd = 0 LIMIT 5');
while($products_info = mysqli_fetch_array($products_sql))
{

  ?> 
        <tr>
          <td><center><?php echo $products_info['product']; ?></center></td>
          <td><center><?php echo $products_info['datum']; ?></center></td>
          <td><center><?php if($products_info['status'] == 0){ echo 'In afwachting'; } elseif($products_info['status'] == 1){ echo 'In behandeling'; } elseif($products_info['status'] == 2){ echo 'Geannuleerd(Door Klant)'; } elseif($products_info['status'] == 3){ echo 'Afgekeurd'; } elseif($products_info['status'] == 4){ echo 'Goedgekeurd. Word ontwikkeld.'; } elseif($products_info['status'] == 5){ echo 'Klaar'; } ?></center></td>
        </tr>
		<?php 
		} 
		?>
	</tbody>
    </table>
	<?php 
		// anders
		} elseif(KLANT_PRODUCTEN_TOTAAL == 0) {
		?>
        <center><strong>U heeft nog geen producten.</strong></center>
		<?php
		}
		?>

        </div>
    </div>
</div>




                    