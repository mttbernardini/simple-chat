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

require_once('../config.php');

//FORMAT THE STRING
function format($string) {

	global $emot_map, $emot_path;

	$string = htmlspecialchars($string, ENT_COMPAT, "UTF-8");

	$emot_regex = array();

	foreach ($emot_map as $emot => $v) {
		$emot_regex[] = "/(" . preg_quote($emot, "/") . ")/";
	}

	// replace emoticons
	$string=preg_replace_callback($emot_regex, function($m) use ($emot_map, $emot_path) {
		return '<img alt="'.$m[0].'" src="'.$emot_path.$emot_map[$m[0]][0].'" class="emot" />';
	}, $string);

	//replace common errors
	$string=str_ireplace('perchè', 'perché', $string);
	$string=str_replace("PERCHE'", 'PERCHÉ', $string);
	$string=str_replace(" E'", ' È', $string);
	$string=str_ireplace("poichè", 'poiché', $string);

	//BBCode
	$bbcodes=array('/\[b\](.+)\[\/b\]/Ui', '/\[i\](.+)\[\/i\]/Ui', '/\[u\](.+)\[\/u\]/Ui', '/\[url\]([a-zA-Z0-9:\.\/\?&%=\-_#]+)\[\/url\]/Ui', '/\[url\=([a-zA-Z0-9:\.\/\?&=%\-_#]+)\](.+)\[\/url\]/Ui');
	$html=array('<b>$1</b>', '<i>$1</i>', '<u>$1</u>', '<a target="_blank" href="$1">$1</a>', '<a target="_blank" href="$1">$2</a>');

	$string=preg_replace($bbcodes, $html, $string);

	//return the formatted string
	return $string;

}

?>
