<?php
#-----------------------------------------------------------------------------------------
require("require/connect_db.php");
#-----------------------------------------------------------------------------------------
if (isset($_POST["register"])) {
  #----------------------------------------------------------------------------------------- 
  if (
    !empty($_POST["nom"]) && !empty($_POST["postnom"]) && !empty($_POST["prenom"]) &&
    !empty($_POST["tel"]) && !empty($_POST["email"]) && !empty($_POST["sexe"]) && !empty($_POST["psw1"])
    && !empty($_POST["psw2"])
  ) {
    #-----------------------------------------------------------------------------------------    
    $nom = ucfirst(strip_tags(trim(mb_strtolower($_POST["nom"]))));
    $postnom = ucfirst(strip_tags(trim(mb_strtolower($_POST["postnom"]))));
    $prenom = ucfirst(strip_tags(trim(mb_strtolower($_POST["prenom"]))));
    $sex = strip_tags(trim($_POST["sexe"]));
    $email = strip_tags(trim(mb_strtolower($_POST["email"])));
    $phone = strip_tags(trim($_POST["tel"]));
    $password = strip_tags($_POST["psw1"]);
    $password_confirm = strip_tags($_POST["psw2"]);
    #-----------------------------------------------------------------------------------------
    if (strlen($nom) <= 20 && strlen($postnom) <= 20 && strlen($prenom) <= 20) {
      if (strlen($email) <= 50 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (strlen($phone) == 10 && is_numeric($phone)) {
          #----------------------------------------------------------------------------------------- 
          $req_mail = $connect_db->prepare("SELECT * FROM admin WHERE emailAdmin=?");
          $req_mail->execute(array($email));
          $verify_mail = $req_mail->rowCount();
          #-----------------------------------------------------------------------------------------
          $req_phone = $connect_db->prepare("SELECT * FROM admin WHERE telephoneAdmin=?");
          $req_phone->execute(array($phone));
          $verify_phone = $req_phone->rowCount();
          #-----------------------------------------------------------------------------------------   
          if ($verify_mail == 0) {
            if ($verify_phone == 0) {
              if ($password == $password_confirm) {
                #-----------------------------------------------------------------------------------------    
                $password = password_hash($password, PASSWORD_DEFAULT);
                #-----------------------------------------------------------------------------------------    
                $INSERT = $connect_db->prepare("INSERT INTO admin(nomAdmin,postnomAdmin,prenomAdmin,telephoneAdmin,emailAdmin,sexeAdmin,mdpAdmin,datesave) VALUES (?,?,?,?,?,?,?,NOW())");
                $INSERT->execute(array($nom, $postnom, $prenom, $phone, $email, $sex, $password));
                header("location:login");
                #-----------------------------------------------------------------------------------------   
              } else {
                $eMsg = "Vos mots de passe ne sont pas identiques !";
              }
              #-----------------------------------------------------------------------------------------
            } else {
              $eMsg = "Le numéro téléphone que vouz avez introduit est déjà utilisé !";
            }
            #-----------------------------------------------------------------------------------------
          } else {
            $eMsg = "L'adresse email que vouz avez introduit est déjà utilisé !";
          }
          #-----------------------------------------------------------------------------------------
        } else {
          $eMsg = "Votre numéro téléphone n'est pas valide !";
        }
        #-----------------------------------------------------------------------------------------
      } else {
        $eMsg = "Votre adresse email n'est pas valide !";
      }
      #-----------------------------------------------------------------------------------------
    } else {
      $eMsg = "Votre prénom, nom ou votre post-nom ne doivent pas dépassé plus de 20 caractères !";
    }
    #-----------------------------------------------------------------------------------------
  } else {
    $eMsg = "veuillez remplir tout les champs ";
  }
  #-----------------------------------------------------------------------------------------
}
#-----------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">

<?php require('./widgets/head.php'); ?>

<body>
  <form method="post">
    <section class="d-flex justify-content-center align-items-center p-4" style="height: 100vh;">
      <div class="container">
        <div class="row">
          <div class="card shadow-sm p-0 m-0" style="max-height:80vh; height:100%;">
            <div class="card-header bg-transparent border-0">
              <div class="row">
                <div class="col-md-6 d-md-block d-none"></div>
                <div class="col-md-6">
                  <div
                    style="font-size: 30px;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 600;height: 60px;"
                    class="col-12 col-md-9">Inscription
                    <div class="trait" style="height: 5px;width: 8%;background-color: #00668c;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body overflow-hidden">
              <div class="row">
                <div class="col-md-6 d-md-block p-0 d-none mt-0 h-auto">
                  <img src="images.jpeg" width="100%" height="100%" alt="" style="object-fit:cover">
                </div>
                <div style="height: 350px;overflow: hidden;overflow-y: scroll;" class="col-12 col-md-6">
                  <?php if (isset($eMsg)) { ?><div class="alert alert-danger p-2"><?= $eMsg ?></div><?php } ?>
                  <div class="mb-3">
                    <input type="text" placeholder="Nom" name="nom" class="form-control p-2">
                  </div>
                  <div class="mb-3">
                    <input type="text" placeholder="post-nom" name="postnom" class="form-control p-2">
                  </div>
                  <div class="mb-3">
                    <input type="text" placeholder="Penom" name="prenom" class="form-control p-2">
                  </div>
                  <div class="mb-3">
                    <input type="text" placeholder="Téléphone" name="tel" class="form-control p-2">
                  </div>
                  <div class="mb-3">
                    <input type="email" placeholder="Email" name="email" class="form-control p-2">
                  </div>
                  <div class="mb-3">
                    <select name="sexe" id="" class="form-select">
                      <option>-- Sexe</option>
                      <option value="1">Homme</option>
                      <option value="2">femme</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <input type="password" placeholder="mot de passe" name="psw1" class="form-control p-2">
                  </div>
                  <div class="mb-3">
                    <input type="password" placeholder="Confirme mot de passe" name="psw2" class="form-control p-2">
                  </div>
                  <div class="mb-3">
                    <button style="width: 35%;background:#00668c" type="submit" name="register"
                      class="btn btn-primary">Valider</button>
                  </div>
                  <div class="mb-3">
                    <p>Vous avez déjà un compte ? <a href="login"
                        class="text-primary text-decoration-underline">Connectez-vous ici.</a>
                    </p>
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