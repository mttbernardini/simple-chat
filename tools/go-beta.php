<?php
if (isset($_GET['permanent'])) setCookie("beta", "1234", time() + (89 * 89 * 89 * 89), "/3g/chat");
elseif (isset($_GET['delete'])) setCookie("beta", "", time() - 1);
else setCookie("beta", "1234", 0, "/3g/chat");
Header("Location: ../");
?>
