<?php

/*
 * Copyright (c) 2011 Matteo Bernardini
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once("check_usr.php"); //Include anche il file di configurazione

header("Content-type: application/json; charset=utf-8");

$user = isset($_GET['nick']) ? $_GET['nick'] : $_COOKIE['username'];
$user = trim(htmlspecialchars($user, null, "UTF-8", false));
$now  = time();
$ok   = false;

if ($_COOKIE['logged'] == 1) {

	$f = simplexml_load_file($onlineSrc);

	// find user on db and renew timestamp
	for ($i = 0; $i < count($f->user); $i++) {
		if ($user == $f->user[$i]->name) {
			$f->user[$i]->time = $now;
			$ok = true;
		}
	}

	setcookie("logged", "1");

	if ($ok) {
		file_put_contents($onlineSrc, $f->asXML());

		if ($_GET['nick'] == $user && $_GET['audio'] == $_COOKIE['muteSound'])
			echo '{"status": "done", "action": "renewed"}';

		else echo '{'.
			'"status": "done", '.
			'"action": "newdata", '.
			'"newData": {"nickName": "'.$user.'", "muteSound": '.$_COOKIE['muteSound'].'}'.
			'}';
	}
	else { // force login
		header("Location: ../user.php?do=login&json=true");
		exit();
	}

}

else
	echo '{"status": "fail", "action": "notlogged"}';

?>
