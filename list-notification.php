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
  <div class="d-flex flex-column flex-md-row p-4 gap-4 align-items-center justify-content-center">
    <div class="container">
      <div class="list-group w-100">
        <?php for ($i = 0; $i <= 10; $i++) { ?>
          <a href="notification.php" class="list-group-item list-group-item-action d-flex gap-3 py-3 text-black " aria-current="true">
            <div class="d-flex gap-2 w-100 justify-content-between">
              <div>
                <h6 class="mb-0">List group item heading</h6>
                <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
              </div>
              <small class="opacity-50 text-nowrap">
                <?php
                if ($i == 0) {
                  echo "Aujoud'hui";
                } else {
                  echo $i . " j ";
                }
                ?>
              </small>
            </div>
          </a>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

</html>