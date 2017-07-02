<?php

require_once("../config.php");

header("Content-type: application/json; charset=utf-8");

$db      = simplexml_load_file($msgSrc, null, LIBXML_NOCDATA);
$msgs    = $db->msg;

$curMsg  = !empty($_GET['msg']) ? $_GET['msg'] : $nmsg; // $nmsg ??

$lastMsg = count($db->msg);
$lastTms = !empty($msgs[$lastMsg-1]) ? intval($msgs[$lastMsg-1]->time) : 0;
$lastAut = $db->msg[$lastMsg-1]->user;

if ($lastMsg > $curMsg) {

	echo "{\n" . '"newmsg": '.($lastMsg-$curMsg).",\n";

	$out = "";

	for ($i = $curMsg+1; $i <= $lastMsg; $i++) {

		$msg = $msgs[$i-1];

		if ($msg->type=="int")
			$out .= '<p class="int">'.$msg->data."</p>\n";
		else {
			global $lastTms, $lastAut;
			$current = (int)$msg->time;

			if (date('Yz', $current) > date('Yz', $lastTms)) {
				$out .= '<p class="date">' . date('d/m/y', $current) . "</p>\n";
				$out .= '<p class="time">' . date('H:i', $current) . "</p>\n";
				$lastAut="";
			}
			elseif (
				(date('Gi', $current) >= date('Gi', $lastTms) + $timestampInter) ||
				(is_int(date("i", $current) / $timestampEach) && !is_int(date("i", $lastTms) / $timestampEach) )
			) {
				$out .= '<p class="time">' . date('H:i', $current) . "</p>\n";
				$lastAut="";
			}

			$out .= '<p>';
			$out .= '<span class="name">' . ((string)$msg->user == $lastAut ? "..." : $msg->user.":") . ' </span>';
			$out .= '<span class="txt">' . $msg->data . '</span>';
			$out .= "</p>\n";

			$lastTms = (int)$msg->time;
			$lastAut = $msg->user;
		}
	}

	echo '"content": '.json_encode($out)."\n}";

}

elseif ($curMsg > $lastMsg)
	echo '{"newmgs" : "overload"}';

else
	echo '{"newmgs" : false}';


?>
