<?php
if(isset($_POST['ticket_opslaan'])){

    $ticket_naam = $_POST['ticket_naam'];
    $ticket_oms = $_POST['ticket_oms'];

    if(empty($ticket_naam)){
        $fout = "Er is geen ticket naam ingevuld";
    } else {

        // Uitvoeren
        mysqli_query($con,'INSERT INTO ' . TBL_CUSTOMERS_SUPPORT_TICKETS . ' (klantnummer, ticket_naam, ticket_datum, ticket_text)
        VALUES ("'.KLANTNUMMER.'", "'.$ticket_naam.'", "'.$ticket_oms.'", "'.DATUM.'")');
        header('Refresh: 0; url=index.php?page=' . SUPPORT_TICKETS_NEW . '&ticket=1');
    }
}

$ticket_max2_sql = 'SELECT * FROM ' . TBL_CUSTOMERS_SUPPORT_TICKETS . ' WHERE klantnummer = "'.KLANTNUMMER.'" AND ticket_verwijderd = 0 AND ticket_status = 0';
$ticket_max2_query = mysqli_query($con, $ticket_max2_sql)or die(mysqli_error());
$ticket_max2_info = mysqli_num_rows($ticket_max2_query);

if($_GET['ticket'] == ""){
if($ticket_max2_info >= 3){ echo '<center><h3><font color="green">U heeft op dit moment 2 lopende support ticket. Hierom kunt u op dit moment geen nieuwe tickets aanmaken.</font></h3></center>'; } else {
?>
<div class="block">
    <p class="block-heading">Nieuwe support ticket</p>
    <div class="block-body gallery1">
        Nieuwe support ticket aanmaken<br/><br/>
        <hr size=1>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <font color="red"><?php echo $fout; ?></font>
            <label>Ticket onderwerp</label>
            <input type="text" name="ticket_naam" class="input-xlarge" value="<?php echo $ticket_naam; ?>">
            <label>Ticket bericht</label>
            <textarea name="ticket_oms" id="textarea" style="width:750px; height:1000px;"><?php echo $ticket_oms; ?></textarea><br/><br/>
            <input type="submit" class="btn btn-primary btn-large" name="ticket_opslaan" value="Verstuur support ticket">
        </form>
        <?php } ?>
        <?php } elseif($_GET['ticket'] == 1) { ?>
            <center><h3><font color="green">Uw support ticket is verstuurd. Hij word z.s.m behandeld.</font></h3></center>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</div>