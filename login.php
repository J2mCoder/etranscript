<?php 
#-------------------------------------------------------------------------------------------
session_start();
#-------------------------------------------------------------------------------------------
require("require/connect_db.php");
#-------------------------------------------------------------------------------------------
if (isset($_SESSION["ADMIN_DATA"]) || isset($_SESSION["ARCHIVISTE_DATA"])) {
#-------------------------------------------------------------------------------------------
  header("location: home.php");
  exit;
#-------------------------------------------------------------------------------------------
}
#-------------------------------------------------------------------------------------------
if (isset($_COOKIE["AdminID"])) {
#-------------------------------------------------------------------------------------------
  $_SESSION["ADMIN_DATA"] = $_COOKIE["AdminID"];
  header("location: home.php");
  exit;
#-------------------------------------------------------------------------------------------
} elseif (isset($_COOKIE["ArchivisteID"])) {
#-------------------------------------------------------------------------------------------
  $_SESSION["ARCHIVISTE_DATA"] = $_COOKIE["ArchivisteID"];
  header("location: home.php");
  exit;
#-------------------------------------------------------------------------------------------
}
#-------------------------------------------------------------------------------------------
if(isset($_POST["log-in"])) {
#-------------------------------------------------------------------------------------------
if(!empty($_POST["login"]) && !empty($_POST["password"])) {
#-------------------------------------------------------------------------------------------
  $login = strip_tags($_POST["login"]);
  $password = strip_tags($_POST["password"]);
#-------------------------------------------------------------------------------------------
  $REQ_ADMIN = $connect_db->prepare("SELECT * FROM admin WHERE telephoneAdmin=? OR emailAdmin=?");
#-------------------------------------------------------------------------------------------
  $REQ_ADMIN->execute([$login,$login]);
#-------------------------------------------------------------------------------------------
  $REQ_ARCHIVISTE = $connect_db->prepare("SELECT * FROM archiviste WHERE telephoneArchi=? OR emailArchi=?");
#-------------------------------------------------------------------------------------------
  $REQ_ARCHIVISTE->execute([$login,$login]);
#-------------------------------------------------------------------------------------------
if($REQ_ADMIN->rowCount() == 1) {
#-------------------------------------------------------------------------------------------
  $ADMIN = $REQ_ADMIN->fetch();
#-------------------------------------------------------------------------------------------
if(password_verify($password, $ADMIN["mdpAdmin"])) {
#-------------------------------------------------------------------------------------------
  setcookie("AdminID", $ADMIN["AdminID"], time() + 6 * 30 * 24 * 60 * 60, "/");
#-------------------------------------------------------------------------------------------
  $_SESSION["ADMIN_DATA"] = $ADMIN["AdminID"];
#-------------------------------------------------------------------------------------------
  header("location:./");
#-------------------------------------------------------------------------------------------
} else { $eMsg = "Mot de passe incorrect"; }
#-------------------------------------------------------------------------------------------
} else if($REQ_ARCHIVISTE->rowCount() == 1){
#-------------------------------------------------------------------------------------------
  $ARCHIVISTE = $REQ_ARCHIVISTE->fetch();
#-------------------------------------------------------------------------------------------
if(password_verify($password, $ARCHIVISTE["mdpArchi"])) {
#-------------------------------------------------------------------------------------------
  setcookie("ArchivisteID", $ARCHIVISTE["ArchivisteID"], time() + 6 * 30 * 24 * 60 * 60, "/");
#-------------------------------------------------------------------------------------------
  $_SESSION["ARCHIVISTE_DATA"] = $ARCHIVISTE["ArchivisteID"];
#-------------------------------------------------------------------------------------------
  header("location:./");
#-------------------------------------------------------------------------------------------
} else { $eMsg = "Mot de passe incorrect"; }
#-------------------------------------------------------------------------------------------
} else { $eMsg = "Identifiant incorrect"; }
#-------------------------------------------------------------------------------------------
} else { $eMsg = "Tous les champs sont obligatoires"; }
#-------------------------------------------------------------------------------------------
}
#-------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<?php require('./widgets/head.php'); ?>

<body>
  <form method="post">
    <section class="d-flex justify-content-center align-items-center p-4" style="height: 100vh;">
      <div class="container">
        <div class="row">
          <div class="card shadow-sm p-0 m-0">
            <div class="card-header bg-transparent border-0 m-0">
              <div class="row">
                <div class="col-md-6 d-md-block d-none "></div>
                <div class="col-md-6">
                  <div class=""
                    style="font-size: 30px;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 600;"
                    class="col-12 col-md-9">Se conneter
                    <div class="trait" style="height: 5px;width: 8%;background-color: #00668c;"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body h-auto">
              <div class="row">
                <div class="col-md-6 d-md-block p-0 d-none mt-0 h-auto">
                  <img src="images.jpeg" width="100%" height="100%" alt="" style="object-fit:cover">
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center mt-0 h-auto">
                  <div class="col">
                    <?php if (isset($eMsg)) { ?>
                    <div class="alert alert-danger p-2"><?= $eMsg ?></div>
                    <?php } ?>
                    <div class="mb-3">
                      <input type="text" placeholder="Adresse e-mail ou Téléphone" name="login"
                        class="form-control p-2">
                    </div>
                    <div class="mb-3">
                      <input type="password" placeholder="mot de passe" name="password" class="form-control p-2">
                    </div>
                    <div class="mb-3">
                      <button style="width: 35%;background:#00668c" type="submit" name="log-in"
                        class="btn btn-primary border-0">Valider</button>
                    </div>
                    <p>Vous n'avez pas encore de compte ? <a href="sign-in"
                        class="text-primary text-decoration-underline">Inscrivez-vous ici</a>.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
  </form>
</body>

</html>