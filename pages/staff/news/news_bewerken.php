<?php
$newsid = $_GET['newsid'];

$news_edit_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_NIEUWS . ' WHERE id = "'.$newsid.'"';
$news_edit_query = mysqli_query($con,$news_edit_sql)or die(mysqli_error());
$news_edit = mysqli_fetch_array($news_edit_query);

if(isset($_POST['opslaan_edit'])){

$edit_titelnl = $_POST['titel_nl'];
$edit_berichtnl = $_POST['nieuws_nl'];

if(empty($edit_titelnl)){
$melding = "Nederlandse titel is niet ingevuld";
} else {

// uitvoeren
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_NIEUWS . ' SET titel="'.$edit_titelnl.'", bericht="'.$edit_berichtnl.'" WHERE id="'.$newsid.'"');
header('Refresh: 0; url=index.php?page=' . STAFF_NIEUWS_EDIT . '&newsid=6&bewerk=0');
}
}

$melding1 = "Nieuws succesvol gewijzigd. Je word doorgestuurd!";

?> 
    <div class="block">
	<p class="block-heading">Nieuws bericht bewerken: </p>
        <div class="block-body gallery1">
		<?php if($_GET['bewerk'] == 0){ 
		header('Refresh: 5; url=index.php?page=' . STAFF_NIEUWS . '');
		?>
         <center><h3><font color="green"><?php echo $melding1; ?></font></h3></center>
		 <center><h3><font color="red"><?php echo $melding; ?></font></h3></center>
		 <?php } elseif($_GET['bewerk'] == 1) { ?>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab2">
        <label>Nederlands titel</label>
        <input type="text" class="input-xlarge" name="titel_nl" value="<?php echo $news_edit['titel']; ?>">
	    <label>Bericht Nederlands:</label>
        <textarea name="nieuws_nl" id="textarea" style="width:750px; height:500px;"><?php echo $news_edit['bericht']; ?></textarea><br/>
        <br/><br/><input type="submit" class="btn btn-primary btn-large" name="opslaan_edit" value="Opslaan">
    </form>
             <?php } ?>   
				
				
				
            <div class="clearfix"></div>
        </div>
		    </div>