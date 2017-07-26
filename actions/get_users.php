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

header("Content-type: application/json; charset=utf-8");

require_once("check_usr.php"); //include automaticamente anche il file di configurazione

$db = simplexml_load_file($onlineSrc);
$count_usr = count($db->user);
$word = $count_usr == 1 ? "e" : "i";

echo "{\n";
echo '"count": '.$count_usr.",\n";

$out = "<h3><span id=\"users-online\">$count_usr</span> utent$word online</h3>\n";

foreach ($db->user as $usr)
	$out.='<div class="name">'.$usr->name."</div>\n";

echo '"content": '.json_encode($out)."\n";
echo "}";

?>
