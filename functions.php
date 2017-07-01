<?php
require_once("config.php");

//in caso di manutenzione:
if ($maint && $_COOKIE['maint'] != $maintValue && !($beta && $_COOKIE['beta'] == $betaValue)) {
    require("./include/maintenance.html");
    exit();
}

//Escludere IE dalla Beta
if ($noIE && $beta && $_COOKIE['beta'] == $betaValue && stripos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== false) {
    require("./include/maintenance-msie.html");
    exit();
}

function createForm(){
	global $expireTime;
	require("./include/login_view.php");
}

function createChat() {
	require("./include/chat_view.php");
}

function createError() {
	echo '<div class="error">Si è verificato un errore sconosciuto. Prova a ricaricare la pagina</div>';
}

//Define variables and cases

$timeToExpire = time() + (89 * 89 * 89 * 89);

if (isset($_POST['aut'])) {
    $username = trim(htmlspecialchars($_POST['name'], ENT_QUOTES, "UTF-8"));

    if ($_POST['remember']) {
        setcookie("username", $username, $timeToExpire);
        setcookie("remember", "1",       $timeToExpire);
    } else {
        setcookie("username", $username);
        setcookie("remember", "0",       $timeToExpire);
    }

    setcookie("autologin", $_POST['autologin']=="on"?"1":"0", $timeToExpire);

    header("Location: user.php?do=login");
    exit();
}
if (isset($_GET['logout']) && $_COOKIE['logged'] == 1) {
    header("Location: user.php?do=logout");
    exit();
}

$nickname = trim(htmlspecialchars($_COOKIE['username'], ENT_QUOTES, "UTF-8", false));


function switchCases() {
    global $nickname, $timeToExpire;

    if (isset($_GET['invalid']))
        createError();

    elseif (isset($_GET['logout']) && isset($_GET['login'])) {
        header("Location: ?login=1");
        exit();
    }

    elseif ($_COOKIE['autologin'] && !empty($nickname) && ($_COOKIE['logged'] == 0 || empty($_COOKIE['logged']))) {
        setcookie("username",  $nickname, $timeToExpire);
        setcookie("remember",  "1",       $timeToExpire);
        setcookie("autologin", "1",       $timeToExpire);
        header("Location: user.php?do=login");
    }

    elseif (isset($_GET['logout']))
        createForm();

    elseif (empty($_COOKIE['username']) || $_COOKIE['logged'] == 0 || empty($_COOKIE['logged'])) {
        header("Location: ?logout=1");
        exit();
    }

    elseif (isset($_COOKIE['username']) && $_COOKIE['logged'] == 1 && isset($_GET['login']))
        createChat();

    else {
        header('Location: ?login=1');
        exit();
    }
}

?>
