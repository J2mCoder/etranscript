<?php
session_start();
require("./require/connect_db.php");
require("./require/treat-user.php");
require("./require/archive-admin.php");

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
      <div class="row gy-3 gy-md-4">
        <div class="col-12 col-lg-6 col-xl-7 mb-3">
          <div class="card widget-card border-light shadow-sm h-100">
            <div class="card-body p-4">
              <div class="d-block d-sm-flex align-items-center justify-content-between mb-3">
                <div class="mb-3 mb-sm-0">
                  <h5 class="card-title widget-card-title">Sales Overview</h5>
                </div>
                <div class=" d-flex justify-content-center align-items-center gap-2">
                  <select class="form-select text-secondary border-light-subtle">
                    <option value="1">March 2023</option>
                    <option value="2">April 2023</option>
                    <option value="3">May 2023</option>
                    <option value="4">June 2023</option>
                  </select>
                  <div class="btn btnAdd">valider</div>
                </div>
              </div>
              <div id="bsb-chart-1" style="min-height: 416.863px;">

              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-5 mb-3">
          <div class="card widget-card border-light shadow-sm">
            <div class="card-body p-4">
              <div class="d-block d-sm-flex align-items-center justify-content-between mb-3">
                <div class="mb-3 mb-sm-0">
                  <h5 class="card-title widget-card-title">Department Sales</h5>
                </div>
                <div class=" d-flex justify-content-center align-items-center gap-2">
                  <select class="form-select text-secondary border-light-subtle">
                    <option value="1">March 2023</option>
                    <option value="2">April 2023</option>
                    <option value="3">May 2023</option>
                    <option value="4">June 2023</option>
                  </select>
                  <div class="btn btnAdd">valider</div>
                </div>
              </div>
              <div id="bsb-chart-1" style="min-height: 416.863px;">

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card p-4">
        <table class="table table-hover table-responsive">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col" class="d-md-none">Information</th>
              <th scope="col" class="d-none d-md-table-cell">Nom</th>
              <th scope="col" class="d-none d-md-table-cell">Post-nom</th>
              <th scope="col" class="d-none d-md-table-cell">Prénom</th>
              <th scope="col" class="d-none d-md-table-cell">Département</th>
              <th scope="col" class="d-none d-md-table-cell">Faculté</th>
              <th scope="col" class="d-none d-md-table-cell">Année</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>1</th>
              <td>
                <figure>
                  <blockquote class="blockquote">
                    <h5>djdujdujdudud</h5>
                    <p class="d-md-none">dududududu</p>
                  </blockquote>
                  <figcaption class="blockquote-footer d-md-none">
                    <b>jdjdjdjdjdjdj</b> <cite title="Source Title">djddjdjdjd</cite>
                  </figcaption>
                </figure>
              </td>
              <td class="d-none d-md-table-cell">jeee</td>
              <td class="d-none d-md-table-cell">hdhdhdh</td>
              <td class="d-none d-md-table-cell">iiidid</td>
              <td class="d-none d-md-table-cell">hfhfsoso</td>
              <td class="d-none d-md-table-cell">iedidjdjdjd</td>
              <td>
                <a href="" class="bginfo p-2 rounded m-auto d-flex align-items-center justify-content-center"
                  style="color: var(--text-100) !important;background-color: var(--accent-100) !important;"><i
                    class="fa-solid fa-arrow-right text-black "></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <br>
  <?php require('widgets/footer.php'); ?>
</body>

</html>