<?php
session_start();
require("./require/connect_db.php");
require("./require/treat-user.php");

#-----------------------------------------------------------------------------------------
if (isset($_POST["register"])) {
  #----------------------------------------------------------------------------------------- 
  if (
    !empty($_POST["nom"]) && !empty($_POST["postnom"]) && !empty($_POST["prenom"]) &&
    !empty($_POST["tel"]) && !empty($_POST["email"]) && !empty($_POST["sexe"]) && !empty($_POST["psw1"])
    && !empty($_POST["psw2"]) && !empty($_POST["adresse"])
  ) {
    #-----------------------------------------------------------------------------------------    
    $nom = ucfirst(strip_tags(trim(mb_strtolower($_POST["nom"]))));
    $postnom = ucfirst(strip_tags(trim(mb_strtolower($_POST["postnom"]))));
    $prenom = ucfirst(strip_tags(trim(mb_strtolower($_POST["prenom"]))));
    $sex = strip_tags(trim($_POST["sexe"]));
    $email = strip_tags(trim(mb_strtolower($_POST["email"])));
    $phone = strip_tags(trim($_POST["tel"]));
    $adresse = strip_tags($_POST["adresse"]);
    $password = strip_tags($_POST["psw1"]);
    $password_confirm = strip_tags($_POST["psw2"]);
    #-----------------------------------------------------------------------------------------
    $sizemax = 5097152;
    $extvalide = array("jpg", "png", "jpeg");
    #----------------------------------------------------------------------------------------------
    if (!empty($_FILES["file"]["name"])) {
      #----------------------------------------------------------------------------------------------
      $file = strip_tags($_FILES["file"]["name"]);
      $extload = strtolower(pathinfo($file, PATHINFO_EXTENSION));
      $name_file = "photo-" . substr(str_shuffle("123456789012345678901234567890"), 0, 9);
      #----------------------------------------------------------------------------------------------
      if ($_FILES["file"]["size"] <= $sizemax) {
        #----------------------------------------------------------------------------------------------
        if (in_array($extload, $extvalide)) {
          #----------------------------------------------------------------------------------------------
          $chemin = "profil/" . $name_file . "." . $extload;
          $resultat = move_uploaded_file($_FILES["file"]["tmp_name"], $chemin);
          $file = $name_file . "." . $extload;
          #----------------------------------------------------------------------------------------------
          #$validate = true;
          #----------------------------------------------------------------------------------------------
        } else {
          echo "Mauvais format, l'extention de votre photo doit être de (jpg, jpeg, png)";
        }
        #----------------------------------------------------------------------------------------------
      } else {
        echo "Votre photo ne doit pas avoir plus d'une taille de 2 Mo";
      }
      #----------------------------------------------------------------------------------------------
    }
    #-----------------------------------------------------------------------------------------
    if (strlen($nom) <= 20 && strlen($postnom) <= 20 && strlen($prenom) <= 20) {
      if (strlen($email) <= 50 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (strlen($phone) == 10 && is_numeric($phone)) {
          #----------------------------------------------------------------------------------------- 
          $req_mail = $connect_db->prepare("SELECT * FROM archiviste WHERE emailArchi=?");
          $req_mail->execute(array($email));
          $verify_mail = $req_mail->rowCount();
          #-----------------------------------------------------------------------------------------
          $req_phone = $connect_db->prepare("SELECT * FROM archiviste WHERE telephoneArchi=?");
          $req_phone->execute(array($phone));
          $verify_phone = $req_phone->rowCount();
          #-----------------------------------------------------------------------------------------   
          if ($verify_mail == 0) {
            if ($verify_phone == 0) {
              if ($password == $password_confirm) {
                #-----------------------------------------------------------------------------------------    
                $password = password_hash($password, PASSWORD_DEFAULT);
                #-----------------------------------------------------------------------------------------    
                $INSERT = $connect_db->prepare("INSERT INTO archiviste(nomArchi,postnomArchi,prenomArchi,telephoneArchi,emailArchi,sexeArchi,adresseArchi,profilArchi,mdpArchi,datesave) VALUES (?,?,?,?,?,?,?,?,?,NOW())");
                $INSERT->execute(array($nom, $postnom, $prenom, $phone, $email, $sex, $adresse, $file, $password));
                header("location:add-archiviste");
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
  <?php require("./widgets/header.php") ?>
  <br>

  <div class="container">
    <div class="card p-4">


      <form class="row g-3" method="post" enctype="multipart/form-data">

        <h2>Ajouter archiviste</h2>
        <?php if (isset($eMsg)) { ?><div class="alert alert-danger"><?= $eMsg ?></div><?php } ?>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Nom</label>
          <input type="text" class="form-control" name="nom" id="inputEmail4">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Postnom</label>
          <input type="text" class="form-control" name="postnom" id="inputPassword4">
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Prenom</label>
          <input type="text" class="form-control" name="prenom" id="inputCity">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Photo</label>
          <input type="file" class="form-control" name="file" id="inputPassword4">
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Telephone</label>
          <input type="text" class="form-control" name="tel" id="inputCity">
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Email</label>
          <input type="text" class="form-control" name="email" id="inputCity">
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Adresse</label>
          <input type="text" class="form-control" name="adresse" id="inputCity">
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Sexe</label>
          <select class="form-select" name="sexe" aria-label="Default select example">
            <option>-- Sexe</option>
            <option value="1">Homme</option>
            <option value="2">Femme</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" name="psw1" id="inputCity">
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Confirm Mot de passe</label>
          <input type="password" class="form-control" name="psw2" id="inputCity">
        </div>
        <div class="col-md-6">
          <button type="submit" name="register" class="btn btnAdd w-100 ">Ajouter </button>
        </div>
      </form>
    </div>
  </div>
</body>
<br>

</html>