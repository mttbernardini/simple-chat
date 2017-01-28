<?php
if (isset($_GET['permanent'])) setCookie("maint", "1293", time() + (89 * 89 * 89 * 89), "/3g/chat");
elseif (isset($_GET['delete'])) setCookie("maint", "", time() - 1);
else setCookie("maint", "1293", 0, "/3g/chat");
Header("Location: ../");
?>
