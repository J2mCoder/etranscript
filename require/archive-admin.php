<?php

if (isset($ADMIN)) {
  #----------------------------------------------------------------
  $REQ_STUDENTS = $connect_db->query("SELECT * FROM student");
  $COUNT_STUDENTS = $REQ_STUDENTS->rowCount();
  $FETCH_STUDENTS = $REQ_STUDENTS->fetch(PDO::FETCH_ASSOC);
  #----------------------------------------------------------------
  $month = date("m");
  $year = date("Y");
  $m = substr($month,1,1);
  #----------------------------------------------------------------
  $REQ_STUDENTS_MONTH_SAVE = $connect_db->query("SELECT  month(datesave) AS mois FROM student WHERE month(datesave) = '$month' AND year(datesave) = '$year'");
  $COUNT_STUDENTS_MONTH_SAVE = $REQ_STUDENTS_MONTH_SAVE->rowCount();
  $MONTH_SAVE = $REQ_STUDENTS_MONTH_SAVE->fetch(PDO::FETCH_ASSOC);
  #----------------------------------------------------------------
  $REQ_STUDENT_GRADUAT = $connect_db->query("SELECT *, month(datesave) AS mois FROM student WHERE diplomeGraduat IS NOT NULL AND month(datesave) = '$month' AND year(datesave) = '$year'");
  $COUNT_GRADUAT = $REQ_STUDENT_GRADUAT->rowCount();
  $FETCH_GRADUAT = $REQ_STUDENT_GRADUAT->fetch(PDO::FETCH_ASSOC);
  #----------------------------------------------------------------
  $REQ_STUDENT_GRADUAT_COUNT = $connect_db->query("SELECT * FROM student WHERE diplomeGraduat IS NOT NULL ");
  $COUNT_GRADUAT_TOTAL = $REQ_STUDENT_GRADUAT_COUNT->rowCount();
  #----------------------------------------------------------------
  $REQ_STUDENT_LICENCE = $connect_db->query("SELECT *, month(datesave) AS mois FROM student WHERE diplomeLicence IS NOT NULL AND year(datesave) = '$year' AND month(datesave) = '$month'");
  $COUNT_LICENCE = $REQ_STUDENT_LICENCE->rowCount();
  $FETCH_LICENCE = $REQ_STUDENT_LICENCE->fetch(PDO::FETCH_ASSOC);
  #----------------------------------------------------------------
  $REQ_STUDENT_LICENCE_ALL = $connect_db->query("SELECT * FROM student WHERE diplomeLicence IS NOT NULL");
  $COUNT_LICENCE_ALL = $REQ_STUDENT_LICENCE_ALL->rowCount();
  #----------------------------------------------------------------
  $REQ_STUDENT_BACALL = $connect_db->query("SELECT *, month(datesave) AS mois FROM student WHERE (diplomeMaster IS NOT NULL OR diplomeDoctorat IS NOT NULL) AND diplomeGraduat IS NOT NULL AND diplomeLicence IS NOT NULL AND year(datesave) = '$year' AND month(datesave) = '$month'");
  $COUNT_BACALL = $REQ_STUDENT_BACALL->rowCount();
  $FETCH_BACALL = $REQ_STUDENT_BACALL->fetch(PDO::FETCH_ASSOC);
  #----------------------------------------------------------------
  $REQ_STUDENT_BACALL_ALL = $connect_db->query("SELECT * FROM student WHERE (diplomeMaster IS NOT NULL OR diplomeDoctorat IS NOT NULL) AND diplomeGraduat IS NOT NULL AND diplomeLicence IS NOT NULL");
  $COUNT_BACALL_ALL = $REQ_STUDENT_BACALL_ALL->rowCount();
  #----------------------------------------------------------------
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
    return $mois[$numeroMois] ?? "Pas d'enregistrement";
  }
  #----------------------------------------------------------------
  if (isset($_GET["departement_update"])) {
    $dptmt_url = strip_tags($_GET["departement_update"]);
    $select_departemt = $connect_db->query("SELECT * FROM departement WHERE DepartementID=".$dptmt_url);
    $departement = $select_departemt->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["change_departement"])) {
      if (!empty($_POST["departement"])) {
        if ($_POST["departement"] !== $departement['nom']) {
          $dptmt = strip_tags($_POST["departement"]);
          $insert_dptmt = $connect_db->prepare("UPDATE departement SET nom = ?, datesave =NOW() WHERE DepartementID = ?");
          $insert_dptmt->execute([$dptmt, $departement["DepartementID"]]);
          header("location:archive.php");
        } else {
          $msg = "Le département éxiste déjà";
        }
      } 
    }
  }

  if (isset($_GET["department_delete"])) {
    $deleteDptmt = strip_tags($_GET["department_delete"]);
    $selectDeleteDptmt = $connect_db->query("SELECT * FROM departement WHERE DepartementID =".$deleteDptmt);
    $DptmtSelect = $selectDeleteDptmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["delete_btn_departement"])) {
      $select_departemt = $connect_db->query("DELETE FROM departement WHERE DepartementID=".$DptmtSelect["DepartementID"]);
      header("location:archive.php");
    }
  }

  if (isset($_GET["faculte_delete"])) {
    $deleteFaculte = strip_tags($_GET["faculte_delete"]);
    $selectDeleteFaculte = $connect_db->query("SELECT * FROM faculte WHERE FaculteID =".$deleteFaculte);
    $FaculteSelect = $selectDeleteFaculte->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["delete_btn_faculte"])) {
      $delete_faculte = $connect_db->query("DELETE FROM faculte WHERE FaculteID=".$FaculteSelect["FaculteID"]);
      header("location:archive.php");
    }
  }

  if (isset($_POST["addderpartement"])) {
    if (!empty($_POST["addderpartement"])) {
      $dptmt = strip_tags($_POST["addderpartement"]);
      $select = $connect_db->query("SELECT * FROM departement WHERE nom = '$dptmt'");
      $count = $select->rowCount();
      if ($count == 0) {
      $insert_dptmt = $connect_db->prepare("INSERT INTO departement (nom, datesave) VALUES (?, NOW())");
      $insert_dptmt->execute([$dptmt]);
      header("location:archive.php");
      } else {
        $msg = "Le département existe déjà";
      }
    } else {
      $msg = "Le département est vide";
    }
  }

  if (isset($_POST["addfaculte"])) {
    if (!empty($_POST["addfaculte"]) && !empty($_POST["dptmt"])) {
      $faculte = strip_tags($_POST["addfaculte"]);
      $dptmt = strip_tags($_POST["dptmt"]);

      $select = $connect_db->query("SELECT * FROM faculte WHERE nom = '$faculte'");
      $count = $select->rowCount();

      $select_departemt = $connect_db->query("SELECT * FROM departement WHERE DepartementID = '$dptmt'");
      $count_dptmt = $select_departemt->rowCount();
      $fetch_dptmt = $select_departemt->fetch();

      if ($count == 0 && $count_dptmt == 1) {
      $insert_dptmt = $connect_db->prepare("INSERT INTO faculte (nom,DepartementID, datesave) VALUES (?,?, NOW())");
      $insert_dptmt->execute([$faculte,$fetch_dptmt["DepartementID"]]);
      header("location:archive.php");
      } else {
        $msg = "Le département existe déjà";
      }
    } else {
      $msg = "Le département est vide";
    }
  }

  if (isset($_GET["faculte_update"])) {
    $faculte_update = strip_tags($_GET["faculte_update"]);
    $select_faculte = $connect_db->query("SELECT * FROM faculte WHERE FaculteID=".$faculte_update);
    $faculter = $select_faculte->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["change_departement"])) {
      if (!empty($_POST["departement"])) {
        if ($_POST["departement"] !== $departement['nom']) {
          $dptmt = strip_tags($_POST["departement"]);
          $insert_dptmt = $connect_db->prepare("UPDATE departement SET nom = ?, datesave =NOW() WHERE DepartementID = ?");
          $insert_dptmt->execute([$dptmt, $departement["DepartementID"]]);
          header("location:archive.php");
        } else {
          $msg = "Le département éxiste déjà";
        }
      } 
    }
  }

  function recupererDonneesTable($table, $champ=null, $search=null,$page=null,$limit=null) {
    global $connect_db;

    if (isset($page) && $page != null) {
      $elementsParPage = 4;
      $q = $connect_db->query("SELECT * FROM $table");
      $nombreTotalElements = $q->rowCount();
      $nombreDePages = ceil($nombreTotalElements / $elementsParPage);
      $pageActuelle = $page;
      $offset = ($pageActuelle - 1) * $elementsParPage;
      $req = $connect_db->query("SELECT * FROM $table LIMIT $offset, $elementsParPage");
      return $req;
    } elseif (isset($champ, $search) && $champ != null && $search != null) {
      $req = $connect_db->prepare("SELECT * FROM $table WHERE $champ LIKE :search ".$limit);
      $req->execute(['search' => '%' . $search . '%']);
      return $req;
    } else {
      $req = $connect_db->query("SELECT * FROM $table ".$limit);
      return $req;
    }
  }
