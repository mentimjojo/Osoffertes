<?php


$balk = '<div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    
					
					
					';

$balk2 = '				
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> '. KLANTNAAM .'
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="index.php?page=' . ACCOUNT . '">'. $lang_gegevens .'</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="index.php?page=' . LOGOUT . '">'. $lang_logout .'</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="index.php"><span class="second">' . SITETITEL . ' - klantenpaneel</span></a>
        </div>
    </div>';

?>