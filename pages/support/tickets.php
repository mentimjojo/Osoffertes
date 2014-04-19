<script type="text/javascript">
    $(document).ready(function() {
        oTable = $('#tickets').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage": {
                "sUrl": "lang/dataTables.txt"
            }
        });
    } );
</script>
<?php

if($_GET['annuleer'] == 2){

// uitvoeren
    mysqli_query($con,'UPDATE ' . TBL_CUSTOMERS_PRODUCTS . ' SET verwijderd = 1 WHERE id = "'.$_GET['product_id'].'"');

    $goed = $lang_products_delete_bericht;
    echo '<center><h3><font color="green">' . $goed . '</font></h3></center>';
}
?>
<div class="well">
    <center>Hier vind u een overzicht van uw support tickets.</center>
    <hr size="1">
    <table class="display" id="tickets">
        <thead>
        <tr>
            <th>Ticket naam</th>
            <th>Aangemaakt op</th>
            <th>Status</th>
            <th>Opties</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $ticket_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_SUPPORT_TICKETS. ' WHERE klantnummer = "'.KLANTNUMMER.'" AND ticket_verwijderd = 0 ORDER BY ticket_datum');
        while($ticket_info = mysqli_fetch_array($ticket_sql))
        {
            ?>
            <tr>
                <td><center><?php echo $ticket_info['ticket_naam']; ?></center></td>
                <td><center><?php echo $ticket_info['ticket_datum']; ?></center></td>
                <td><center><?php if($ticket_info['ticket_status'] == 0){ echo 'Open'; } elseif($ticket_info['status'] == 1){ echo 'Beantwoord'; } elseif($ticket_info['status'] == 2){ echo 'Gesloten'; } ?></center></td>
                <td><center>
                        <a href="index.php?page=<?php echo SUPPORT_TICKETS; ?>&ticket_id=<?php echo $product_info['id']; ?>" role="button" data-toggle="modal"><img src="images/icons/icon_info.png" alt="Informatie over uw Ticket"></a>
                </center></td>
            </tr>

        <?php } ?>
        </tbody>
    </table>
</div>


<?php if($_GET['annuleer'] == 1){
    $newsid = $_GET['product_id'];
    ?>
    <div class="modal small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h3 id="myModalLabel"><?php echo $lang_products_delete_titel; ?></h3>
        </div>
        <div class="modal-body">
            <p class="error-text"><i class="icon-warning-sign modal-icon"></i><?php echo $lang_products_delete_delete; ?></p>
        </div>
        <div class="modal-footer">
            <a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=<?php echo PRODUCTS; ?>"><?php echo $lang_products_delete_cancel; ?></a>
            <a class="btn btn-primary btn-large" id="modal_close" class="close" href="index.php?page=<?php echo PRODUCTS; ?>&annuleer=2&product_id=<?php echo $_GET['product_id']; ?>"><?php echo $lang_products_delete_ok; ?></a>
        </div>
    </div>
<?php } ?>
