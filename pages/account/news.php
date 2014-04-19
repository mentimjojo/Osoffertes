 <?php
$news_sql = mysqli_query($con,'SELECT * FROM ' . TBL_CUSTOMERS_NIEUWS . ' ORDER BY id DESC');
while($news_info = mysqli_fetch_array($news_sql))
{ 

if($news == "nl"){
$news_titel = $news_info['titel'];
$news_bericht = $news_info['bericht'];
} elseif($news == "en") {
$news_titel = $news_info['titel_en'];
$news_bericht = $news_info['bericht_en'];
}

?> 
    <div class="block">
	<p class="block-heading"><?php echo $news_titel.' - '.$news_info['datum']; echo ' | '; echo $lang_nieuws_geschreven; echo $news_info['naam'];?> </p>
        <div class="block-body gallery1">
            
                <?php echo $news_bericht; ?>
            
            <div class="clearfix"></div>
        </div>
		    </div>
		<?php } ?>