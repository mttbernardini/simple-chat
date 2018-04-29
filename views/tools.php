<?php

foreach ($emot_map as $text => $emot)
	echo sprintf('<img src="%s" title="%s" alt="%s" data-text="%s" />',
		$emot_path . $emot[0],
		$emot[1], $text, $text) . "\n";

?>

<button type="button" data-text="b" style="font-weight:bold;">G</button>
<button type="button" data-text="i" style="font-style:italic;">C</button>
<button type="button" data-text="u" style="text-decoration:underline;">S</button>
<button type="button" data-text="url">LINK</button>
