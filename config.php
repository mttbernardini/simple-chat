<?php
//Manutenzione e Beta testing
$maint=false;
$beta=false;
$noIE=false;

//Valore dei cookie di manutenzione e beta testing
$maintValue="1293";
$betaValue="1234";

//Versione chat
$title="Simple Chat";
$version="3.1";
$versLink="changelog.md";

//Impostazioni messaggi
$welcomeMsg = "Questa è una semplice chatroom sviluppata in php.";
$clearDate = "2017-01-31";
$maxMsgShown = 120;
$timestampInter = 2; //Show timestamp when between two messages there are more than x minutes
$timestampEach = 30; //Show timestamp anyway each x minutes

//Sessione di login (s)
$expireTime=8;

//Tempo di refreshing (s)
$refreshAll=3;
$renewSession=3;

//File liste (pseudodatabase)
$onlineSrc=__DIR__."/data/online.xml";
$msgSrc=__DIR__."/data/msg.xml";

//Altre impostazioni
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
