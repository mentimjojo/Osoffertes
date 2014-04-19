<?php

if($_GET['delete'] == 2){

$delete = "Klant verwijderd!";

$stmt = $con->prepare('DELETE FROM ' . TBL_CUSTOMERS . ' WHERE klantnummer = ?');
$stmt->bind_param('i', $_GET['klantnummer']);
$stmt->execute(); 
$stmt->close();
$stmt = $con->prepare('DELETE FROM ' . TBL_CUSTOMERS_ACTIVATION . ' WHERE klantnummer = ?');
$stmt->bind_param('i', $_GET['klantnummer']);
$stmt->execute(); 
$stmt->close();
$stmt = $con->prepare('DELETE FROM ' . TBL_CUSTOMERS_EMAIL_CHANGES . ' WHERE klantnummer = ?');
$stmt->bind_param('i', $_GET['klantnummer']);
$stmt->execute(); 
$stmt->close();
$stmt = $con->prepare('DELETE FROM ' . TBL_CUSTOMERS_REGISTRATIE . ' WHERE klantnummer = ?');
$stmt->bind_param('i', $_GET['klantnummer']);
$stmt->execute();
$stmt->close();

}
?>
<center><h3><font color="green"><?php echo $delete; ?></font></h3></center>
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-plus"></i> Nieuwe gebruiker</button>
  <div class="btn-group">
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#users').dataTable( {
            "oLanguage": {
                "sUrl": "lang/dataTables.txt"
            }
        } );
    } );
</script>
<div class="well">
    <center><strong>Hier vind je een overzicht van alle klanten. Via het zoek balkje rechts kun je een klant vinden. Hierin kun je alles invullen, postcode, huisnummer, etc.</strong></center>
	<hr size="1">
    <table class="display" id="users">
      <thead>
        <tr>
          <th>Naam</th>
          <th>Klantnummer</th>
          <th>Geboortedatum</th>
          <th>Postcode</th>
          <th>Huisnummer</th>
          <th>Geactiveerd</th>
          <th>Producten/offertes</th>
		  <th>Map info</th>
          <th>Opties</th>
        </tr>
      </thead>
      <tbody>
 <?php
 $staff_users = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS . '');
while($staff_users_info = mysqli_fetch_array($staff_users))
{
 $staff_users2 = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.$staff_users_info['klantnummer'].'" AND verwijderd = 0');
 $staff_users3 = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.$staff_users_info['klantnummer'].'" AND verwijderd = 1');
 $staff_users4 = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_ACTIVATION . ' WHERE klantnummer = "'.$staff_users_info['klantnummer'].'"');
 $staff_users2_products = mysqli_num_rows($staff_users2);
 $staff_users3_products = mysqli_num_rows($staff_users3);
 $staff_users4_activation = mysqli_fetch_array($staff_users4);
 $staff_user_name = $staff_users_info['initalen'].'.'.$staff_users_info['achternaam'];
 
  ?> 
        <tr>
          <td><center><?php echo $staff_user_name; ?></center></td>
          <td><center><?php echo $staff_users_info['klantnummer']; ?></center></td>
		  <td><center><?php echo $staff_users_info['geboortedatum']; ?></center></td>
		  <td><center><?php echo $staff_users_info['postcode']; ?></center></td>
	      <td><center><?php echo $staff_users_info['huisnummer'].$staff_users_info['toevoeginghn']; ?></center></td>
          <td><center><?php if($staff_users4_activation['activatie_status'] == 1){ echo 'Ja'; } else { echo 'Nee'; } ?></center></td>
          <td><center><?php echo $staff_users2_products.' product(en) | '.$staff_users3_products.' geannuleerde producten'; ?></center></td>
		   <td><center><?php if($staff_users_info['project_map'] == 1){ echo 'Aanwezig(<a href="'.URL.'/projecten/'.$staff_users_info['klantnummer'].'/index.php" target="_blank">Link</a>)'; } else { echo 'Niet aanwezig'; } ?></center></td>
          <td><center>
              <a href="index.php?page=<?php echo STAFF_USERS_EDIT; ?>&klantnummer=<?php echo $staff_users_info['klantnummer']; ?>"><img src="images/icons/icon_wijzig.png" alt="Wijzig gebruiker"></a>
			  <?php if(TOEGANG == 10){ ?>
              <a href="index.php?page=<?= STAFF_USERS_TOEGANG; ?>&klantnummer=<?= $staff_users_info['klantnummer'] ?>" role="button" data-toggle="modal"><img src="images/icons/icon_toegang.png" alt="Toegang gebruiker"></a>
			  <?php } ?>
			  <?php if(TOEGANG >= 8){ ?>
              <a href="index.php?page=<?php echo STAFF_USERS; ?>&delete=1&klantnummer=<?php echo $staff_users_info['klantnummer']; ?>" role="button" data-toggle="modal"><img src="images/icons/icon_delete.png" alt="Verwijder gebruiker"></a>
			  <?php } ?>
          </center></td>
        </tr>
		
		<?php } ?>
      </tbody>
    </table>
</div>


<?php if($_GET['delete'] == 1){ 
$klantdelete = $_GET['klantnummer'];
?>
<div class="modal small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel">Klant verwijderen.</h3>
  </div>
  <div class="modal-body"> 
    <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Weet je zeker dat je deze klant wilt verwijderen?!</p>
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=<?php echo STAFF_USERS; ?>">Annuleren.</a>
    <a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=<?php echo STAFF_USERS; ?>&delete=2&klantnummer=<?php echo $klantdelete; ?>">Ja verwijder!</a>
  </div>
</div>
<?php } ?>



                


