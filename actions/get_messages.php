<?php

header("Content-type: application/json; charset=utf-8");

require_once("../config.php");

$db = simplexml_load_file($msgSrc, null, LIBXML_NOCDATA);
$msgs = $db->msg;

$lastMsg = !empty($_GET['msg'])?$_GET['msg']:$nmsg;
$curMsg = count($db->msg);

$last = !empty($msgs[$lastMsg-1]) ? intval($msgs[$lastMsg-1]->time) : 0;
$lastAut=$db->msg[$lastMsg-1]->user;

if ($curMsg > $lastMsg) {

echo "{\n" . '"newmsg": '.($curMsg-$lastMsg).",\n";

for ($i=$lastMsg+1; $i<=$curMsg; $i++) {
	$msg = $msgs[$i-1];
	$out = !empty($out) ? $out : "";

	if ($msg->type=="int")
		$out .= '<p class="int">'.$msg->data."</p>\n";
	else {
		global $last, $lastAut;
		$current = (int)$msg->time;

		if (date('Yz', $current) > date('Yz', $last)) {
			$out .= '<p class="date">' . date('d/m/y', $current) . "</p>\n";
			$out .= '<p class="time">' . date('H:i', $current) . "</p>\n";
			$lastAut="";
		}
		elseif ((date('Gi', $current) >= date('Gi', $last) + $timestampInter) || (is_int(date("i", $current)/$timestampEach) && !is_int(date("i", $last)/$timestampEach) )) {
		  $out .= '<p class="time">' . date('H:i', $current) . "</p>\n";
		  $lastAut="";
		}

		$out .= '<p>';
		$out .= '<span class="name">' . ((string)$msg->user==$lastAut ? "..." : $msg->user.":") . ' </span>';
		$out .= '<span class="txt">' . $msg->data . '</span>';
		$out .= "</p>\n";

		$last = (int)$msg->time;
		$lastAut = $msg->user;
	}
}

echo '"content": '.json_encode($out)."\n}";

}

elseif ($lastMsg > $curMsg)
echo <<<JSO
{
"newmgs" : "overload"
}
JSO;


else
echo <<<JSO
{
"newmgs" : false
}
JSO;

?>
