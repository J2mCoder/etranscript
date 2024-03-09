<?php
session_start();
require("./require/connect_db.php");
require("./require/treat-user.php");

$REQ_DEPARTEMENT     = $connect_db->query("SELECT * FROM departement ORDER BY DepartementID");
$REQ_FACULTE         = $connect_db->query("SELECT * FROM faculte ORDER BY FaculteID");

if(isset($_POST["search"])) {

  if(!empty($_POST["academic_year"]) or 
   !empty($_POST["departement"]) or 
   !empty($_POST["faculte"]) or 
   !empty($_POST["firstname"]) or 
   !empty($_POST["lastname"]) or 
   !empty($_POST["middlename"])){
    $AND = " AND ";
    if(!empty($_POST["academic_year"])){
        $academic_year       = strip_tags($_POST["academic_year"]);
        $value_academic_year = $AND."year_acStudent=".$academic_year;
    }else{
        $value_academic_year = NULL;
    }

    if(!empty($_POST["departement"])){
      $departement = strip_tags($_POST["departement"]);
      $value_departement = $AND."DepartementStudentID=".$departement;
    } else {
      $value_departement = NULL;
    }

    if(!empty($_POST["faculte"])){
      $faculte = strip_tags($_POST["faculte"]);
      $value_faculte = $AND."FaculteStundentID=".$faculte;
    } else {
      $value_faculte = NULL;
    }

    if(!empty($_POST["firstname"])){
      $firstname = strip_tags(ucfirst(strtolower($_POST["firstname"])));
      $value_firstname = $AND."prenomStudent LIKE '%".$firstname."%'";
    } else {
      $value_firstname = NULL;
    }

    if(!empty($_POST["middlename"])){
      $middlename = strip_tags(ucfirst(strtolower($_POST["middlename"])));
      $value_middlename = $AND."postnomStudent LIKE '%".$middlename."%'";
    } else {
      $value_middlename = NULL;
    }

    if(!empty($_POST["lastname"])){
      $lastname = strip_tags(ucfirst(strtolower($_POST["lastname"])));
      $value_lastname = $AND."nomStudent LIKE '%".$lastname."%'";
    } else {
      $value_lastname = NULL;
    }

    $REQ_STUDENTS = $connect_db->query("SELECT * FROM student WHERE verify_student=1".$value_academic_year.$value_departement.$value_faculte.$value_firstname.$value_lastname.$value_middlename." LIMIT 20");
    $COUNT_STUDENT = $REQ_STUDENTS->rowCount();
    
  } else {
    $AND = NULL;
    $REQ_STUDENTS = $connect_db->query("SELECT * FROM student ORDER BY datesave DESC LIMIT 20");
    $COUNT_STUDENT = $REQ_STUDENTS->rowCount();
  }
    
} else {

  $REQ_STUDENTS = $connect_db->query("SELECT * FROM student ORDER BY datesave DESC LIMIT 20");
  $COUNT_STUDENT = $REQ_STUDENTS->rowCount();
  
}


?>
<!DOCTYPE html>
<html lang="en">

<?php require('./widgets/head.php'); ?>

