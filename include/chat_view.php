<section id="settings">

	<article>
		<button id="close-settings-btn">X</button>
		<div style="margin:1em">
			<h2>Impostazioni</h2>
			<?php require(__DIR__."/settings.php"); ?>
		</div>
	</article>

	<div id="info">
		<div style="margin: 1em;">
			<div>Designed &amp; Developed by <a href="https://mttbernardini.github.io/" target="_blank">Matteo Bernardini</a></div>
		</div>
	</div>

</section>

<section id="to-reload">

	<article id="messages">
		<?php require(__DIR__."/messages.php"); ?>
	</article>

	<aside id="online">
		<?php require(__DIR__."/users.php"); ?>
	</aside>

	<button type="button" id="skip-btn"><img src="./assets/icons/skip.png" alt="&#9660;" /></button>

</section>

<section id="sender">

	<div id="tools">
		<?php require(__DIR__.'/tools.php'); ?>
	</div>

	<div>
		<form id="msg-form">
			<input type="text" autocomplete="off" name="msg" id="msg" />
			<button type="submit" style="width: 10%;">Invia</button>
			<button type="reset" style="width: 15%">Cancella</button>
		</form>
	</div>

	<div style="margin-top: 5px;">
		<span id="nick"></span>
		<button type="button" id="settings-btn">Impostazioni</button>
		<button type="button" id="logout-btn">Esci</button>
	</div>

</section>
