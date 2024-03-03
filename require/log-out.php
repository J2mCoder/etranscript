<?php

session_start();

$_SESSION["ADMIN_DATA"];


session_destroy();

header("location:../login");
