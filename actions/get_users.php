<?php

header("Content-type: application/json; charset=utf-8");

require_once("check_usr.php"); //include automaticamente anche il file di configurazione

$db = simplexml_load_file($onlineSrc);
$count_usr=count($db->user);
$word=$count_usr==1?"e":"i";

echo "{\n";
echo '"count": '.$count_usr.",\n";

$out = "<h3><span id=\"users-online\">$count_usr</span> utent$word online</h3>\n";
foreach ($db->user as $usr) $out.='<div class="name">'.$usr->name."</div>\n";

echo '"content": '.json_encode($out)."\n";
echo "}";

?>
