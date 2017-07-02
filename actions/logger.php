<?php

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
