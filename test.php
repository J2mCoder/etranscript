<?php
// Connexion à la base de données (utilisez vos propres informations)
$cnx = new PDO('mysql:host=localhost;dbname=ma_base_de_donnees;charset=utf8', 'utilisateur', 'mot_de_passe');

// Requête pour récupérer tous les éléments de la table
$query = 'SELECT * FROM `ma_table`';
$resultSet = $cnx->query($query);

// Nombre d'éléments par page
$elementsParPage = 10;

// Calcul du nombre total d'éléments
$nombreTotalElements = $resultSet->rowCount();

// Calcul du nombre total de pages
$nombreDePages = ceil($nombreTotalElements / $elementsParPage);

// Page actuelle (récupérée depuis l'URL ou définie par défaut)
$pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcul de l'offset pour la requête LIMIT
$offset = ($pageActuelle - 1) * $elementsParPage;

// Requête pour récupérer les éléments de la page actuelle
$queryPage = "SELECT * FROM `ma_table` LIMIT $offset, $elementsParPage";
$resultSetPage = $cnx->query($queryPage);

// Affichage des éléments
while ($element = $resultSetPage->fetch()) {
    // Affichez les données ici
    // Exemple : echo $element['nom'];
}
?>
<?php
// Affiche le lien vers la page précédente
if ($pageActuelle > 1) {
    echo '<a href="?page=' . ($pageActuelle - 1) . '">Précédent</a> ';
}

// Affiche les numéros de page avec des liens
for ($i = 1; $i <= $nombreDePages; $i++) {
    echo '<a href="?page=' . $i . '">' . $i . '</a> ';
}

// Affiche le lien vers la page suivante
if ($pageActuelle < $nombreDePages) {
    echo '<a href="?page=' . ($pageActuelle + 1) . '">Suivant</a>';
}
?>













<div class="row">
  <div style="margin: auto;background-color: white;height: 500px;border-radius: 10px;" class="col-12 col-md-12">
    <div class="row">
      <div style="height: 495px;width: 50%;margin-top: 5px;" class="col-12 col-d-none col-md-4"> <img src="images.jpeg"
          width="100%" height="100%" alt="" style="object-fit:cover"> </div>
      <div style="height: 499px;overflow: hidden;overflow-y: scroll;" class="col-12 col-md-6">
        <br>
        <div
          style="font-size: 30px;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 600;height: 60px;"
          class="col-12 col-md-9">Inscription
          <div class="trait" style="height: 5px;width: 8%;background-color: #00668c;"></div>
          <br>
        </div>
        <?php if (isset($eMsg)) { ?><div class="alert alert-danger"><?= $eMsg ?></div><?php } ?>
        <input type="text" placeholder="Nom" name="nom" class="form-control">
        <br>
        <input type="text" placeholder="post-nom" name="postnom" class="form-control p-2">
        <br>
        <input type="text" placeholder="Penom" name="prenom" class="form-control p-2">
        <br>
        <input type="text" placeholder="Telephone" name="tel" class="form-control p-2">
        <br>
        <input type="email" placeholder="Email" name="email" class="form-control p-2">
        <br>
        <select name="sexe" id="" class="form-select">
          <option>-- Sexe</option>
          <option value="1">Homme</option>
          <option value="2">femme</option>
        </select>
        <br>
        <input type="password" placeholder="mot de passe" name="psw1" class="form-control p-2">
        <br>
        <input type="password" placeholder="Confirme mot de passe" name="psw2" class="form-control p-2">
        <br>
        <button style="width: 35%;background:#00668c" type="submit" name="register"
          class="btn btn-primary">Valider</button>
        <br>
        <br>
        <p>Vous avez un compte? cliquer <a href="login">ici</a> pour vous connecté</p>
        <br>
        <br>
      </div>
    </div>
  </div>
</div>




decort



<?php 
?>
<!DOCTYPE html>
<html lang="en">
<?php require('./widgets/head.php'); ?>

<body style="background-color: #F7F9F9;">
  <?php require("./widgets/header.php") ?>
  <div class="container">
    <div style="height: auto;overflow-x: hidden;margin-top: 50px;" class="card p-4">
      <div class="row">
        <a href="archive.php?id=1" style="height: 120px;border-radius: 15px;text-decoration:none;color:black;"
          class="col-10 col-md-3  mx-5 <?php if(isset($_GET["id"])){?><?php if($_GET["id"]==1){?>shadow-sm<?php }else{?>border<?php }?><?php }else{?> shadow-sm<?php }?>">
          <div style="height: 60px;width: 100%;display: flex;" class=" mt-4">
            <div style="height: auto;width: fit-content;" class="mx-2"> <label
                style="opacity:25%;color:black;">Nombre</label><br><label style="color:black;">Archiviste</label></div>
            <div
              style="background-color:#71c4ef;height: 60px;width: 60px;border-radius: 100%;margin-left: 40%;display: flex;align-items: center;justify-content: center;"
              class=""><label style="color:black;">12</label></div>
          </div>
        </a>

        <a href="archive.php?id=2" style="height: 120px;border-radius: 15px;text-decoration:none;color:black;"
          class="col-10 col-md-3 mx-5 <?php if(isset($_GET["id"])){?><?php if($_GET["id"]==2){?> shadow-sm<?php }else{?> border<?php }?><?php }else{?>border<?php }?>">
          <div style="height: 60px;width: 100%;display: flex;" class=" mt-4">
            <div style="height: auto;width: fit-content;" class="mx-2"> <label
                style="opacity:25%;color:black;">2024</label><br><label style="color:black;">Etudiant</label></div>
            <div
              style="background-color:#71c4ef;height: 60px;width: 60px;border-radius: 100%;margin-left: 40%;display: flex;align-items: center;justify-content: center;"
              class=""><label style="color:black;">12</label></div>
          </div>
        </a>

        <a href="archive.php?id=3" style="height: 120px;border-radius: 15px;text-decoration:none;color:black;"
          class="col-10 col-md-3 mx-5 <?php if(isset($_GET["id"])){?><?php if($_GET["id"]==3){ ?>shadow-sm<?php }else{?>border <?php }?><?php }else{?> border<?php }?>">
          <div style="height: 60px;width: 100%;display: flex;" class=" mt-4">
            <div style="height: auto;width: fit-content;" class="mx-2"> <label
                style="opacity:25%;color:black;">totale</label><br><label style="color:black;">Document</label></div>
            <div
              style="background-color:#71c4ef;height: 60px;width: 60px;border-radius: 100%;margin-left: 40%;display: flex;align-items: center;justify-content: center;"
              class=""><label style="color:black;">12</label></div>
          </div>
        </a>
      </div>
      <?php if(isset($_GET["id"])){?>
      <?php
                $id = $_GET["id"];
                switch($id)
                {
                    case 1:require("nombre_archiviste.php");
                    break;
                    case 2: require("annee_etudiant.php");
                    break;
                    case 3:require('total_document.php');
                    break;
                    default:echo "<h1>"."arreter de jouer avec l'url"."</h1>";
                    break;
                } 
               ?>

      <?php }else{?>
      <?php require("nombre_archiviste.php");?>
      <?php }?>
    </div>
  </div>
</body>

</html>