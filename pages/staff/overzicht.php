<?php 
$standaard_customer_sql = 'SELECT * FROM ' . TBL_CUSTOMERS;
$standaard_customer_query = mysqli_query($con,$standaard_customer_sql)or die(mysqli_error());
$standaard_products_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_PRODUCTS . ' WHERE verwijderd = 0  ';
$standaard_products_query = mysqli_query($con,$standaard_products_sql)or die(mysqli_error());
$standaard_factuur_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_FACTUREN;
$standaard_factuur_query = mysqli_query($con,$standaard_factuur_sql)or die(mysqli_error());
$klantentotaal = mysqli_num_rows($standaard_customer_query);
$productentotaal = mysqli_num_rows($standaard_products_query);
$facturentotaal = mysqli_num_rows($standaard_factuur_query);
?>

<div class="row-fluid">
	
    <div class="block">
        <a class="block-heading" data-toggle="collapse"><center>Website stats</center></a>
        <div id="pages-stats" class="block-body collapse in">

            <div class="stat-widget-container">
                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?php echo $klantentotaal; ?></p>
                        <p class="detail">Klanten</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?php echo $productentotaal; ?></p>
                        <p class="detail">Producten</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?php echo $facturentotaal; ?></p>
                        <p class="detail">Facturen</p>
                    </div>
                </div>
				
            </div>
        </div>
    </div>
</div>
