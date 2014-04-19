<?php
$product_id = $_GET['product_id'];
$product_edit_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE id = "'.$product_id.'"';
$product_edit_query = mysqli_query($con,$product_edit_sql)or die(mysqli_error());
$product_edit_gev = mysqli_fetch_array($product_edit_query);

if(isset($_POST['opslaan_edit'])){

$pr_budget = $_POST['product_budget'];
$pr_tijd = $_POST['product_tijd'];
$pr_oms = $_POST['product_oms'];

if(empty($pr_budget)){
$fout = "Er moet een budget ingevuld zijn.<br/><br/>";
} elseif(empty($pr_tijd)){
$fout = "Er moet een tijdsbestek ingevuld zijn.<br/><br/>";
} elseif(empty($pr_oms)){
$fout = "Er moet een omschrijving ingevuld zijn.<br/><br/>";
} else {

// uitvoeren
mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_PRODUCTS . ' SET budget_wijzig="'.$pr_budget.'", tijd_wijzig="'.$pr_tijd.'", omschrijving_wijzig="'.$pr_oms.'", gewijzigd=1 WHERE id="'.$product_id.'"');
header('Refresh: 0; url=' . SEO_LINK . '' . EDIT_OFFERTE . '&product_id=2&bewerkt=1');

}
}

?>    
   <div class="block">
   <?php
   if($_GET['bewerkt'] == ""){
   if($product_edit_gev['gewijzigd'] == 0){ 
   ?>
	<p class="block-heading">Offerte wijzigen - <?php echo $product_edit_gev['product']; ?></p>
        <div class="block-body gallery1">
		Hier kunt u &euml;&euml;nmalig u product wijzigen. <strong>Let op:</strong> De product/offerte naam is niet te wijzigen<br/>
		<hr size=1>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="tab2">
	    <font color="red"><?php echo $fout; ?></font>
		<label>Product Budget</label>
		<input type="text" name="product_budget" class="input-xlarge" value="<?php echo $product_edit_gev['budget']; ?>">  Euro
		<label>Product tijdsbestek</label>
		<input type="text" name="product_tijd" class="input-xlarge" value="<?php echo $product_edit_gev['tijd']; ?>">
		<label>Product omschrijving</label>
		<textarea name="product_oms" id="textarea" style="width:750px; height:500px;"><?php echo $product_edit_gev['omschrijving']; ?></textarea>
        <br/><br/><input type="submit" class="btn btn-primary btn-large" name="opslaan_edit" value="Opslaan">
    </form>
	<?php
	} else { 
	header('Refresh: 5; url=' . SEO_LINK . '' . PRODUCTS . '');
	?>
		<p class="block-heading" align="center">Product al 1 keer gewijzigd!</p>
        <div class="block-body gallery1">
		<center><h3><font color="red">Helaas dit product is al eens gewijzigd. U word doorgestuurd naar uw product/offerte overzicht.</font></h3></center>
	<?php } ?>
            <div class="clearfix"></div>
        </div>
		    </div>
	<?php } else { 
	header('Refresh: 5; url=' . SEO_LINK . '' . PRODUCTS . '');
	?>
    <center><h3><font color="green">U product/offerte is gewijzigd. Dit product is nu niet meer te wijzigen. U word doorgestuurd naar uw product/offerte overzicht.</font></h3></center>
    <?php } ?>	