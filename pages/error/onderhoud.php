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
    


    

        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Onderhoud.</p>
            <div class="block-body">
            <strong>Ons klantenpaneel is momenteel niet bereikbaar vanwege onderhoud. De reden hiervoor is:</strong>
			<hr size="1">
			<?php echo ONDERHOUD_BERICHT; ?>
			<hr size="1">
		<a href="aanmelden.php">Registeren</a>
        <p class="pull-right" style=""><a href="#"><?php echo $lang_copyby; ?></a></p>
            </div>
        </div>
    </div>
</div>
	





    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


