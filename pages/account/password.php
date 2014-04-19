<?php

include("inc/config.php");


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
            <p class="block-heading">Wachtwoord aanpassen</p>
            <div class="block-body">
                <p>U heeft zojuist een nieuw wachtwoord aangevraagd. Verander uw wachtwoord i.v.m de veiligheid</p>
                <hr size="1">
                <?= $fout; ?>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <label>Huidig wachtwoord</label>
                    <input type="text" name="ww_huidig" class="span12" value="">
                    <label>Nieuw wachtwoord</label>
                    <input type="text" name="ww_nieuw1" class="span12" value="">
                    <label>Herhaal nieuw wachtwoord</label>
                    <input type="text" name="ww_nieuw2" class="span12" value="">
                    <input type="submit" class="btn btn-primary" name="reset" value="Verander wachtwoord.">
                </form>
                <hr size="1">
            </div>
        </div>
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
</html>
