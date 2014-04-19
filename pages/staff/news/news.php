<?php

if($_GET['verwijderd'] == 1){

$delete = "Bericht verwijderd!";

$stmt = $con->prepare('DELETE FROM ' . TBL_CUSTOMERS_NIEUWS . ' WHERE id = ?');
$stmt->bind_param('i', $_GET['newsid']);
$stmt->execute(); 
$stmt->close();

}

?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#news').dataTable( {
		    "aaSorting": [[ 4, "desc" ]],
            "oLanguage": {
                "sUrl": "lang/dataTables.txt"
            }
        } );
    } );
</script>
<div class="row-fluid">
    <div class="block span6">
        <a href="#gegevens" class="block-heading" data-toggle="collapse">Nieuws berichten overzicht</a>
        <div id="gegevenss" class="block-body collapse in">
		<center><h3><font color="green"><?php echo $delete; ?></font></h3></center>
		<table class="display" id="news">
      <thead>
        <tr>
          <th>#</th>
          <th>Titel</th>
          <th>Geschreven door</th>
          <th>Geplaatst op</th>
          <th>Opties</th>
        </tr>
      </thead>
      <tbody>
        <?php
		$d = 0;
		 $staff_news = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_NIEUWS . '');
		while($staff_news_info = mysqli_fetch_array($staff_news)){
		$d++;
?>

        <tr>
          <td><center><?php echo $d; ?></td>
          <td><center><?php echo $staff_news_info['titel']; ?></center></td>
          <td><center><?php echo $staff_news_info['naam']; ?></center></td>
          <td><center><?php echo $staff_news_info['datum']; ?></center></td>
          <td><center>
              <a href="<?= SEO_LINK.STAFF_NIEUWS_EDIT; ?>&newsid=<?php echo $staff_news_info['id'] ?>&bewerk=1"><img src="images/icons/icon_wijzig.png" alt="Wijzig dit nieuws bericht"></a>
              <a href="<?= SEO_LINK.STAFF_NIEUWS; ?>&verwijder=1&newsid=<?php echo $staff_news_info['id'] ?>" role="button" data-toggle="modal"><img src="images/icons/icon_delete.png" alt="Delete nieuws bericht"></a>
          </center></td>
        </tr>


<?php } ?>
      </tbody>
    </table>
        </div>
    </div>
	    <div class="block span6">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Nieuws toevoegen</a>
        <div id="tablewidget" class="block-body collapse in">
		<?php
		
		if(isset($_POST['opslaan_nieuws'])){
		
         $opslaan_newsnl = $_POST['nieuws_nl'];
		 $opslaan_titelnl = $_POST['titelnl'];
		 $opslaan_geschreven = KLANTNAAM;
		 
		 if(empty($opslaan_titelnl)){
		 $melding = "Er is geen nederlandse titel ingevuld.";
		 } elseif(empty($opslaan_geschreven)) {
		 $melding = "Er is geen geschreven door ingevuld";
		 } else {
		 
		 		 // UITVOEREN
		 $melding1 = "Nieuws toegevoegd";
		 
		 mysqli_query($con,'INSERT INTO ' . TBL_CUSTOMERS_NIEUWS . ' (titel, naam, klantnummer, bericht, datum) 
         VALUES ("'.$opslaan_titelnl.'", "'.$opslaan_geschreven.'", "'.$klant_nummer.'", "'.$opslaan_newsnl.'", "'.DATUM.'")');
		 
		 
		 
		}
		}
		?>
		 <center><h3><font color="green"><?php echo $melding1; ?></font></h3></center>
		 <center><h3><font color="red"><?php echo $melding; ?></font></h3></center>
		<br/>
	    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" >
		<label>Titel nederlands</label>
        <input type="text" class="input-xlarge" name="titelnl" value="<?php echo $opslaan_titelnl; ?>">
		<label>Geschreven door</label>
        <input type="text" class="input-xlarge" name="geschreven" value="<?php echo $klant_naam; ?>" disabled>
	    <label>Bericht Nederlands:</label>
        <textarea name="nieuws_nl" id="textarea" style="width:750px; height:500px;"><?php echo $opslaan_newsnl; ?></textarea><br/>
        <br/><br/>
		<input type="submit" class="btn btn-primary btn-large" name="opslaan_nieuws" value="Nieuws toevoegen!"> 
		</form>
		
        </div>
    </div>

</div>

<?php if($_GET['verwijder'] == 1){ 
$newsid = $_GET['newsid'];
?>
<div class="modal small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel">Nieuws verwijderen!</h3>
  </div>
  <div class="modal-body"> 
    <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Weet je zeker dat je dit nieuws bericht wil verwijderen?</p>
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary btn-large" id="modal_close" class="close" href="<?= SEO_LINK.STAFF_NIEUWS; ?>">Cancel</a>
    <a class="btn btn-primary btn-large" id="modal_close" class="close" href="<?= SEO_LINK.STAFF_NIEUWS; ?>&verwijderd=1&newsid=<?php echo $newsid; ?>">Verwijder!</a>
  </div>
</div>
<?php } ?>
