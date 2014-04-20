<?php

if(isset($_POST['reset'])){

    $ww_huidig = $_POST['ww_huidig'];
    $ww_nieuw1 = $_POST['ww_nieuw1'];
    $ww_nieuw2 = $_POST['ww_nieuw2'];

    if(empty($ww_huidig)){
        $melding = "<font color='red'>Je hebt geen huidig wachtwoord ingevuld.</font><br/><Br/>";
    } elseif(empty($ww_nieuw1)) {
        $melding = "<font color='red'>Je hebt geen nieuw wachtwoord ingevuld.</font><br/><Br/>";
    } elseif(empty($ww_nieuw2)){
        $melding = "<font color='red'>Je hebt geen herhaal niet wachtwoord ingevuld.</font><br/><Br/>";
    } elseif($gev2['wachtwoord'] == sha1($ww_huidig)) {
    if($ww_nieuw1 == $ww_nieuw2){


        // uitvoeren
        header('Refresh: 5; url='.SEO_LINK.HOME);
        $melding = "<font color='green'>Uw heeft u wachtwoord aangepast. U word doorgestuurd naar de home page.</font><br/><br/>";
        mysqli_query($con, 'UPDATE ' . TBL_CUSTOMERS . ' SET wachtwoord = "'.sha1($ww_nieuw1).'", wachtwoord_change = 0 WHERE klantnummer = "'.KLANTNUMMER.'"');



    }  else {
        $melding = "<font color='red'>Je nieuwe wachtwoord komt niet overeen met je herhaal nieuw wachtwoord.</font><Br/><br/>";
    }
    } else {
        $melding = "<font color='red'>Je huidige wachtwoord is niet correct.</font><Br/><br/>";
    }

}

?>
<html lang="en">
<?php echo $style; ?>

<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav pull-right">


        </ul>
        <a class="brand" href="<?= URL; ?>"><span class="second"><?php echo $lang_title;?></span></a>
    </div>
</div>

<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Wachtwoord aanpassen <?= KLANTNAAM; ?></p>
            <div class="block-body">
                <p>U heeft zojuist een nieuw wachtwoord aangevraagd. Verander uw wachtwoord i.v.m de veiligheid</p>
                <hr size="1">
                <?= $melding; ?>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <label>Huidig wachtwoord</label>
                    <input type="password" name="ww_huidig" class="span12" value="">
                    <label>Nieuw wachtwoord</label>
                    <input type="password" name="ww_nieuw1" class="span12" value="">
                    <label>Herhaal nieuw wachtwoord</label>
                    <input type="password" name="ww_nieuw2" class="span12" value="">
                    <input type="submit" class="btn btn-primary" name="reset" value="Verander wachtwoord">
                </form>
                <hr size="1">
                <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
            </div>
        </div>
    </div>
</div>
</html>
