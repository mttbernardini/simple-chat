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
