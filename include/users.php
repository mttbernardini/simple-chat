<?php

require("check_usr.php"); //Include anche il file di configurazione

$db = simplexml_load_file($onlineSrc);
$count_usr = count($db->user);
$word = $count_usr==1?"e":"i";

echo "<h3><span id=\"users-online\">$count_usr</span> utent$word online</h3>\n";

foreach ($db->user as $usr) echo '<div class="name">'.$usr->name."</div>\n";

?>
