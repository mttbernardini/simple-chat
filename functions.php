<?php

/*
 * Copyright (c) 2011 Matteo Bernardini
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * 	http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once("config.php");

function createMaint() {
	require("./include/maintenance.html");
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
    global $nickname, $timeToExpire, $maint, $maintValue;

	if ($maint && $_COOKIE['maint'] != $maintValue)
	    createMaint();

    else if (isset($_GET['invalid']))
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
