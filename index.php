<?php
session_start();

if (isset($_SESSION["ADMIN_DATA"]) or isset($_SESSION["ARCHIVISTE_DATA"])) {
  header("location: home.php");
} else {
  header("location: login.php");
}
