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
<div class="well">
<center>Hier onder vind u een overzicht van al uw facturen.</center>
<hr size="1">
    <table class="display" id="users">
      <thead>
        <tr>
          <th>Factuur id</th>
          <th>Gekoppeld aan</th>
          <th>Aangemaakt op</th>
          <th>Prijs</th>
		  <th>Status</th>
          <th>Opties</th>
        </tr>
      </thead>
      <tbody>
 <?php
 $factuur_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_FACTUREN . ' WHERE factuur_klantnummer = "'.KLANTNUMMER.'" AND factuur_delete = 0 ORDER BY datum');
while($factuur_info = mysqli_fetch_array($factuur_sql))
{

$producten_factuur_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.KLANTNUMMER.'" AND id = "'.$factuur_info['factuur_koppeling_id'].'"';
$producten_factuur_query = mysqli_query($con,$producten_factuur_sql)or die(mysqli_error());
$producten_factuur_info = mysqli_fetch_array($producten_factuur_query);

  ?> 
        <tr>
          <td><center><?php echo $factuur_info['factuur_id']; ?></center></td>
          <td><center><?php echo $producten_factuur_info['product']; ?></center></td>
          <td><center><?php echo $factuur_info['datum']; ?></center></td>
          <td><center>&euro;<?php echo $factuur_info['factuur_prijs']; ?></center></td>
          <td><center><?php if($factuur_info['factuur_status'] == 0){ echo 'Betaald'; } elseif($factuur_info['factuur_status'] == 1) { echo 'Openstaand'; } elseif($factuur_info['factuur_status'] == 2) { echo 'Verlopen'; }  ?></center></td>
          <td><center>
		      <a href="#" role="button" data-toggle="modal"><img src="images/icons/icon_info.png" alt="Informatie over uw factuur"></a>
			  <a href="#" role="button" data-toggle="modal"><img src="images/icons/icon_delete.png" alt="Delete uw factuur"></a>
          </center></td>
        </tr>
		
		<?php } ?>
      </tbody>
    </table>
</div>


