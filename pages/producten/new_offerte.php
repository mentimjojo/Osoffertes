<?php
 if(isset($_POST['product_opslaan'])){
 
 $product_naam = $_POST['product'];
 $product_budget = $_POST['budget'];
 $product_valuta = "Euro";
 $product_tijd = $_POST['tijd'];
 $product_oms = $_POST['omschrijving'];
 
 if(empty($product_naam)){
 $fout = $lang_offerte_fout_naam.'<br/><br/>';
 } elseif(empty($product_budget)){
 $fout = $lang_offerte_fout_budget.'<br/><br/>';
 } elseif(empty($product_tijd)){
 $fout = $lang_offerte_fout_tijd.'<br/><br/>';
 } else {
 
// UITVOEREN
		 
// User in database zetten
mysqli_query($con,'INSERT INTO ' . TBL_CUSTOMERS_PRODUCTS . ' (klantnummer, product, valuta, budget, tijd, omschrijving, datum) 
VALUES ("'.KLANTNUMMER.'", "'.$product_naam.'", "'.$product_valuta.'", "'.$product_budget.'", "'.$product_tijd.'", "'.$product_oms.'", "'.DATUM.'")');
header('Refresh: 0; url=index.php?page=' . NIEUWE_OFFERTE . '&product=1');
 }
 }
 
 $product_max2_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE klantnummer = "'.KLANTNUMMER.'" AND verwijderd = 0 AND status < 2';
 $product_max2_query = mysqli_query($con, $product_max2_sql)or die(mysqli_error());
 $product_max2_info = mysqli_num_rows($product_max2_query);
 
 if($_GET['product'] == ""){
  if($product_max2_info >= 2){ echo '<center><h3><font color="green">Helaas u heeft 2 of meer lopende producten/offerte die nog behandeld moeten worden. U kunt daarom nu dus geen product/offerte aanmaken.</font></h3></center>'; } else {
?>   
   <div class="block">
	<p class="block-heading"><?php echo $lang_offerte_new_titel; ?></p>
        <div class="block-body gallery1">
		<?php echo $lang_offerte_new_zin; ?><br/><br/>
		<hr size=1>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<font color="red"><?php echo $fout; ?></font>
        <label><?php echo $lang_offerte_new_vak_naam; ?></label>
        <input type="text" name="product" class="input-xlarge" value="<?php echo $product_naam; ?>">
        <label><?php echo $lang_offerte_new_vak_max_budget; ?></label>
        <input type="text" name="budget" class="input-xlarge" value="<?php echo $product_budget; ?>"> Euro
        <label><?php echo $lang_offerte_new_vak_tijd; ?></label>
        <input type="text" name="tijd" class="input-xlarge" value="<?php echo $product_tijd; ?>">
        <label><?php echo $lang_offerte_new_vak_productoms; ?></label>
		<textarea name="omschrijving" id="textarea" style="width:750px; height:1000px;"><?php echo $lang_offerte_new_vak_productstan; ?></textarea><br/><br/>
		<input type="submit" class="btn btn-primary btn-large" name="product_opslaan" value="<?php echo $lang_offerte_new_opslaan; ?>">
        </form>
		<?php } ?>
		<?php } elseif($_GET['product'] == 1) { ?>
		<center><h3><font color="green"><?php echo $lang_offerte_goed; ?></font></h3></center>
		<?php } ?>
            <div class="clearfix"></div>
        </div>
		    </div>