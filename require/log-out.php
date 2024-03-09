<?php

session_start();

$_SESSION = array();
session_destroy();

setcookie("AdminID", "", time() - 3600, "/");
setcookie("ArchivisteID", "", time() - 3600, "/");

header("location:../login");
exit;