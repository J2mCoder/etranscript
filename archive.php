<?php
session_start();
require("./require/connect_db.php");
require("./require/treat-user.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php require('./widgets/head.php'); ?>

<body>
  <?php require("./widgets/header.php") ?>
  <br>
  <section>
    <div class="container">
      <?php require("./require/archive-archiviste.php"); ?>
      <?php require("./require/archive-admin.php"); ?>
    </div>
  </section>
  <br>
  <?php require('widgets/footer.php'); ?>
</body>

</html>