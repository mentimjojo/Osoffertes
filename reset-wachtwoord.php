<?php

include("inc/config.php");

if(isset($_POST['reset'])){
    $post_email = $_POST['email'];
    $post_pass = mt_rand();

    if(empty($post_email)){
    $fout = "<font color='red'>Er is geen mail ingevoerd</font><br/><br/>";
    } elseif(filter_var($post_email, FILTER_VALIDATE_EMAIL)) {

        // Check of mail bestaat.
        $reset_pass_sql1 = 'SELECT * FROM ' . TBL_CUSTOMERS . ' WHERE email = "'.$post_email.'"';
        $reset_pass_query1 = mysqli_query($con,$reset_pass_sql1)or die(mysqli_error());
        $reset_pass_info1 = mysqli_fetch_array($reset_pass_query1);
        $reset_pass_tel1 = mysqli_num_rows($reset_pass_query1);

        if($reset_pass_tel1 == 1){

            //Uitvoeren
$message1 = '<html>
<body>
Welkom ' . $reset_pass_info1['initalen'] . '.' . $reset_pass_info1['achternaam'] . ',
<br/><br/>
U heeft een nieuw wachtwoord aangevraagd. Uw nieuwe wachtwoord is:
<br/><br/>
<strong>' . $post_pass . '</strong>
<br/><br/>
Met vriendelijke groeten,<br/>
Developers4you.nl
</body>
</html>
';
mailNow($reset_pass_info1['email'], "Nieuw wachtwoord", $message1, $reset_pass_info1['initalen'].".".$reset_pass_info1['achternaam']);
            mysqli_query($con, 'UPDATE ' . TBL_CUSTOMERS . ' SET wachtwoord = "'.sha1($post_pass).'", wachtwoord_change = 1 WHERE email = "'.$post_email.'"');
$fout = '<strong><font color="green">Er is een mail naar je gestuurd met een nieuw wachtwoord.</font></strong><br/><br/>';

        } else {
            $fout = '<strong><font color="green">Er is een mail naar je gestuurd met een nieuw wachtwoord.</font></strong><br/><br/>';
        }

    } else {
        $fout = "<font color='red'>Dit is geen geldig email adres.</font><br/><br/>";
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
            <p class="block-heading">Wachtwoord vergeten</p>
            <div class="block-body">
                <p>Ben u uw wachtwoord vergeten? Hier kunt u een nieuw wachtwoord aanvragen:</p>
                <hr size="1">
                <?= $fout; ?>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <label>Email (Uw email dat aan uw klantnummer is gekoppeld)</label>
                    <input type="text" name="email" class="span12" value="">
                    <input type="submit" class="btn btn-primary" name="reset" value="Vraag nieuw wachtwoord aan">
                </form>
                <hr size="1">
                <p class="return-home"><a href="index.php">Ga terug naar de home pagina.</a></p>
            </div>
        </div>
        <p class="pull-right" style=""><a href="#" target="blank"><?php echo $lang_copyby; ?></a></p>
    </div>
</div>
</html>