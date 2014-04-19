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
    <div class="http-error">
        <div class="http-error-message">
            <div class="error-caption">
                <p><?php echo $lang_error404_oops; ?></p>
            </div>
            <div class="error-message">
                <p><?php echo $lang_error404_zin; ?><p>
                <p class="return-home"><a href="index.php"><?php echo $lang_error404_terug; ?></a></p>
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


