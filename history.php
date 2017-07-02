<?php

require_once("config.php");

if (stripos($_SERVER['HTTP_USER_AGENT'], "msie") !== false) {
	header("Content-type: application/xml; charset=UTF-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<?xml-stylesheet type="text/xsl" href="style/iemode.xsl"?>'."\n";
}
else {
	header("Content-type: application/xhtml+xml; charset=UTF-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
	<title><?= $title; ?> - Cronologia messaggi</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/history.css" />
</head>

<body>

<div>

<div id="back"><a href="./">Torna indietro</a></div>

<h1>Cronologia messaggi</h1>

<?php

$last = 0;
$lastAut = "";
$db = simplexml_load_file($msgSrc, null, LIBXML_NOCDATA);
$count_msg=count($db->msg);

echo '<p class="int">Last clear: ' . $clearDate . "</p>\n";

if ($count_msg==0) {
	echo '<p class="int" style="font-style:italic;">La cronologia dei messaggi è vuota. A quanto pare finora nessuno ha scritto nulla.</p>';
}
else {

	foreach ($db->msg as $msg) {
		if ($msg->type=="int")
			echo '<p class="int">'.$msg->data."</p>\n";
		else {
			global $last, $lastAut;
			$current = intval($msg->time);

			if (date('Yz', $current) > date('Yz', $last)) {
				echo '<p class="date">' . date('d/m/y', $current) . "</p>\n";
				echo '<p class="time">' . date('H:i', $current) . "</p>\n";
				$lastAut="";
			}
			elseif ((date('Gi', $current) >= date('Gi', $last) + $timestampInter) || (is_int(date("i", $current) / $timestampEach) && !is_int(date("i", $last) / $timestampEach) )) {
				echo '<p class="time">' . date('H:i', $current) . "</p>\n";
				$lastAut="";
			}

			echo '<p>';
			echo '<span class="name">' . ((string)$msg->user == $lastAut ? "..." : $msg->user.":") . ' </span>';
			echo '<span class="txt">' . $msg->data . '</span>';
			echo "</p>\n";

			$last = intval($msg->time);
			$lastAut = $msg->user;
		}
	}

}

?>

</div>

</body>
</html>
