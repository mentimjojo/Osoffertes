<!DOCTYPE html>
<?php

//include
include("inc/config.php");


?>
<html lang="en">

<?php echo $style; ?>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 http-error"> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 http-error"> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 http-error"> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class="http-error"> 
  <!--<![endif]-->
    


    

    <?php
	//////////////////////////////////////////////////////////////////////
	/////////// EMAIL ACTIVATIE SYSTEM ///////////////////////////////////
	//////////////////////////////////////////////////////////////////////
	if(isset($_GET['oude_email'])){
	
	$code = $_GET['email_activation'];
	$email = $_GET['oude_email'];
	
	// SETTINGS DB BEGIN //
$sql_code_terug = 'SELECT * FROM ' . TBL_CUSTOMERS_EMAIL_CHANGES . ' WHERE email_verfi_terug_code = "'.$code.'"';
$sql_code_query = mysqli_query($con, $sql_code_terug) or die(mysqli_error());
$sql_code_info = mysqli_fetch_array($sql_code_query);
	
	if($sql_code_info['email_verfi_terug_geldig'] == 1){
	
	mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS . ' SET email="'.$email.'" WHERE klantnummer="'.$sql_code_info['klantnummer'].'"');
	mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_EMAIL_CHANGES . ' SET email_verfi=1, email_verfi_terug_geldig=0, email_verfi_geldig=0 WHERE email_verfi_terug_code="'.$code.'"');
	
	?>
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Gelukt.</p>
            <div class="block-body">
            <p> <font color="green"><strong>U oude email is terug gezet.</strong></font></p>
			<p class="return-home"><a href="index.php">Ga terug naar de home pagina.</a></p>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
	<?php } else {?>
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Niet gelukt.</p>
            <div class="block-body">
            <p> <font color="red"><strong>Deze link is niet meer geldig.</strong></font></p>
			<p class="return-home"><a href="index.php">Ga terug naar de home pagina.</a></p>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
	<?php
	}
	} elseif(isset($_GET['email_activation'])) {
	
		$code = $_GET['email_activation'];

$sql_code_geldig = 'SELECT * FROM ' . TBL_CUSTOMERS_EMAIL_CHANGES . ' WHERE email_verfi_code = "'.$code.'"';
$sql_code_query = mysqli_query($con, $sql_code_geldig) or die(mysqli_error());
$sql_code_info = mysqli_fetch_array($sql_code_query);
	
	if($sql_code_info['email_verfi_geldig'] == 1){
	
	if(isset($_GET['email_activation'])){
	$code = $_GET['email_activation'];
	mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_EMAIL_CHANGES . ' SET email_verfi=1, email_verfi_geldig=0 WHERE email_verfi_code="'.$code.'"');
	
      ?>
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Gelukt.</p>
            <div class="block-body">
            <p> <font color="green"><strong>U nieuwe email adres is geactiveerd.</strong></font></p>
			<p class="return-home"><a href="index.php">Ga terug naar de home pagina.</a></p>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
  <?php 
  } 
  } else {
   ?>
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Niet gelukt.</p>
            <div class="block-body">
            <p> <font color="red"><strong>Deze link is niet meer geldig.</strong></font></p>
			<p class="return-home"><a href="index.php">Ga terug naar de home pagina.</a></p>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
  <?php
   }  
   } 
   	//////////////////////////////////////////////////////////////////////
	/////////// EMAIL ACTIVATIE SYSTEM ///////////////////////////////////
	//////////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////////
	/////////// ACCOUNT ACTIVATIE SYSTEM /////////////////////////////////
	//////////////////////////////////////////////////////////////////////
	if(isset($_GET['account_activatie'])){
	
	$account_actief = $_GET['account_activatie'];
	$account_klant = $_GET['klantnummer'];
	
	$account_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_ACTIVATION . ' WHERE klantnummer = "'.$account_klant.'" AND activatie_code = "'.$account_actief.'"';
    $account_query = mysqli_query($con, $account_sql) or die(mysqli_error());
    $account_info = mysqli_fetch_array($account_query);
	
	if($account_info['activatie_geldig'] == 1){
	
	mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_ACTIVATION . ' SET activatie_status=1, activatie_geldig=0 WHERE klantnummer = "'.$account_klant.'" AND activatie_code = "'.$account_actief.'"');
	header('Refresh: 5; url=index.php');
   ?>
           <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Account geactiveerd.</p>
            <div class="block-body">
            <p> <font color="green">Je account is succesvol geactiveerd. Je word doorgestuurd naar de login pagina.</font></p>
			<br/><br/>
			<p class="return-home"><a href="index.php">Word je niet doorgestuurd? Klik hier.</a></p>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
   
   
   <?php } else { ?>
           <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Niet gelukt.</p>
            <div class="block-body">
            <p> <font color="red"><strong>Deze link is niet meer geldig.</strong></font></p>
			<p class="return-home"><a href="index.php">Ga terug naar de home pagina.</a></p>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
   <?php 
   }
   } ?>


    


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


