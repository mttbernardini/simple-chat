<?php

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
			echo "{\n".'"status": "done",'."\n".'"action": "renewed"'."\n}";

		else echo <<<JSO
			{
				"status": "done",
				"action": "newdata",
				"newData": { "nickName": "$user", "muteSound": {$_COOKIE['muteSound']} }
			}
		JSO;
	}
	else { // force login
		header("Location: ../user.php?do=login&json=true");
		exit();
	}

}

else
	echo '{ "status": "fail", "action": "notlogged" }';

?>
