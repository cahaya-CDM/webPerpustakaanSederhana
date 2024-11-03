<?php
session_start();
session_unset();
session_destroy();
$_SESSION = [];

setcookie('id', '', time() - 1);
setcookie('key', '', time() - 1);

header('location: login.php');
exit;

?>