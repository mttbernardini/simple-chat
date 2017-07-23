<?php
// Maintenance and Beta Testing
$maint = false;
$beta  = false;
$noIE  = false;

// Cookie values for overriding maint and beta mode
$maintValue = "1293";
$betaValue  = "1234";

// Chat settings and strings
$title          = "Simple Chat";
$version        = "3.1";
$versLink       = "changelog.md";
$welcomeMsg     = "Questa è una semplice chatroom sviluppata in PHP.";
$clearDate      = "2017-01-31";

// Messages settings
$maxMsgShown    = 120;
$timestampInter = 2;  // Show timestamp when between two messages there are more than x minutes
$timestampEach  = 30; // Show timestamp anyway each x minutes

// Expiration time for login session (seconds)
$expireTime = 8;

// Refreshing timerate on app (seconds)
$refreshAll   = 3;
$renewSession = 3;

// Path to xml database
$onlineSrc = __DIR__ . "/data/online.xml";
$msgSrc    = __DIR__ . "/data/msg.xml";

// Log settings
$logger = array(
	"users" => true,
	"login/out" => true,
	"login-fail" => true,
	"expired-session" => true,
	"messages" => false,
	"msgcontent" => false,
	"logfile" => __DIR__."/data/log.xml"
);

?>
