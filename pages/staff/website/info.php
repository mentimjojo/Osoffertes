<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Informatie</a></li>
      <li><a href="#change" data-toggle="tab">Changelog</a></li>
      <li><a href="#software" data-toggle="tab">PHP info</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="info">
        Informatie of software, hardware etc.
		<hr size="1">
		<strong>Developers4you versie =</strong> <? ECHO VERSION; ?><br/>
		<strong>Ontwikkelaar =</strong> Tim Nijborg -> skype mentimjojo
      </div>
      <div class="tab-pane fade" id="change">
        Alle changelogs:
		<br/><br/>
		<strong>Changelog 1:</strong> <a href="http://customers.developers4you.nl/pages/changelogs/changelog1.txt" target="_blank">Klik hier</a>
		<br/>
		<strong>Changelog 2:</strong> <a href="http://customers.developers4you.nl/pages/changelogs/changelog2.txt" target="_blank">Klik hier</a>
      </div>
        <div class="tab-pane fade" id="software">
            Alles over de php versie:
            <hr size="1">
            <?php
            echo phpinfo();
            ?>
        </div>
  </div>

</div>