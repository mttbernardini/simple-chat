<form class="login-form" action="?aut=1" method="post" onmouseover="document.getElementById('input_name').focus();">

	<div>Per favore, immetti il tuo nick per iniziare a chattare.</div>

	<div class="login-name-sect">
		<label>
			<span style="margin-right: 8px;">Nome:</span>
			<input class="text" type="text" name="name" id="input_name" maxlength="20" value="<?php echo $_COOKIE['username']; ?>" />
			<?php if($_GET['alreadylogged']) echo "<br /><span class=\"error\">Questo nickname è già stato utilizzato, oppure attendi $expireTime secondi e riprova</span>"; ?>
			<?php if($_GET['namerequired']) echo "<br /><span class=\"error\">È obbligatorio specificare un nickname</span>"; ?>
		</label>
	</div>

	<div class="login-options">
		<label>
			<input type="checkbox" name="remember" <?php if($_COOKIE['remember']) echo 'checked="checked"'; ?> />
			<span>Memorizza il mio nickname</span>
		</label>
		<br/>
		<label>
			<input type="checkbox" name="autologin" <?php if($_COOKIE['autologin']) echo 'checked="checked"'; ?> />
			<span>Effettua il login automaticamente</span>
		</label>
	</div>

	<div><button type="submit">Login</button></div>

	<input type="hidden" name="aut" value="1" />

</form>
