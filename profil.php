<?php
session_start();
require("./require/connect_db.php");
require("./require/treat-user.php");

if(isset($_SESSION["ADMIN_DATA"])){
require("./admin_profil.php");
}else{ 
require("./archiviste_profil.php");
 }

?>
<!DOCTYPE html>
<html lang="fr">
<?php require('./widgets/head.php'); ?>

<body>
  <?php require("./widgets/header.php") ?>
  <br>
  <?php if(isset($_SESSION["ADMIN_DATA"])){ ?>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header bg-transparent ">
              <h3 class="text-center">Information du profil</h3>
            </div>
            <div class="card-body">
              <div class="text-center"> <img style="object-fit:cover"
                  src="<?php if($ADMIN["profilAdmin"] == NULL){ ?>./asset/default.png<?php }else{ echo 'profil/'.$ADMIN["profilAdmin"];} ?>"
                  class="rounded-circle" height="130" width="130" alt="..."> </div>
              <form method="post" enctype="multipart/form-data" class="text-center mt-2 mb-2">
                <h5 class="card-title"><?= $ADMIN["prenomAdmin"]." ".$ADMIN["nomAdmin"] ?></h5>
                <p class="card-text form-text ">Administrateur</p>
                <div class="d-inline-block btnAdd p-2 link-light lh-1 p-2 rounded"> <i class="fa-solid fa-upload"></i>
                  <input type="file" name="file" style="width:30px;margin-left:-25px;position:absolute;opacity:0">
                </div>
                <a href="deleteprofil.php" class="d-inline-block DeleteProfil p-2 link-light lh-1 p-2 rounded"> <i
                    class="fa-solid fa-trash"></i> </a><br><br>
                <div class="col-6 m-auto">
                  <button type="submit" name="change_profil" class="btn btnAdd w-100 ">Changer photo </button>
                </div><br>
                <div class="col-6 m-auto">
                  <a href="./require/log-out.php" class="d-inline-block DeleteProfil p-2 link-light lh-1 p-2 rounded">
                    <i class="fa-solid fa-power-off"></i> Deconnexion </a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card p-3 ">
            <div class="card-body p-4">
              <ul class="nav nav-tabs" id="profileTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                    data-bs-target="#overview-tab-pane" type="button" role="tab" aria-controls="overview-tab-pane"
                    aria-selected="true">Information</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"
                    tabindex="-1">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane"
                    type="button" role="tab" aria-controls="password-tab-pane" aria-selected="false" tabindex="-1">Mot
                    de passe</button>
                </li>
              </ul>
              <div class="tab-content pt-4" id="profileTabContent">
                <div class="tab-pane fade active show" id="overview-tab-pane" role="tabpanel"
                  aria-labelledby="overview-tab" tabindex="0">
                  <h5 class="mb-3">Profile</h5>
                  <div class="row g-0">
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Nom</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">
                        <?= $ADMIN["nomAdmin"] ?>
                      </div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Post-nom</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">
                        <?= $ADMIN["postnomAdmin"] ?>
                      </div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Prénom</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">
                        <?= $ADMIN["prenomAdmin"] ?>
                      </div>
                    </div>
                    <?php if(isset($_SESSION["ARCHIVISTE_DATA"])){ ?>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Address</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">Mountain View, California</div>
                    </div>
                    <?php } ?>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Rôle</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">
                        Administrateur Principal
                      </div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Téléphone</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">+243
                        <?= $ADMIN["telephoneAdmin"] ?>
                      </div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Email</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">
                        <?= $ADMIN["emailAdmin"] ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                  tabindex="0">
                  <form action="" method="post" class="row gy-3 gy-xxl-4">
                    <div class="col-12 col-md-6">
                      <label for="inputLastName" class="form-label">Votre nom</label>
                      <input type="text" class="form-control" name="nom" id="inputLastName"
                        value="<?= $ADMIN["nomAdmin"] ?>" name="lastname">
                    </div>
                    <div class="col-12 col-md-6">
                      <label for="inputMiddleName" class="form-label">Post-nom</label>
                      <input type="text" class="form-control" name="postnom" id="inputMiddleName"
                        value="<?= $ADMIN["postnomAdmin"] ?>">
                    </div>
                    <div class="col-12 col-md-6">
                      <label for="inputFirstName" class="form-label">Prénom</label>
                      <input type="text" class="form-control" name="prenom" id="inputFirstName"
                        value="<?= $ADMIN["prenomAdmin"] ?>">
                    </div>
                    <div class="col-12 col-md-6">
                      <label for="inputSkills" class="form-label">Télephone</label>
                      <input type="text" class="form-control" name="telephone" id="inputSkills"
                        value="<?= $ADMIN["telephoneAdmin"] ?>">
                    </div>
                    <div class="col-12 col-md-12">
                      <label for="inputJob" class="form-label">Email</label>
                      <input type="email" class="form-control" name="email" id="inputJob"
                        value="<?= $ADMIN["emailAdmin"] ?>">
                    </div>
                    <div class="col-12">
                      <button type="submit" name="change_info" class="btn btnSearch w-100 ">Sauvagarder </button>
                    </div>
                  </form>
                </div>
                <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab"
                  tabindex="0">
                  <form action="" method="post">
                    <div class="row gy-3 gy-xxl-4">
                      <div class="col-12">
                        <label for="currentPassword" class="form-label">Mot de passe actuel</label>
                        <input type="password" class="form-control" name="oldpassword" id="currentPassword">
                      </div>
                      <div class="col-12">
                        <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" name="newpassword" id="newPassword">
                      </div>
                      <div class="col-12">
                        <label for="confirmPassword" class="form-label">Confirmez mot de passe</label>
                        <input type="password" class="form-control" name="confirpassowrd" id="confirmPassword">
                      </div>
                      <div class="col-12">
                        <button type="submit" name="change_info" class="btn btnSearch w-100 ">Sauvagarder </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php }else{ ?>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header bg-transparent ">
              <h3 class="text-center">Information profil</h3>
            </div>
            <div class="card-body">
              <div class="text-center"> <img style="object-fit:cover"
                  src="<?php if($ARCHIVISTE["profilArchi"]== NULL){ ?>./asset/default.png<?php }else{ echo 'profil/'.$ARCHIVISTE["profilArchi"];} ?>"
                  class="rounded-circle" height="130" width="130" alt="..."> </div>
              <form method="post" enctype="multipart/form-data" class="text-center mt-2 mb-2">
                <h5 class="card-title"><?= $ARCHIVISTE["prenomArchi"]." ".$ARCHIVISTE["nomArchi"] ?></h5>
                <p class="card-text form-text ">Archiviste</p>
                <div class="d-inline-block btnAdd p-2 link-light lh-1 p-2 rounded"> <i class="fa-solid fa-upload"></i>
                  <input type="file" name="file" style="width:30px;margin-left:-25px;position:absolute;opacity:0">
                </div>
                <a href="deleteprofil.php" class="d-inline-block DeleteProfil p-2 link-light lh-1 p-2 rounded"> <i
                    class="fa-solid fa-trash"></i> </a><br><br>
                <div class="col-6 m-auto">
                  <button type="submit" name="change_profil" class="btn btnAdd w-100 ">Changer photo </button>
                </div><br>
                <div class="col-6 m-auto">
                  <a href="./require/log-out.php" class="d-inline-block DeleteProfil p-2 link-light lh-1 p-2 rounded">
                    <i class="fa-solid fa-power-off"></i>Deconnexion </a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card p-3 ">
            <div class="card-body p-4">
              <ul class="nav nav-tabs" id="profileTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                    data-bs-target="#overview-tab-pane" type="button" role="tab" aria-controls="overview-tab-pane"
                    aria-selected="true">Information</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"
                    tabindex="-1">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane"
                    type="button" role="tab" aria-controls="password-tab-pane" aria-selected="false" tabindex="-1">Mot
                    de passe</button>
                </li>
              </ul>
              <div class="tab-content pt-4" id="profileTabContent">
                <div class="tab-pane fade active show" id="overview-tab-pane" role="tabpanel"
                  aria-labelledby="overview-tab" tabindex="0">
                  <h5 class="mb-3">Profile</h5>
                  <div class="row g-0">
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Nom</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">
                        <?= $ARCHIVISTE["nomArchi"]?>
                      </div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Post-nom</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">
                        <?= $ARCHIVISTE["postnomArchi"]?>
                      </div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Prénom</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">
                        <?= $ARCHIVISTE["prenomArchi"]?>
                      </div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Address</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2"><?= $ARCHIVISTE["adresseArchi"]?></div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Rôle</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2"> Archiviste </div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Téléphone</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">+243
                        <?= $ARCHIVISTE["telephoneArchi"]?>
                      </div>
                    </div>
                    <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                      <div class="p-2">Email</div>
                    </div>
                    <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                      <div class="p-2">
                        <?= $ARCHIVISTE["emailArchi"]?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                  tabindex="0">
                  <form action="" method="post" class="row gy-3 gy-xxl-4">
                    <div class="col-12 col-md-6">
                      <label for="inputLastName" class="form-label">Votre nom</label>
                      <input type="text" class="form-control" name="nom" id="inputLastName"
                        value="<?= $ARCHIVISTE["nomArchi"]?>" name="lastname">
                    </div>
                    <div class="col-12 col-md-6">
                      <label for="inputMiddleName" class="form-label">Post-nom</label>
                      <input type="text" class="form-control" name="postnom" id="inputMiddleName"
                        value="<?= $ARCHIVISTE["postnomArchi"]?>">
                    </div>
                    <div class="col-12 col-md-6">
                      <label for="inputFirstName" class="form-label">Prénom</label>
                      <input type="text" class="form-control" name="prenom" id="inputFirstName"
                        value="<?= $ARCHIVISTE["prenomArchi"] ?>">
                    </div>
                    <div class="col-12 col-md-6">
                      <label for="inputSkills" class="form-label">Télephone</label>
                      <input type="text" class="form-control" name="telephone" id="inputSkills"
                        value=" <?= $ARCHIVISTE["telephoneArchi"]?>">
                    </div>
                    <div class="col-12 col-md-6">
                      <label for="inputJob" class="form-label">Adresse</label>
                      <input type="text" class="form-control" name="adresse" id="inputJob"
                        value="<?= $ARCHIVISTE["adresseArchi"]?>">
                    </div>
                    <div class="col-12 col-md-6">
                      <label for="inputJob" class="form-label">Email</label>
                      <input type="email" class="form-control" name="email" id="inputJob"
                        value="<?= $ARCHIVISTE["emailArchi"]?>">
                    </div>
                    <div class="col-12">
                      <button type="submit" name="change_info" class="btn btnSearch w-100 ">Sauvagarder </button>
                    </div>
                  </form>
                </div>
                <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab"
                  tabindex="0">
                  <form action="" method="post">
                    <div class="row gy-3 gy-xxl-4">
                      <div class="col-12">
                        <label for="currentPassword" class="form-label">Mot de passe actuel</label>
                        <input type="password" class="form-control" name="oldpassword" id="currentPassword">
                      </div>
                      <div class="col-12">
                        <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" name="newpassword" id="newPassword">
                      </div>
                      <div class="col-12">
                        <label for="confirmPassword" class="form-label">Confirmez mot de passe</label>
                        <input type="password" class="form-control" name="confirpassowrd" id="confirmPassword">
                      </div>
                      <div class="col-12">
                        <button type="submit" name="change_info" class="btn btnSearch w-100 ">Sauvagarder </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>
</body>

</html>