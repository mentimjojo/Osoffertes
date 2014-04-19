<?php
$menulinks = '
    <div class="sidebar-nav">
          <br/>

		<a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard<i class="icon-chevron-up"></i></a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><a href="' . SEO_LINK . HOME . '">' . $lang_home . '</a></li>
            <li ><a href="' . SEO_LINK . NEWS . '">' . $lang_nieuws . '</a></li>
        </ul>

        <a href="#products-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Producten<i class="icon-chevron-up"></i></a>
        <ul id="products-menu" class="nav nav-list collapse in">
            <li ><a href="' . SEO_LINK . PRODUCTS . '">' . $lang_diensten . ' <span class="label label-info">'. KLANT_PRODUCTEN_TOTAAL_MENU .'</a></span></li>
			<li ><a href="' . SEO_LINK . NIEUWE_OFFERTE . '">' . $lang_nieuw_dienst . '</a></li>
            <li ><a href="' . SEO_LINK . FACTUREN . '">' . $lang_factuur . ' <span class="label label-info">'. KLANT_FACTUUR_TOTAAL_MENU .'</a></span></li>
        </ul>

        <a href="#support-menu" class="nav-header" data-toggle="collapse"><i class="icon-question-sign"></i>Support<i class="icon-chevron-up"></i></a>
        <ul id="support-menu" class="nav nav-list collapse in">
            <li ><a href="#">' . $lang_support_faq . '</a></li>
			<li ><a href="#">Forum</a></li>
            <li ><a href="' . SEO_LINK . SUPPORT_TICKETS . '">' . $lang_support_tickets . '</a></li>
            <li ><a href="' . SEO_LINK . SUPPORT_TICKETS_NEW . '">' . $lang_support_nieuw . '</a></li>
        </ul>
        ';
	?>