<body>

  <?php require("./widgets/header.php") ?>
  <br>
  <section>
    <div class="container">
      <div class="card p-5">
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque fugit facilis ad labore quia, quaerat dolor
          facere ducimus nobis quas quos voluptatibus corporis obcaecati minus officiis iusto velit vel odio?
        </p>
        <br>
        <div class="row gy-3 gy-md-4 justify-content-center">
          <?php if (!isset($_SESSION["ARCHIVISTE_DATA"])) { ?>
          <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-card border shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h4 class="card-subtitle text-body-secondary m-0 fs-6">Ajouter</h4>
                    <h5 class="card-title widget-card-title mb-3 fs-6">Archiviste</h5>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <a href="add-archiviste.php">
                        <div class="text-white rounded-circle p-3 d-flex align-items-center justify-content-center"
                          style=" background: var(--accent-100) !important;">
                          <i class="fa-solid fa-plus fs-6" style="color: var(--text-100);"></i>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-card border shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h4 class="card-subtitle text-body-secondary m-0 fs-6">Ajouter</h4>
                    <h5 class="card-title widget-card-title mb-3 fs-6">Etudiant</h5>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <a href="add-student.php">
                        <div
                          class="lh-1 text-white bg-primary rounded-circle p-3 d-flex align-items-center justify-content-center"
                          style=" background: var(--accent-100) !important;">
                          <i class="fa-solid fa-plus fs-6" style="color: var(--text-100);"></i>
                        </div>
                      </a>
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
                    <h4 class="card-subtitle text-body-secondary m-0 fs-6">Ajouter</h4>
                    <h5 class="card-title widget-card-title mb-3 fs-6">Faculté</h5>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <a href="">
                        <div
                          class="lh-1 text-white bg-primary rounded-circle p-3 d-flex align-items-center justify-content-center"
                          style=" background: var(--accent-100) !important;">
                          <i class="fa-solid fa-plus fs-6" style="color: var(--text-100);"></i>
                        </div>
                      </a>
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
                    <h4 class="card-subtitle text-body-secondary m-0 fs-6">Ajouter</h4>
                    <h5 class="card-title widget-card-title mb-3 fs-6 custom-text">Département</h5>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <a href="">
                        <div
                          class="lh-1 text-white bg-primary rounded-circle p-3 d-flex align-items-center justify-content-center"
                          style=" background: var(--accent-100) !important;">
                          <i class="fa-solid fa-plus fs-6" style="color: var(--text-100);"></i>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br>
  <section>
    <div class="container">
      <form action="" method="post">
        <div class="card border-0 searchBars d-flex flex-md-row p-3 gap-2 shadow-sm">
          <input type="text" class=" form-control" name="lastname" placeholder="Nom">
          <input type="text" class=" form-control" name="middlename" placeholder="Post-nom">
          <input type="text" class=" form-control" name="firstname" placeholder="Prenom">
          <select class="form-select w-auto" name="faculte" id="validationCustom04">
            <option value="">Faculté</option>
            <?php while ($FACULTE = $REQ_FACULTE->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?= $FACULTE['FaculteID'];?>"><?= $FACULTE['nom'];?></option>
            <?php } ?>
          </select>
          <select class="form-select w-auto" name="departement" id="validationCustom04">
            <option value="">Département</option>
            <?php while ($DEPARTEMENT = $REQ_DEPARTEMENT->fetch()) { ?>
            <option value="<?= $DEPARTEMENT["DepartementID"] ?>"><?= $DEPARTEMENT["nom"] ?></option>
            <?php } ?>
          </select>
          <select class="form-select w-auto" name="academic_year" id="validationCustom04">
            <option value="">Année</option>
            <?php
          $anneeActuelle = date("Y");
          for ($i = 1954; $i <= $anneeActuelle; $i++) {
            if ($_POST['academic_year'] == $i) {
              echo "<option value='$i' selected>$i</option>";
            } else {
              echo "<option value='$i'>$i</option>";
            }
          }
          ?>
          </select>
          <button type="submit" class=" btn btnSearch w-25 p-2 shadow-sm border-1" name="search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>
      </form>
    </div>
  </section>
  <br>
  <section>
    <div class="container">
      <div class="card">
        <div class="card-header bg-transparent p-4 border-light-subtle">
          <h5 class="card-title widget-card-title m-0">Résultat de la recherche (<?= $COUNT_STUDENT ?>)</h5>
        </div>
        <div class="card-body p-4">
          <table class="table table-hover table-bordered">
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
              <?php $s = 1;
              while ($STUDENTS = $REQ_STUDENTS->fetch()) {
                $req_fac = $connect_db->query("SELECT * FROM faculte WHERE FaculteID={$STUDENTS['FaculteStundentID']}");
                $fac = $req_fac->fetch();
                $req_dep = $connect_db->query("SELECT * FROM departement WHERE DepartementID={$STUDENTS['DepartementStudentID']}");
                $dep = $req_dep->fetch();
              ?>
              <tr>
                <th><?= $s++ ?></th>
                <td>
                  <figure>
                    <blockquote class="blockquote">
                      <h5><?= $STUDENTS['nomStudent']; ?></h5>
                      <p class="d-md-none"><?= $STUDENTS['postnomStudent'] . " " . $STUDENTS['prenomStudent']; ?></p>
                    </blockquote>
                    <figcaption class="blockquote-footer d-md-none">
                      <b><?= $fac['nom']; ?></b> <cite title="Source Title"> <?= $STUDENTS['year_acStudent']; ?></cite>
                    </figcaption>
                  </figure>
                </td>
                <td class="d-none d-md-table-cell"><?= $STUDENTS['postnomStudent']; ?></td>
                <td class="d-none d-md-table-cell"><?= $STUDENTS['prenomStudent']; ?></td>
                <td class="d-none d-md-table-cell"><?= $dep["nom"] ?? "introuvable"; ?></td>
                <td class="d-none d-md-table-cell"><?= $fac["nom"] ?? "introuvable"; ?></td>
                <td class="d-none d-md-table-cell"><?= $STUDENTS['year_acStudent']; ?></td>
                <td>
                  <a href="" class="bginfo p-2 rounded m-auto d-flex align-items-center justify-content-center"
                    style="color: var(--text-100) !important;background-color: var(--accent-100) !important;"><i
                      class="fa-solid fa-arrow-right text-black "></i>
                  </a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
  </section>
  <br>
  <?php require('widgets/footer.php'); ?>
</body>

</html>