<?php

require_once(__DIR__."/../config.php");
if ($logger["users"]) require_once(__DIR__."/logger.php");

$now = time();

$f = simplexml_load_file($onlineSrc);
$update_f = false;
$i = 0;
$rep = 0;

while ($i < count($f->user)) {
	if ($now - $f->user[$i]->time > $expireTime) {
		if ($logger["expired-session"])
			write_log($now, $f->user[$i]->name, "logout", "User session has expired.");
		unset($f->user[$i]);
		$rep++;
		$update_f = true;
	}
	else $i++;
}

if ($update_f) {
	$outp = str_replace("\n\n", "", $f->asXML());
	file_put_contents($onlineSrc, $outp);
}

?>
