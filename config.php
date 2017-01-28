<?php
//Manutenzione e Beta testing
$maint=false;
$beta=false;
$noIE=false;

//Valore dei cookie di manutenzione e beta testing
$maintValue="1293";
$betaValue="1234";

//Versione chat
$title="Chat 4G";
$version="3.1";
$versLink="changelog.html#3.1";

//Impostazioni messaggi
$welcomeMsg = "La chat della nostra classe. Qui possiamo scambiarci materiale scolastico, condividere idee, etc...";
$clearDate = "31/03/13";
$maxMsgShown = 120;
$timestampInter = 2; //Show timestamp when between two messages there are more than x minutes
$timestampEach = 30; //Show timestamp anyway each x minutes

//Sessione di login (s)
$expireTime=8;

//Tempo di refreshing (s)
$refreshAll=3;
$renewSession=3;

//File liste (pseudodatabase)
$onlineSrc="data/online.xml";
$msgSrc="data/msg.xml";

//Altre impostazioni
$logger = array(
	"users" => true,
	"login/out" => true,
	"login-fail" => true,
	"expired-session" => true,
	"messages" => true,
	"msgcontent" => false,
	"logfile" => "data/log.xml"
);

?>
