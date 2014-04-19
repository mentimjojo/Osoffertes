<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Informatie</a></li>
      <li><a href="#change" data-toggle="tab">Changelog</a></li>
      <li><a href="<?= URL; ?>/web/phpinfo" target="_blank">PHP info</a></li>
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
		<strong>Changelog 1:</strong> <a href="<?= URL; ?>/web/changelog/1" target="_blank">Klik hier</a>
		<br/>
		<strong>Changelog 2:</strong> <a href="<?= URL; ?>/web/changelog/2" target="_blank">Klik hier</a>
      </div>
  </div>

</div>