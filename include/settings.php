<span>Cambia nickname:</span><br />
<input type="text" id="inputNewName" maxlength="20" onkeyup="var e=e||window.event; if (e.keyCode==13) changeName();" />
<button type="button" onclick="changeName()">Cambia</button><br />
<br />
<label>
<input type="checkbox" id="muteSound" onclick="muteSound(this);" <?php if ($_COOKIE['muteSound']=="true") echo ' checked="checked"'; ?> />
<span>Disattiva suoni</span>
</label>
