<?php
$toegang_info_sql = 'SELECT * FROM ' . TBL_TOEGANG . ' WHERE klantnummer = "'.$_GET['klantnummer'].'"';
$toegang_info_query = mysqli_query($con,$toegang_info_sql)or die(mysqli_error());
$toegang_info_gev = mysqli_fetch_array($toegang_info_query);
$toegang_info_tel = mysqli_num_rows($toegang_info_query);

$toegang_customer_sql = 'SELECT * FROM ' . TBL_CUSTOMERS . ' WHERE klantnummer = "'.$_GET['klantnummer'].'"';
$toegang_customer_query = mysqli_query($con,$toegang_customer_sql)or die(mysqli_error());
$toegang_customer_info = mysqli_fetch_array($toegang_customer_query);
$toegang_customer_info_naam = $toegang_customer_info['initalen'].'.'.$toegang_customer_info['achternaam'];

if(isset($_POST['geef_toegang'])){
mysqli_query($con,'INSERT INTO ' . TBL_TOEGANG . ' (klantnummer) 
VALUES ("'.$_GET['klantnummer'].'")');
header('Refresh: 0; url=' . SEO_LINK . ''.STAFF_USERS_TOEGANG.'&klantnummer='.$_GET['klantnummer'].'&goed=1');
}
if(isset($_POST['delete_toegang'])){
if($toegang_info_gev['toegang_delete'] == 1){
$fout = "De toegang van deze gebruiker is niet te verwijderen.";
} else {
$stmt = $con->prepare('DELETE FROM ' . TBL_TOEGANG . ' WHERE klantnummer = ?');
$stmt->bind_param('i', $_GET['klantnummer']);
$stmt->execute(); 
$stmt->close();
header('Refresh: 0; url=' . SEO_LINK . ''.STAFF_USERS_TOEGANG.'&klantnummer='.$_GET['klantnummer'].'&goed=2');
}
}
if(isset($_POST['wijzig_toegang'])){
if($toegang_info_gev['toegang_change'] == 1){
$fout = 'De toegang van deze gebruiker is niet te wijzigen';
} else {
mysqli_query($con,'UPDATE ' . TBL_TOEGANG . ' SET toegang = "'.$_POST['toegangs'].'" WHERE klantnummer="'.$_GET['klantnummer'].'"');
header('Refresh: 0; url=' . SEO_LINK . ''.STAFF_USERS_TOEGANG.'&klantnummer='.$_GET['klantnummer'].'&goed=3');
}
}

if($_GET['goed'] == 1) {
echo '<center><h3><font color="green">Succesvol toegang in de database gezet voor ' . $toegang_customer_info_naam . '</font></h3></center>';
} elseif($_GET['goed'] == 2){
echo '<center><h3><font color="green">Succesvol toegang verwijderd van ' . $toegang_customer_info_naam . '</font></h3></center>';
} elseif($_GET['goed'] == 3){
echo '<center><h3><font color="green">Succesvol toegang gewijzigd van ' . $toegang_customer_info_naam . '</font></h3></center>';
}
?>
<center><h3><font color="red"><?= $fout; ?></font></h3></center>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Toegang informatie van <?= $toegang_customer_info_naam; ?></a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="info">
        <center><strong>Toegang informatie:</strong></center>
		<hr size="1">
		<?php if($toegang_info_tel == 0){ ?>
		Er zijn nog geen toegang gegevens voor deze gebruiker.
		<br/><br/>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab">
		<input type="submit" class="btn btn-primary btn-large" name="geef_toegang" value="Geef toegang aan deze klant.">
		</form>
		<?php } else { ?>
		Hier kun je de toegang informatie aanpassen. Info over toegang: <?= $toegang_info_gev['toegang']; ?>
		<br/><br/>
		Toegang 1 = XX<br/>
		Toegang 2 = XX<br/>
		Toegang 3 = XX<br/>
		Toegang 4 = XX<br/>
		Toegang 5 = XX<br/>
		Toegang 6 = Vanaf hier kan je erin tijdens onderhoud.<br/>
		Toegang 7 = XX<br/>
		Toegang 8 = Vanaf hier kan je klanten verwijderen.<br/>
		Toegang 9 = Vanaf hier kan je rechten aanpassen.<br/>
		Toegang 10 = Alle rechten<br/>
		<hr size="1">
		<label>Toegang (Hoe hoger, hoe mee rechten. ):</label>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab">
<?php
$opties = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
echo '<select name="toegangs">';
foreach($opties as $optie){
?>
<option value="<?= $optie; ?>" <?php if($optie == $toegang_info_gev['toegang']){ echo 'selected'; } ?>>Toegang <?= $optie; ?></option>
<?php
}
echo '</select>';
?>
		<br/><br/><input type="submit" class="btn btn-primary btn-large" name="wijzig_toegang" value="Toegang wijzigen">
		</form>
        <br/><br/>
        <br/><br/>
		<hr size="1">
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab">
		<input type="submit" class="btn btn-primary btn-large" name="delete_toegang" value="Verwijder de toegang van deze klant">
		</form>
		<?php } ?>
      </div>
  </div>

</div>