<?php

if(isset($_POST["change_info"])) {
#---------------------------------------------------------------------------------------------------------
if(!empty($_POST["nom"]) && $_POST["nom"] !=  $ADMIN["nomAdmin"]) {
#--------------------------------------------------------------------------------------------------------- 
   $nom = strip_tags(trim(ucfirst($_POST["nom"])));
#---------------------------------------------------------------------------------------------------------
if(strlen($nom) <= 20) {
#---------------------------------------------------------------------------------------------------------
  $update = $connect_db->prepare("UPDATE admin SET nomAdmin=? WHERE AdminID=".$ADMIN["AdminID"]);
  $update ->execute(array($nom));
  header("location:profil.php");
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "Votre nom  ne doit pas dépassé plus de 50 caractères !"; }
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "veuillez remplir le champs avec de nouvelle information"; }
#---------------------------------------------------------------------------------------------------------
if(!empty($_POST["postnom"]) && $_POST["postnom"] !=  $ADMIN["postnomAdmin"]) {
#--------------------------------------------------------------------------------------------------------- 
   $postnom = strip_tags(trim(ucfirst($_POST["postnom"])));
#---------------------------------------------------------------------------------------------------------
if(strlen($postnom) <= 20) {
#---------------------------------------------------------------------------------------------------------
  $update = $connect_db->prepare("UPDATE admin SET postnomAdmin=? WHERE AdminID=".$ADMIN["AdminID"]);
  $update ->execute(array($postnom));
  header("location:profil.php");
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "Votre postnom  ne doit pas dépassé plus de 50 caractères !"; }
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "veuillez remplir le champs avec de nouvelle information"; }
#---------------------------------------------------------------------------------------------------------
if(!empty($_POST["prenom"]) && $_POST["prenom"] !=  $ADMIN["prenomAdmin"]) {
#--------------------------------------------------------------------------------------------------------- 
   $prenom = strip_tags(trim(ucfirst($_POST["prenom"])));
#---------------------------------------------------------------------------------------------------------
if(strlen($prenom) <= 20) {
#---------------------------------------------------------------------------------------------------------
  $update = $connect_db->prepare("UPDATE admin SET prenomAdmin=? WHERE AdminID=".$ADMIN["AdminID"]);
  $update ->execute(array($prenom));
  header("location:profil.php");
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "Votre prenom  ne doit pas dépassé plus de 50 caractères !"; }
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "veuillez remplir le champs avec de nouvelle information"; }
#---------------------------------------------------------------------------------------------------------
if(!empty($_POST["telephone"]) && $_POST["telephone"] !=  $ADMIN["telephoneAdmin"]) {
#--------------------------------------------------------------------------------------------------------- 
   $telephone = strip_tags(trim(ucfirst($_POST["telephone"])));
#---------------------------------------------------------------------------------------------------------
if(strlen($telephone) == 10 && is_numeric($telephone)) {
#---------------------------------------------------------------------------------------------------------
   $req_phone = $connect_db->prepare("SELECT * FROM admin WHERE telephoneAdmin=?");
   $req_phone->execute(array($telephone));
   $verify_phone = $req_phone->rowCount();
#---------------------------------------------------------------------------------------------------------
if($verify_phone == 0) {
#---------------------------------------------------------------------------------------------------------
  $update = $connect_db->prepare("UPDATE admin SET telephoneAdmin=? WHERE AdminID=".$ADMIN["AdminID"]);
  $update ->execute(array($telephone));
  header("location:profil.php");
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "Le numéro téléphone que vouz avez introduit est déjà utilisé !"; }
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "Votre numéro téléphone n'est pas valide !"; }
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "veuillez remplir le champs avec de nouvelle information"; }
#---------------------------------------------------------------------------------------------------------
if(!empty($_POST["email"]) && $_POST["email"] !=  $ADMIN["emailAdmin"]) {
#--------------------------------------------------------------------------------------------------------- 
   $email = strip_tags(trim($_POST["email"]));
#---------------------------------------------------------------------------------------------------------
if(strlen($email) <= 50 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
#---------------------------------------------------------------------------------------------------------
   $req_mail = $connect_db->prepare("SELECT * FROM admin WHERE emailAdmin=?");
   $req_mail->execute(array($email));
   $verify_mail = $req_mail->rowCount();
#---------------------------------------------------------------------------------------------------------
if($verify_mail == 0) {
#---------------------------------------------------------------------------------------------------------
  $update = $connect_db->prepare("UPDATE admin SET emailAdmin=? WHERE AdminID=".$ADMIN["AdminID"]);
  $update ->execute(array($email));
  header("location:profil.php");
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "Le numéro téléphone que vouz avez introduit est déjà utilisé !"; }
#---------------------------------------------------------------------------------------------------------
} else { $eMsg =  "Votre adresse email n'est pas valide !"; }
#---------------------------------------------------------------------------------------------------------
} else { $eMsg = "veuillez remplir le champs avec de nouvelle information"; }
#---------------------------------------------------------------------------------------------------------   
}


if(isset($_POST["change_profil"])) {
        
$sizemax= 5097152;
$extvalide=array("jpg","png","jpeg");
#----------------------------------------------------------------------------------------------
if(!empty($_FILES["file"]["name"])){
#----------------------------------------------------------------------------------------------
    $file = strip_tags($_FILES["file"]["name"]);
    $extload = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $name_file = "photo-".substr(str_shuffle("123456789012345678901234567890"),0,9);
#----------------------------------------------------------------------------------------------
if($_FILES["file"]["size"] <= $sizemax){
#----------------------------------------------------------------------------------------------
if (in_array($extload, $extvalide)) {
    
#----------------------------------------------------------------------------------------------
    $chemin ="profil/".$name_file.".".$extload;
    $resultat = move_uploaded_file($_FILES["file"]["tmp_name"],$chemin);
    $file = $name_file.".".$extload;
#----------------------------------------------------------------------------------------------
    $UPDATE = $connect_db -> prepare("UPDATE admin SET profilAdmin=? WHERE AdminID=?");
    $UPDATE ->execute([$file,$ADMIN["AdminID"]]);
#---------------------------------------------------------------------------------------
    #$validate = true;
#----------------------------------------------------------------------------------------------
} else { echo "Mauvais format, l'extention de votre photo doit être de (jpg, jpeg, png)"; }
#----------------------------------------------------------------------------------------------
} else { echo "Votre photo ne doit pas avoir plus d'une taille de 2 Mo"; }
#----------------------------------------------------------------------------------------------
}
    
}

?>