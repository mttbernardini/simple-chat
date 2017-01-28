<?php

require("config.php");

$last=0; $lastAut="";
$db = simplexml_load_file($msgSrc, null, LIBXML_NOCDATA);
$count_msg=count($db->msg);
$listMsg = Array();

echo "<span id=\"n-messages\">" . $count_msg . "</span>\n";
echo '<p style="text-decoration: underline; font-weight: normal; font-style: italic;">' . $welcomeMsg . "</p>\n";
echo '<p class="int">Last clear: ' . $clearDate . ". <a href=\"history.php\">Cronologia messaggi</a></p>\n";

for ($count=count($db->msg); (count($db->msg)-$count) <= $maxMsgShown && $count > 0; $count--) array_unshift($listMsg, $db->msg[$count-1]);

foreach ($listMsg as $msg) {
	if ($msg->type=="int")
		echo '<p class="int">'.$msg->data."</p>\n";
	else {
		global $last, $lastAut;
		$current = (int)$msg->time;
		
		if (date('Yz', $current) > date('Yz', $last)) {
			echo '<p class="date">' . date('d/m/y', $current) . "</p>\n";
			echo '<p class="time">' . date('H:i', $current) . "</p>\n";
			$lastAut="";
		}
		elseif ((date('Gi', $current) >= date('Gi', $last) + $timestampInter) || (is_int(date("i", $current)/$timestampEach) && !is_int(date("i", $last)/$timestampEach) )) {
		  echo '<p class="time">' . date('H:i', $current) . "</p>\n";
		  $lastAut="";
		}
		
		echo '<p>';
		echo '<span class="name">' . ((string)$msg->user==$lastAut ? "..." : $msg->user.":") . ' </span>';
		echo '<span class="txt">' . $msg->data . '</span>';
		echo "</p>\n";

		$last = (int)$msg->time;
		$lastAut = $msg->user;
	}
}


?>
