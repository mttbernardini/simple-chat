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

require_once(__DIR__.'/../config.php');

function write_log($time, $user, $action, $data=null) {

	global $logger;

	$doc = new DOMDocument();
	$doc->load($logger["logfile"]);
	$theEvent = new XMLWriter();

	if (!empty($time) && !empty($user) && !empty($action)) {

		//WRITE LOG PART

		$theEvent->openURI($logger["logfile"]);
		$theEvent->setIndent(true);
		$theEvent->startDocument("1.0", "UTF-8");

		$theEvent->text("<log>");

		// put old events
		foreach ($doc->documentElement->childNodes as $node)
			$theEvent->text($doc->saveXML($node));

		// put current event
		$theEvent->startElement("event");
		$theEvent->writeElement("timestamp", $time);

		$theEvent->startElement("details");
		$theEvent->writeElement("user", $user);
		$theEvent->writeElement("action", $action);

		if ($data != null) {
			$theEvent->startElement("data");
			$theEvent->writeCData($data);
			$theEvent->endElement();
		}

		$theEvent->endElement(); // </details>
		$theEvent->endElement(); // </event>
		$theEvent->text("</log>");

		$theEvent->endDocument();

	}

}

?>
