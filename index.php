<?php
require_once("functions.php");

if (stripos($_SERVER['HTTP_USER_AGENT'], "msie") !== false) {
	header("Content-type: application/xml; charset=UTF-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<?xml-stylesheet type="text/xsl" href="./assets/iemode.xsl"?>'."\n";
}
else {
	header("Content-type: application/xhtml+xml; charset=UTF-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=8"/><![endif]-->
	<meta charset="UTF-8" />
	<title><?= $title; ?></title>
	<link href="./assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="./assets/css/dialog_default.css" rel="stylesheet" type="text/css" />
	<link href="./assets/css/dialog.css" rel="stylesheet" type="text/css" />

	<!--[if IE]>
	<script type="text/javascript">
	var html5 = ("article,aside,footer,header,hgroup,section,audio").split(',');

	for (var i = 0; i < html5.length; i++) {
		var a=document.createElement(html5[i]);
	}
	</script>

	<style type="text/css">
	.delivering { filter: Alpha(Opacity=50); }
	</style>
	<![endif]-->

	<script type="text/javascript" src="./assets/js/get_variables.js"></script>
	<script type="text/javascript" src="./assets/js/dialog.js"></script>
	<script type="text/javascript">
	<![CDATA[
		var _GET = GETvars();
		var dialogSettings = {
			defTitle: "Messaggio",
			defContent: "<i>Testo mancante</i>",
			continueText: "Continua",
			cancelText: "Annulla"
		};
		var timerAll, timerRenew;
		var timeAll = <?php echo $refreshAll; ?>;
		var timeRenew = <?php echo $renewSession; ?>;
		var nickName = "<?php echo $nickname; ?>";
	//]]>
	</script>
	<script type="text/javascript" src="./assets/js/main.js"></script>
</head>

<body onload="if (_GET['login']==1) { UpdateTimer(); doRenew(); }">

	<audio id="new-msg" preload="auto">
		<source type="audio/mpeg" src="./assets/audio/new_msg.mp3" />
		<source type="audio/ogg" src="./assets/audio/new_msg.ogg" />
		<embed type="audio/mpeg" src="./assets/audio/new_msg.mp3" enablejavascript="true" autoplay="false" />
	</audio>

	<audio id="send-msg" preload="auto">
		<source type="audio/mpeg" src="./assets/audio/send_msg.mp3" />
		<source type="audio/ogg" src="./assets/audio/send_msg.ogg" />
		<embed type="audio/mpeg" src="./assets/audio/send_msg.mp3" enablejavascript="true" autoplay="false" />
	</audio>

	<audio id="new-user" preload="auto">
		<source type="audio/mpeg" src="./assets/audio/new_user.mp3" />
		<source type="audio/ogg" src="./assets/audio/new_user.ogg" />
		<embed type="audio/mpeg" src="./assets/audio/new_user.mp3" enablejavascript="true" autoplay="false" />
	</audio>

	<audio id="exit-user" preload="auto">
		<source type="audio/mpeg" src="./assets/audio/exit_user.mp3" />
		<source type="audio/ogg" src="./assets/audio/exit_user.ogg" />
		<embed type="audio/mpeg" src="./assets/audio/exit_user.mp3" enablejavascript="true" autoplay="false" />
	</audio>

	<div id="JSdisabled"><div>Devi attivare javascript per poter utilizzare la chat.</div></div>
	<div id="noAJAX"><div>Il tuo browser purtroppo non supporta le richieste AJAX, pertanto la chat non è utilizzabile.<br />Scarica un browser più recente, come Google Chrome, Mozilla Firefox, o simili.</div></div>

	<div id="main">
		<header style="height: 48px;">
			<div id="icon"></div>
			<h1><?= $title; ?></h1>
			<div id="version"><?php echo '<a href="'.$versLink.'">Versione '.$version.'</a>'; ?></div>
		</header>

		<section style="position: relative;">
			<?php switchCases(); ?>
		</section>
	</div>

	<script type="text/javascript">
	<![CDATA[
		document.getElementById("JSdisabled").style.display="none";
		if (_GET['login']==1) init();
		window.onunload = function() {
			parent.postMessage("Users:Offline", "*");
			parent.postMessage("NewMsg:-", "*");
		}
	//]]>
	</script>

</body>
</html>
