<?php
session_start();

if (isset($_SESSION["ADMIN_DATA"])) {
  $_SESSION["ADMIN_DATA"] = $_COOKIE["AdminID"];
  header("location: home.php");
} elseif (isset($_SESSION["ARCHIVISTE_DATA"])) {
  $_SESSION["ARCHIVISTE_DATA"] = $_COOKIE["ArchivisteID"];
  header("location: home.php");
} else {
  header("location: login.php");
}