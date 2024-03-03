<?php

if (isset($ARCHIVISTE)) {
  $REQ_STUDENTS = $connect_db->query("SELECT * FROM student WHERE ArchivisteStudentID=" . $ARCHIVISTE["ArchivisteID"] . " ORDER BY StudentID DESC");
  $COUNT_STUDENTS = $REQ_STUDENTS->rowCount();
  $FETCH_STUDENTS = $REQ_STUDENTS->fetch(PDO::FETCH_ASSOC);

  $month = date("m");
  $REQ_STUDENTS_MONTH_SAVE = $connect_db->query("SELECT  month(datesave) AS mois FROM student WHERE month(datesave) = '$month' && ArchivisteStudentID=" . $ARCHIVISTE["ArchivisteID"]);
  $COUNT_STUDENTS_MONTH_SAVE = $REQ_STUDENTS_MONTH_SAVE->rowCount();
  $MONTH_SAVE = $REQ_STUDENTS_MONTH_SAVE->fetch(PDO::FETCH_ASSOC);

  function convertirMois($numeroMois)
  {
    $mois = [
      1 => "Janvier",
      2 => "Février",
      3 => "Mars",
      4 => "Avril",
      5 => "Mai",
      6 => "Juin",
      7 => "Juillet",
      8 => "Août",
      9 => "Septembre",
      10 => "Octobre",
      11 => "Novembre",
      12 => "Décembre",
    ];
    return $mois[$numeroMois] ?? "Mois inconnu";
  }

?>
<div class="card p-4 mb-3">
  <div class="row gy-3 gy-md-4">
    <div class="col-12 col-sm-6 col-xl-3">
      <div class="card widget-card border shadow-sm">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-8">
              <h5 class="card-title widget-card-title mb-3">Etudiants</h5>
              <h4 class="card-subtitle text-body-secondary m-0">
                <?= $COUNT_STUDENTS ?><?= $COUNT_STUDENTS > 1 ? " Ajoutés" : " Ajouté" ?> </h4>
            </div>
            <div class="col-4">
              <div class="d-flex justify-content-end">
                <a href="">
                  <div
                    class="lh-1 text-white btnAdd rounded-circle p-3 d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-eye"></i>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="d-flex align-items-center mt-3">
                <?php
                  if ($COUNT_STUDENTS_MONTH_SAVE > 5) {
                  ?>
                <span
                  class="lh-1 me-3 bg-success-subtle text-success rounded-circle p-1 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-arrow-trend-up"></i>
                </span>
                <?php } else { ?>
                <span
                  class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-arrow-trend-down"></i>
                </span>
                <?php } ?>
                <div>
                  <p class="fs-7 mb-0"><?= $COUNT_STUDENTS_MONTH_SAVE; ?> Au mois
                    <?= convertirMois($MONTH_SAVE["mois"]); ?>
                  </p>
                  <p class="fs-7 mb-0 text-secondary">
                    <?= $COUNT_STUDENTS_MONTH_SAVE > 5 ? " Bilan positif" : "Bilan négatif" ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
      <div class="card widget-card border shadow-sm">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-8">
              <h5 class="card-title widget-card-title mb-3">Archivistes</h5>
              <h4 class="card-subtitle text-body-secondary m-0">6 Ajoutés</h4>
            </div>
            <div class="col-4">
              <div class="d-flex justify-content-end">
                <div class="lh-1 text-white btnAdd rounded-circle p-3 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-eye"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="d-flex align-items-center mt-3">
                <span
                  class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                  <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                </span>
                <div>
                  <p class="fs-7 mb-0">-3 non actif</p>
                  <p class="fs-7 mb-0 text-secondary">
                    cette semaine
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
      <div class="card widget-card border shadow-sm">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-8">
              <h5 class="card-title widget-card-title mb-3">Archivistes</h5>
              <h4 class="card-subtitle text-body-secondary m-0">6 Ajoutés</h4>
            </div>
            <div class="col-4">
              <div class="d-flex justify-content-end">
                <div class="lh-1 text-white btnAdd rounded-circle p-3 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-eye"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="d-flex align-items-center mt-3">
                <span
                  class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                  <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                </span>
                <div>
                  <p class="fs-7 mb-0">-3 non actif</p>
                  <p class="fs-7 mb-0 text-secondary">
                    cette semaine
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
      <div class="card widget-card border shadow-sm">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-8">
              <h5 class="card-title widget-card-title mb-3">Archivistes</h5>
              <h4 class="card-subtitle text-body-secondary m-0">6 Ajoutés</h4>
            </div>
            <div class="col-4">
              <div class="d-flex justify-content-end">
                <div class="lh-1 text-white btnAdd rounded-circle p-3 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-eye"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="d-flex align-items-center mt-3">
                <span
                  class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                  <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                </span>
                <div>
                  <p class="fs-7 mb-0">-3 non actif</p>
                  <p class="fs-7 mb-0 text-secondary">
                    cette semaine
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>