?>
<div class="card p-4 mb-3 shadow-sm">
  <div class="row gy-3 gy-md-4">
    <div class="col-12 col-sm-6 col-xl-3">
      <div class="card widget-card border shadow-sm">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-10">
              <h5 class="card-title widget-card-title mb-3 text-uppercase">Etudiants</h5>
              <h4 class="card-subtitle text-body-secondary m-0">
                <?= $COUNT_STUDENTS ?>
                <?= $COUNT_STUDENTS > 1 ? " Ajoutés" : " Ajouté" ?>
              </h4>
            </div>
            <div class="col-2">
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
                <span class="lh-1 me-3 btnArch rounded-circle p-3 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-calendar-days"></i>
                </span>
                <div>
                  <p class="fs-7 mb-0 fw-medium">
                    <?= $COUNT_STUDENTS_MONTH_SAVE; ?> Au mois de
                    <?= convertirMois($MONTH_SAVE["mois"]??false) ?>
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
            <div class="col-10">
              <h5 class="card-title widget-card-title mb-3 text-uppercase">graduat</h5>
              <h4 class="card-subtitle text-body-secondary m-0">
                <?= $COUNT_GRADUAT_TOTAL ?>
                <?= $COUNT_GRADUAT_TOTAL > 1 ? " Ajoutés" : " Ajouté" ?>
              </h4>
            </div>
            <div class="col-2">
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
                <span class="lh-1 me-3 btnArch rounded-circle p-3 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-graduation-cap"></i>
                </span>
                <div>
                  <p class="fs-7 mb-0 fw-medium">
                    <?= $COUNT_GRADUAT; ?> Au mois de
                    <?= convertirMois($FETCH_GRADUAT["mois"] ?? $m); ?>
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
            <div class="col-10">
              <h5 class="card-title widget-card-title mb-3 text-uppercase">licence</h5>
              <h4 class="card-subtitle text-body-secondary m-0">
                <?= $COUNT_LICENCE_ALL ?>
                <?= $COUNT_LICENCE_ALL > 1 ? " Ajoutés" : " Ajouté" ?>
              </h4>
            </div>
            <div class="col-2">
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
                <span class="lh-1 me-3 btnArch rounded-circle p-3 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-graduation-cap"></i>
                </span>
                <div>
                  <p class="fs-7 mb-0 fw-medium">
                    <?= $COUNT_LICENCE; ?> Au mois de <?= convertirMois($FETCH_LICENCE["mois"] ?? $m); ?>
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
            <div class="col-10">
              <h5 class="card-title widget-card-title mb-3 fs-6">BAC +4 ou +5</h5>
              <h4 class="card-subtitle text-body-secondary m-0">
                <?= $COUNT_BACALL_ALL ?>
                <?= $COUNT_BACALL_ALL > 1 ? " Ajoutés" : " Ajouté" ?>
              </h4>
            </div>
            <div class="col-2">
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
                <span class="lh-1 me-3 btnArch rounded-circle p-3 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-graduation-cap"></i>
                </span>
                <div>
                  <p class="fs-7 mb-0 fw-medium">
                    <?= $COUNT_BACALL; ?> Au mois de <?= convertirMois($$COUNT_BACALL["mois"] ?? $m); ?>
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
<div class="row gy-3 gy-md-4">
  <div class="col-12 col-lg-6 col-xl-7 mb-3">
    <div class="card widget-card border shadow-sm">
      <div class="card-body p-4">
        <div class="d-block d-sm-flex align-items-center justify-content-between mb-3">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title widget-card-title">Liste des archiviste</h5>
          </div>
          <form method="post" class=" d-flex justify-content-center align-items-center gap-2">
            <input type="text" class="form-control" placeholder="Nom de l'archiviste" name="searchArviste">
            <button type="submit" class="btn btnAdd">Rechercher</button>
          </form>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Profil</th>
                <th scope="col">Nom</th>
                <th scope="col" class="text-nowrap">Post-nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Téléphone</th>
                <th scope="col" class="text-nowrap">E-mail</th>
                <th scope="col">Sexe</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $c = 1;
              if(isset($_POST['searchArviste']) && !empty($_POST['searchArviste'])) {
                $searchArviste = strip_tags($_POST['searchArviste']);
                $sql = recupererDonneesTable('archiviste', 'CONCAT(nomArchi,postnomArchi,prenomArchi)', $searchArviste);
              } else {
                $sql = recupererDonneesTable("archiviste");
              }
              $count = $sql->rowCount();
              if ($count == 0) {
                echo '<tr><td colspan="9" class="text-center">Aucun résultat trouvé</td></tr>';
              } else {
              while ($ARCHIVISTE = $sql->fetch()) {
              ?>
              <tr>
                <th><?= $c++; ?></th>
                <td class="text-nowrap">
                  <img src="<?php 
                  if (isset($ARCHIVISTE) && $ARCHIVISTE["profilArchi"] != NULL) { 
                    echo './profil/' . $ARCHIVISTE["profilArchi"];
                  } else {
                    echo './asset/default.png';
                  } 
                  ?>" alt="..." class="object-fit-cover" height="40px" width="40px" style="border-radius: 50%;" />
                </td>
                <td class="text-nowrap"><?= $ARCHIVISTE["nomArchi"]; ?></td>
                <td class="text-nowrap"><?= $ARCHIVISTE["postnomArchi"]; ?></td>
                <td class="text-nowrap"><?= $ARCHIVISTE["prenomArchi"]; ?></td>
                <td class="text-nowrap">0<?= $ARCHIVISTE["telephoneArchi"]; ?></td>
                <td class="text-nowrap"><?= $ARCHIVISTE["emailArchi"]; ?></td>
                <td class="text-nowrap"><?= $ARCHIVISTE["sexeArchi"] == 1 ? "Homme" : "Femme"; ?></td>
                <td>
                  <a href="" class="bginfo p-2 rounded m-auto d-flex align-items-center justify-content-center"
                    style="color: var(--text-100) !important;background-color: var(--accent-100) !important;"><i
                      class="fa-solid fa-arrow-right text-black "></i>
                  </a>
                </td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div class="card widget-card border shadow-sm mt-3">
      <div class="card-body p-4">
        <div class="d-block d-sm-flex align-items-center justify-content-between mb-3">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title widget-card-title">Liste des étudiants
              <br>
              ajouter récemment
            </h5>
          </div>
          <form method="post" class="d-flex justify-content-center align-items-center gap-2">
            <input type="text" class="form-control" placeholder="Nom de l'étudiant" name="searchStudent">
            <button class="btn btnAdd">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col" class=" text-nowrap">Post-nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Département</th>
                <th scope="col">Faculté</th>
                <th scope="col">Année</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $s = 1;
              if(isset($_POST['searchStudent']) && !empty($_POST['searchStudent'])) {
                $searchStudent = strip_tags($_POST['searchStudent']);
                $sql = recupererDonneesTable('student', 'CONCAT(nomStudent,postnomStudent,prenomStudent)', $searchStudent);
              } else {
                $sql = recupererDonneesTable("student");
              }
              $count = $sql->rowCount();
              if ($count == 0) {
                echo '<tr><td colspan="9" class="text-center">Aucun résultat trouvé</td></tr>';
              } else {
              while ($STUDENTS = $sql->fetch()) {
                $req_fac = $connect_db->query("SELECT * FROM faculte WHERE FaculteID={$STUDENTS['FaculteStundentID']}");
                $fac = $req_fac->fetch();
                $req_dep = $connect_db->query("SELECT * FROM departement WHERE DepartementID={$STUDENTS['DepartementStudentID']}");
                $dep = $req_dep->fetch();
              ?>
              <tr>
                <th><?= $s++ ?></th>
                <td class="text-nowrap"><?= $STUDENTS['nomStudent']; ?></td>
                <td class="text-nowrap"><?= $STUDENTS['postnomStudent']; ?></td>
                <td class="text-nowrap"><?= $STUDENTS['prenomStudent']; ?></td>
                <td class="text-nowrap"><?= $dep["nom"]; ?></td>
                <td class="text-nowrap"><?= $fac["nom"] ?? "Introuvable" ?></td>
                <td class="text-nowrap"><?= $STUDENTS['year_acStudent']; ?></td>
                <td>
                  <a href="" class="bginfo p-2 rounded m-auto d-flex align-items-center justify-content-center"
                    style="color: var(--text-100) !important;background-color: var(--accent-100) !important;"><i
                      class="fa-solid fa-arrow-right text-black "></i>
                  </a>
                </td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6 col-xl-5 mb-3">
    <div class="card widget-card border shadow-sm mb-3">
      <div class="card-body p-4">
        <div class="d-block d-sm-flex align-items-center justify-content-between mb-3">
          <div class="mb-3 mb-sm-0 me-4">
            <h5 class="card-title widget-card-title">Département</h5>
          </div>
          <form method="post" class=" d-flex justify-content-center align-items-center gap-2">
            <input type="text" class=" form-control" placeholder="département" name="searchDepartement"
              value="<?php if (isset($_POST['searchDepartement'])) echo $_POST['searchDepartement']; ?>">
            <button type="submit" class="btn btnAdd">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <a href="archive.php?Add_Departement=true" class="btn btnAdd">
              <i class="fa-solid fa-plus fs-6"></i>
            </a>
          </form>
        </div>
        <div id="bsb-chart-1">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Facultés</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $a = 1;
              if(isset($_POST['searchDepartement']) && !empty($_POST['searchDepartement'])) {
                $search_departement = strip_tags($_POST['searchDepartement']);
                $sql = recupererDonneesTable('departement', 'nom', $search_departement);
              } else {
                $sql = recupererDonneesTable("departement");
              }
              $count = $sql->rowCount();
              if ($count == 0) {
                echo '<tr><td colspan="4" class="text-center">Aucun résultat trouvé</td></tr>';
              } else {
              while ($DEPARTEMENT = $sql->fetch()) {
              ?>
              <tr>
                <td class="text-nowrap"><?= $a++; ?></td>
                <td class="text-nowrap w-50 d-table-cell"><?= $DEPARTEMENT["nom"]; ?></td>
                <td class="text-nowrap w-50 d-table-cell"><?= $DEPARTEMENT["nom"]; ?></td>
                <td class=" d-flex gap-2">
                  <a href="archive.php?departement_update=<?php echo urlencode($DEPARTEMENT['DepartementID']); ?>"
                    class="d-inline-block btnAdd p-2 link-light lh-1 p-2 rounded">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                  <a href="archive.php?department_delete=<?php echo urlencode($DEPARTEMENT['DepartementID']); ?>"
                    class="d-inline-block DeleteProfil p-2 link-light lh-1 p-2 rounded">
                    <i class="fa-solid fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php } } ?>
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div class="card widget-card border shadow-sm">
      <div class="card-body p-4">
        <div class="d-block d-sm-flex align-items-center justify-content-between mb-3">
          <div class="mb-3 mb-sm-0 me-5">
            <h5 class="card-title widget-card-title">Facultés</h5>
          </div>
          <form method="post" class=" d-flex justify-content-center align-items-center gap-2">
            <input type="text" class=" form-control" placeholder="Faculté" name="searchFaculte">
            <button type="submit" class="btn btnAdd">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <a href="archive.php?Add_faculte=true" class="btn btnAdd">
              <i class="fa-solid fa-plus fs-6"></i>
            </a>
          </form>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Département</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $b = 1;
              if(isset($_POST['searchFaculte']) && !empty($_POST['searchFaculte'])) {
                $searchFaculte = strip_tags($_POST['searchFaculte']);
                $sql = recupererDonneesTable('faculte', 'nom', $searchFaculte);
              } elseif (isset($_GET["page"],$_GET["tab"]) && !empty($_GET["page"]) && !empty($_GET["tab"])) {
                $page = strip_tags($_GET["page"]);
                $table = strip_tags($_GET["tab"]);
                $sql = recupererDonneesTable($table, null, null, $page);
              }else {
                $limit = "LIMIT 4";
                $sql = recupererDonneesTable("faculte",null,null,null, $limit);
              }
              $count = $sql->rowCount();
              if ($count == 0) {
                echo '<tr><td colspan="4" class="text-center">Aucun résultat trouvé</td></tr>';
              } else {
              while ($FACULTE = $sql->fetch()) {
                $selectdptmt = $connect_db->query("SELECT * FROM departement WHERE DepartementID=".$FACULTE["DepartementID"]);
                $dptmt_fetch  = $selectdptmt->fetch();
              ?>
              <tr>
                <td class="text-nowrap"><?= $b++; ?></td>
                <td class="text-nowrap w-50 d-table-cell"><?= $FACULTE["nom"]; ?></td>
                <td class="text-nowrap w-50 d-table-cell"><?= $dptmt_fetch["nom"]; ?></td>
                <td class=" d-flex gap-2">
                  <a href="archive.php?faculte_update=<?php echo urlencode($FACULTE["FaculteID"]); ?>"
                    class="d-inline-block btnAdd p-2 link-light lh-1 p-2 rounded">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                  <a href="archive.php?faculte_delete=<?php echo urlencode($FACULTE["FaculteID"]); ?>"
                    class="d-inline-block DeleteProfil p-2 link-light lh-1 p-2 rounded">
                    <i class="fa-solid fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
          <?php 
          $sql = recupererDonneesTable("faculte",null,null,null, null);  
          $count = $sql->rowCount();
          if ($count > 7 && isset($_GET['tab']) && $_GET['tab'] == 'faculte') {
          ?>
          <nav>
            <ul class="pagination">
              <?php 
              // Affiche le lien vers la page précédente
              $elementsParPage = 4;
              $q = $connect_db->query("SELECT * FROM faculte");
              $nombreTotalElements = $q->rowCount();
              $nombreDePages = ceil($nombreTotalElements / $elementsParPage);
              $pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              
              if ($pageActuelle > 1) {
                $a = $pageActuelle - 1;
              ?>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="archive.php?page=<?= $a; ?>&tab=faculte"
                  aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php }

              for ($i = 1; $i <= $nombreDePages; $i++) { ?>
              <?php if($pageActuelle == $i){ ?>
              <li class="page-item">
                <a class="page-link bg-pagine-active border" href="#"><?= $i; ?></a>
              </li>
              <?php } else {?>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="archive.php?page=<?= $i;?>&tab=faculte"><?= $i;?></a>
              </li>
              <?php } ?>
              <?php }
              if ($pageActuelle < $nombreDePages) { 
              $x = $pageActuelle + 1;  
              ?>
              <li class="page-item">
                <a class="page-link bg-pagine border" href="archive.php?page=<?= $x; ?>&tab=faculte" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
              <?php } ?>
            </ul>
          </nav>
          <?php 
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="faculte_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if(isset($msg)) { ?>
          <div class="alert alert-danger mb-3 p-2" role="alert">
            <?= isset($msg) ? $msg : $msg = null;  ?>
          </div>
          <?php } ?>
          <div class="mb-3">
            <label for="departement" class="mb-2">Département :</label>
            <select name="dptmt" id="departement" class=" form-select">
              <option value="">Choisir un département</option>
              <?php
              $selectdptmt = $connect_db->query("SELECT * FROM departement");
              while ($dptmt = $selectdptmt->fetch()) {
              ?>
              <option value="<?= $dptmt["DepartementID"];?>"
                <?= $dptmt["DepartementID"] == $faculter["DepartementID"] ? "selected" : "";  ?>><?= $dptmt["nom"];?>
              </option>
              <?php }?>
            </select>
          </div>
          <div class="">
            <label for="faculte" class="mb-2">Faculté :</label>
            <input type="text" class="form-control" id="faculte" name="addfaculte" value="<?= $faculter["nom"] ?>"
              placeholder="Ajouter une faculté" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn DeleteProfil" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btnAdd" name="addDepartement">Enregistrer</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="AddFaculte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if(isset($msg)) { ?>
          <div class="alert alert-danger mb-3 p-2" role="alert">
            <?= isset($msg) ? $msg : $msg = null;  ?>
          </div>
          <?php } ?>
          <div class="mb-3">
            <select name="dptmt" class=" form-select">
              <option value="">Choisir un département</option>
              <?php
              $selectdptmt = $connect_db->query("SELECT * FROM departement");
              while ($dptmt = $selectdptmt->fetch()) {
              ?>
              <option value="<?= $dptmt["DepartementID"];?>"><?= $dptmt["nom"];?></option>
              <?php }?>
            </select>
          </div>
          <div class="">
            <input type="text" class="form-control" name="addfaculte" placeholder="Ajouter une faculté" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn DeleteProfil" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btnAdd" name="addDepartement">Enregistrer</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="AddDepartement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if(isset($msg)) { ?>
          <div class="alert alert-danger mb-3 p-2" role="alert">
            <?= isset($msg) ? $msg : $msg = null;  ?>
          </div>
          <?php } ?>
          <div class="">
            <input type="text" class="form-control" name="addderpartement" placeholder="Ajouter un département"
              required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn DeleteProfil" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btnAdd">Enregistrer</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="Modify_Departement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modification du département</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body border-0">
          <div>
            <label for="modifDepart" class="mb-2">Modifier le département</label>
            <input type="text" class="form-control p-2" name="departement" id="modifDepart" placeholder="Département"
              value="<?= isset($departement) ? $departement['nom'] : ''; ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn DeleteProfil" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btnAdd" name="change_departement">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="Delete_Departement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modification du département</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body border-0">
          <div>
            <div class=" alert-danger">
              <h4>Vous le vous supprimez : <?= $DptmtSelect["nom"]; ?></h4>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn DeleteProfil" data-bs-dismiss="modal">Non</button>
          <button type="submit" class="btn btnAdd" name="delete_btn_departement">Supprimer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="Delete_faculte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modification du département</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body border-0">
          <div>
            <div class="alert-danger">
              <h4>Vous le vous supprimez : <?= $FaculteSelect["nom"]; ?></h4>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn DeleteProfil" data-bs-dismiss="modal">Non</button>
          <button type="submit" class="btn btnAdd" name="delete_btn_faculte">Supprimer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php } ?>