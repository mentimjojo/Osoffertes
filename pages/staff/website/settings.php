	  <?php 
	  
	  //////////////////////////////////
	  ///// ONDERHOUD QUERY        /////
	  /////////////////////////////////
	  if(isset($_POST['onderhoud_opslaan'])){
	  
	  // uitvoeren
	  mysqli_query($con,'UPDATE ' . TBL_SETTINGS_ONDERHOUD . ' SET onderhoud_aan="'.$_POST['onderhoud'].'", onderhoud_bericht="'.$_POST['onderhoud_oms'].'" WHERE id=1');
	  $goed = "U onderhoud instellingen zijn aangepast. Pagina reloaden indien de wijzigen nog niet zichtbaar zijn hieronder.";
	  }
	  
	  if(isset($_POST['log_opslaan'])){
	  
	  // uitvoeren
	  mysqli_query($con,'UPDATE ' . TBL_SETTINGS_LOGS . ' SET log_visit_on = "'.$_POST['log_visit_page'].'", log_iplogins_on = "'.$_POST['log_login_ips'].'" WHERE id=1');
	  $goed = "U nieuwe log instellingen zijn opgeslagen. Pagina reloaden indien de wijzigen nog niet zichtbaar zijn hieronder.";
	  }
	  //////////////////////////////////
	  ///// ONDERHOUD QUERY EINDE  /////
	  /////////////////////////////////
	  ?>		
		<center><h3><font color="green"><?php echo $goed; ?></font></h3></center>
		 <center><h3><font color="red"><?php echo $fout; ?></font></h3></center>

<div class="well">
    <ul class="nav nav-tabs">
      <li <?php if(isset($_POST['registeren_opslaan'])){ echo 'class="active"'; } if($_POST['login_opslaan'] == "" AND $_POST['onderhoud_opslaan'] == "" AND $_POST['log_opslaan'] == ""){ echo 'class="active"'; } ?>><a href="#registeren" data-toggle="tab">Registeren instellingen</a></li>
      <li <?php if(isset($_POST['login_opslaan'])){ echo 'class="active"'; } ?>><a href="#login" data-toggle="tab">Login instellingen</a></li>
	  <li <?php if(isset($_POST['onderhoud_opslaan'])){ echo 'class="active"'; } ?>><a href="#onderhoud" data-toggle="tab">Onderhoud instellingen</a></li>
	  <li <?php if(isset($_POST['log_opslaan'])){ echo 'class="active"'; } ?>><a href="#logs" data-toggle="tab">Logs instellingen</a></li>
    </ul>
	
	
    <div id="myTabContent" class="tab-content">
      <div <?php if(isset($_POST['registeren_opslaan'])){ echo 'class="tab-pane active in"'; } elseif($_POST['login_opslaan'] == "" AND $_POST['onderhoud_opslaan'] == "" AND $_POST['log_opslaan'] == ""){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="registeren">
        Registeren instellingen:
      </div>
	  
	  
	  
      <div <?php if(isset($_POST['login_opslaan'])){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="login">
        Login instellingen:
      </div>
	  
	  
	  <div <?php if(isset($_POST['onderhoud_opslaan'])){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="onderhoud">
        Onderhoud instellingen:
		<hr size="1">
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<label>Onderhoud:</label>
	<select name="onderhoud" id="DropDownTimezone" class="input-xlarge">
          <option value="0" <?php if(ONDERHOUD == '0'){?> selected <?php } ?> >Nee</option>
          <option value="1" <?php if(ONDERHOUD == '1'){?> selected <?php } ?> >Ja</option>
    </select><br/><Br/>
	    <label>Onderhouds bericht:</label>
		<textarea name="onderhoud_oms" id="textarea"><?php echo ONDERHOUD_BERICHT; ?></textarea><br/><br/>
		<input type="submit" class="btn btn-primary btn-large" name="onderhoud_opslaan" value="Onderhoud instellingen wijzigen!">
		</form>
      </div>
	  
	  	  <div <?php if(isset($_POST['log_opslaan'])){ echo 'class="tab-pane active in"'; } else { echo 'class="tab-pane fade"'; } ?> id="logs">
        Logs systems instellingen:
		<hr size="1">
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<label>Log pagina bezoeken:</label>
	<select name="log_visit_page" id="DropDownTimezone" class="input-xlarge">
          <option value="0" <?php if(LOGS_VISIT_ON == '0'){?> selected <?php } ?> >Nee</option>
          <option value="1" <?php if(LOGS_VISIT_ON == '1'){?> selected <?php } ?> >Ja</option>
    </select><br/><Br/>
		<label>Log login ips:</label>
	<select name="log_login_ips" id="DropDownTimezone" class="input-xlarge">
          <option value="0" <?php if(LOGS_LOGIN_IPS == '0'){?> selected <?php } ?> >Nee</option>
          <option value="1" <?php if(LOGS_LOGIN_IPS == '1'){?> selected <?php } ?> >Ja</option>
    </select><br/><Br/>
		<input type="submit" class="btn btn-primary btn-large" name="log_opslaan" value="Log instellingen wijzigen!">
		</form>
      </div>
	  
	  
  </div>

</div>