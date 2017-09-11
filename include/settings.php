<form id="changename-form">
	<span>Cambia nickname:</span><br/>
	<input type="text" id="inputNewName" maxlength="20" />
	<button type="submit">Cambia</button>
</form>

<br/>

<label>
	<input type="checkbox" id="mute-switch" <?php if ($_COOKIE['muteSound']=="true") echo 'checked="checked"'; ?> />
	<span>Disattiva suoni</span>
</label>
