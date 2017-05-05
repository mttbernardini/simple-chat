<?php
require_once("config.php");

//in caso di manutenzione:
if ($maint && $_COOKIE['maint'] != $maintValue && !($beta && $_COOKIE['beta'] == $betaValue)) {
    include("include/maintenance.html");
    exit();
}

//Escludere IE dalla Beta
if ($noIE && $beta && $_COOKIE['beta'] == $betaValue && stripos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== false) {
    include("include/maintenance-msie.html");
    exit();
}

function createForm(){
global $expireTime;
?>

        <form action="?aut=1" method="post" onmouseover="document.getElementById('input').focus();" style="text-align: center; margin: 0px 20%;">
          <div>Per favore, immetti il tuo nick per iniziare a chattare.</div>
          <div>
           <label>
             <span style="margin-right: 8px;">Nome:</span>
             <input class="text" type="text" name="name" id="input" maxlength="20" value="<?php echo $_COOKIE['username']; ?>" />
             <?php if($_GET['alreadylogged']) echo "<br /><span class=\"error\">Questo nickname è già stato utilizzato, oppure attendi $expireTime secondi e riprova</span>"; ?>
             <?php if($_GET['namerequired']) echo "<br /><span class=\"error\">È obbligatorio specificare un nickname</span>"; ?>
           </label>
          </div>
          <div style="padding-left: 60px; text-align: left;">
           <label>
             <input type="checkbox" name="remember" <?php if($_COOKIE['remember']) echo 'checked="checked"'; ?> />
             <span>Memorizza il mio nickname</span>
           </label><br />
           <label>
             <input type="checkbox" name="autologin" <?php if($_COOKIE['autologin']) echo 'checked="checked"'; ?> />
             <span>Effettua il login automaticamente</span>
           </label>
          </div>
          <div><button type="submit">Login</button></div>
          <input type="hidden" name="aut" value="1" />
        </form>

<?php
}

function createChat() {
    ?>

     <section id="settings">
        <article>
           <button id="closeSettings" onclick="document.getElementById('settings').style.display='none';">X</button>
           <div style="margin:1em">
              <h2>Impostazioni</h2>
              <?php include("include/settings.php"); ?>
           </div>
        </article>
        <div id="info">
           <div style="margin: 1em;">
           <?php include("include/info.html"); ?>
           </div>
        </div>
     </section>
     
     <section id="to-reload">
        <article id="messages" onscroll="checkBtn(this)">
        <?php include("include/messages.php"); ?>
        </article>
        
        <aside id="online">
        <?php include("include/users.php"); ?>
        </aside>
        
        <button id="skip" onclick="skipBT();"><img src="style/skip.png" alt="&#9660;" /></button>
     </section>

     <section id="sender" onmouseover="document.getElementById('msg').focus();" onkeyup="keypressed(event);">
         <div id="tools">
           <?php include('include/tools.html'); ?>
         </div>
         <div>
           <input type="text" name="msg" id="msg" />
           <button onclick="doPost();" style="width: 10%;">Invia</button>
           <button onclick="document.getElementById('msg').value=''; document.getElementById('msg').focus();" style="width: 15%">Cancella</button>
         </div>
         <div style="margin-top: 5px;">
           <span id="nick"></span>
           <button onclick="document.getElementById('settings').style.display='block';">Impostazioni</button>
           <button onclick="location.href='user.php?do=logout';">Esci</button>
         </div>
      </section>

<?php
    }

function createError() {
    ?>

<div class="error">Si è verificato un errore sconosciuto. Prova a ricaricare la pagina</div>

<?php
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

    elseif (isset($_COOKIE['username']) && $_COOKIE['logged'] == 1 && isset($_GET['login'])) {
        createChat();

    else {
        header('Location: ?login=1');
        exit();
    }
}

?>
