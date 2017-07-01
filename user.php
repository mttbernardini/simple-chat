<?php

require_once("check_usr.php");

if ($logger["users"]) require_once("include/logger.php");

//define vars
$user=isset($_GET['nick'])?$_GET['nick']:$_COOKIE['username'];
$user=trim(htmlspecialchars($user, ENT_QUOTES, "UTF-8", false));
$now=time();

//define functions

function login() {
 $json = $_GET['json'];
 global $onlineSrc, $now, $user, $logger;
 if ($json) header("Content-type: application/json; charset=utf-8");
 if (empty($user)) {
  if ($json) {
   echo "{\n".'"status": "fail",'."\n".'"action": "namerequired"'."\n}";
   exit();
  }
  else {
   header("Location: index.php?logout=1&namerequired=1");
   exit();
  }
 }
 else {
  $look = simplexml_load_file($onlineSrc);
  foreach ($look->user as $usr) $alrlogged= $usr->name==$user ? true : false;
  if (!$alrlogged) {
   $dom = new DOMDocument();
   $dom->load($onlineSrc);
   $xml = new XMLWriter();
   $xml->openURI($onlineSrc);

   $xml->setIndent(true);
   $xml->startDocument("1.0", "UTF-8");
   $xml->text("<users>");
   foreach ($dom->documentElement->childNodes as $node) $xml->text($dom->saveXML($node));
   $xml->startElement("user");
   $xml->writeElement("name", $user);
   $xml->writeElement("time", $now);
   $xml->endElement();
   $xml->text("</users>");
   $xml->endDocument();

   if ($logger["login/out"]) write_log($now, $user, "login");
  }
  else {
   if ($logger["login-fail"]) write_log($now, $user, "failed login", "Someone with the same username was already logged.");
   if ($json) {
    echo "{\n".'"status": "fail",'."\n".'"action": "alreadylogged"'."\n}";
    exit();
   }
   else {
    header("Location: index.php?logout=1&alreadylogged=1");
    exit();
   }
  }
  setcookie("logged", "1");
  if ($json) {
   echo "{\n".'"status": "done",'."\n".'"action": "relogged"'."\n}";
   exit();
  }
  else {
   header("Location: index.php?login=1");
   exit();
  }
 }
}

function logout($redir=true) {
 global $now, $onlineSrc, $user, $logger;
 $f = simplexml_load_file($onlineSrc);
 $i = 0;
 while ($i<count($f->user)) {
  if ($f->user[$i]->name == $user) unset($f->user[$i]);
  else $i++;
 }
 $outp = str_replace("\n\n", "", $f->asXML());
 $outp = str_replace("<users></users>", "<users>\n</users>", $outp);
 file_put_contents($onlineSrc, $outp);
 setcookie("logged", "0");
 if ($logger["login/out"]) write_log($now, $user, "logout");
 if ($redir) {
  if (!$_COOKIE['remember']) setcookie("username", "", time()-1);
  setcookie("autologin", "", time()-1);
  header("Location: index.php?logout=1");
  exit();
 }
}

function changeName() {
 global $user;
 $ou=$_GET['oldnick'];
 $nu=trim(htmlspecialchars($_GET['newnick'], ENT_QUOTES, "UTF-8"));
 $user=$ou;
 logout(false);
 $user=$nu;
 if ($_COOKIE['remember']) setcookie("username", $user, time() + (89 * 89 * 89 * 89));
 else setcookie("username", $user);
 login();
}


//switch cases
switch($_GET['do']) {
case "login":
login();
break;
case "logout":
logout();
break;
case "changename":
changeName();
break;
}

?>
