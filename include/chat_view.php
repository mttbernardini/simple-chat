<section id="settings">

	<article>
		<button id="closeSettings" onclick="document.getElementById('settings').style.display='none';">X</button>
		<div style="margin:1em">
			<h2>Impostazioni</h2>
			<?php require(__DIR__."/settings.php"); ?>
		</div>
	</article>

	<div id="info">
		<div style="margin: 1em;">
			<?php require(__DIR__."/info.html"); ?>
		</div>
	</div>

</section>

<section id="to-reload">

	<article id="messages" onscroll="checkBtn(this)">
		<?php require(__DIR__."/messages.php"); ?>
	</article>

	<aside id="online">
		<?php require(__DIR__."/users.php"); ?>
	</aside>

	<button id="skip" onclick="skipBT();"><img src="./assets/icons/skip.png" alt="&#9660;" /></button>

</section>

<section id="sender" onmouseover="document.getElementById('msg').focus();" onkeyup="keypressed(event);">

	<div id="tools">
		<?php require(__DIR__.'/tools.html'); ?>
	</div>

	<div>
		<input type="text" name="msg" id="msg" />
		<button onclick="doPost();" style="width: 10%;">Invia</button>
		<button onclick="document.getElementById('msg').value=''; document.getElementById('msg').focus();" style="width: 15%">Cancella</button>
	</div>

	<div style="margin-top: 5px;">
		<span id="nick"></span>
		<button onclick="document.getElementById('settings').style.display='block';">Impostazioni</button>
		<button onclick="location.href='user.php?do=logout';">Esci</button>
	</div>

</section>
