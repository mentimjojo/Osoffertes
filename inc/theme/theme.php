<html lang="en">

    <?php 
	echo $style; 
    echo $balk; 
	
	if(TOEGANG_LOC == 1) {
	if(TOEGANG > "0"){ 
	?>
						    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> Beheer
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="index.php?page=<?php echo STAFF_OVERZICHT; ?>">Overzicht</a></li>
                            <li class="divider"></li>
							<li><a tabindex="-1" href="index.php?page=<?php echo STAFF_NIEUWS; ?>">Nieuws afdeling</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="index.php?page=<?php echo STAFF_USERS; ?>">Klanten afdeling</a></li>
							<li class="divider"></li>
                            <li><a tabindex="-1" href="index.php?page=<?php echo STAFF_DIENSTEN; ?>">Offertes/Producten afdeling</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="index.php?page=">Support afdeling</a></li>
							<?php if(TOEGANG == 10){ ?>
							<li class="divider"></li>
                            <li><a tabindex="-1" href="index.php?page=<?php echo STAFF_INFO; ?>">Systeem/software informatie</a></li>
							<li class="divider"></li>
                            <li><a tabindex="-1" href="index.php?page=<?php echo STAFF_SETTINGS; ?>">Website instellingen<?php if(ONDERHOUD == 1){ echo ' <i><font color="red">(In onderhoud)</font></i>'; } ?></a></li>
							<?php } ?>
                        </ul>
                    </li>
   <?php
	
	} else { } 
	}

    echo $balk2; 

    ?>

    <div class="sidebar-nav">
        <br/>

        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard<i class="icon-chevron-up"></i></a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><a href="<?= SEO_LINK . HOME; ?>">Home</a></li>
            <li ><a href="<?=  SEO_LINK . NEWS; ?>">Nieuws</a></li>
        </ul>

        <a href="#products-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Producten<i class="icon-chevron-up"></i></a>
        <ul id="products-menu" class="nav nav-list collapse in">
            <li ><a href="<?=  SEO_LINK . PRODUCTS; ?>">Producten <span class="label label-info"><?=  KLANT_PRODUCTEN_TOTAAL_MENU; ?></a></span></li>
            <li ><a href="<?=  SEO_LINK . NIEUWE_OFFERTE; ?>">Nieuw product/offerte</a></li>
            <li ><a href="<?=  SEO_LINK . FACTUREN; ?>">Facturen <span class="label label-info"><?=  KLANT_FACTUUR_TOTAAL_MENU; ?></a></span></li>
        </ul>

        <a href="#support-menu" class="nav-header" data-toggle="collapse"><i class="icon-question-sign"></i>Support<i class="icon-chevron-up"></i></a>
        <ul id="support-menu" class="nav nav-list collapse in">
            <li ><a href="#">Veel gestelde vragen</a></li>
            <li ><a href="#">Forum</a></li>
            <li ><a href="<?= SEO_LINK . SUPPORT_TICKETS; ?>">Support tickets</a></li>
            <li ><a href="<?= SEO_LINK . SUPPORT_TICKETS_NEW; ?>">Nieuwe support ticket</a></li>
        </ul>

	<?php
	if(TOEGANG_LOC == 0) {
	if(TOEGANG > "0"){ 
	?>

	
	        <a href="#support-menu" class="nav-header" data-toggle="collapse"><i class="icon-question-sign"></i>Staff<i class="icon-chevron-up"></i></a>
        <ul id="support-menu" class="nav nav-list collapse in">
            <li ><a href="index.php?page=<?php echo STAFF_OVERZICHT; ?>">Overzicht</a></li>
			<li ><a href="index.php?page=<?php echo STAFF_NIEUWS; ?>">Nieuws afdelig</a></li>
            <li ><a href="index.php?page=<?php echo STAFF_USERS; ?>">Klanten afdeling</a></li>
            <li ><a href="index.php?page=<?php echo STAFF_DIENSTEN; ?>">Offertes/producten afdeling</a></li>
            <li ><a href="index.php?page=">Support afdeling</a></li>
            <?php if(TOEGANG == 10){ ?>
            <li ><a href="index.php?page=<?php echo STAFF_INFO; ?>">Systeem/software informatie</a></li>
            <li ><a href="index.php?page=<?php echo STAFF_SETTINGS; ?>">Website instellingen</a></li>
            <?php } ?>
        </ul>

	<?php } } echo '</div>'; ?>
	
	
	<div class="content">
        
        <div class="header">

            <h1 class="page-title">Dashboard</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><li class="active">Dashboard</li> <span class="divider">/</span></li>
			<a href="index.php?page=<?php echo $page; if($_GET['product_id'] == ""){} else { echo '&product_id='.$_GET['product_id']; } if($_GET['newsid'] == 0){} else { echo '&newsid='.$_GET['newsid'].'&bewerk=1'; } ?>"><?php echo $page; ?></a>
        </ul>
		<?php
		
		if($_GET['close'] == 1){
		mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS . ' SET nieuws_balk_read=1 WHERE klantnummer="'.KLANTNUMMER.'"');
		header('Refresh: 0; url=index.php?page=' . $page);
		}
		
		if($gev2['nieuws_balk_read'] == 0){
		?>
				<div class="alert alert-info">
        <a class="close" href="index.php?page=<?php echo $page; ?>&close=1">�</a>
        <strong><?php echo $lang_index_nieuws; ?></strong> <?php echo $settings_nieuws; ?>	
        </div>
		<?php
		} else {}
		?>

        <div class="container-fluid">
	    <div class="row-fluid">
	
	
	<?php 
	// page krijgen // 
    include(PAGE_INCLUDE);          
	?>
	
	                 <?php echo $footer; ?>
					 
                 </div>
            </div>
        </div>
    </div>
    

    


    <script src="<?php echo URL; ?>/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
		$('#modal_close').click(
			function(){
				$('#myModal').fadeOut();
				});
		
		CKEDITOR.replace( 'textarea' );
		CKEDITOR.replace( 'textarea1' );
    </script>
  </body>
</html>