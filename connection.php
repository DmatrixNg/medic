<?php
ob_start();
session_start();
$db = new SQLite3('dr_assistant.db');



include "class/user.php";

$user = new User($db);
?>
