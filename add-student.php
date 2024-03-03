<?php
session_start();
require("./require/connect_db.php");
require("./require/treat-user.php");

#-----------------------------------------------------------------------------------------
$REQ_faculte = $connect_db->query("SELECT * FROM faculte");
#-----------------------------------------------------------------------------------------
$REQ_depaertement = $connect_db->query("SELECT * FROM departement");
#-----------------------------------------------------------------------------------------
if (isset($_POST["register"])) {
    #----------------------------------------------------------------------------------------- 
    if (
        !empty($_POST["nom"]) && !empty($_POST["postnom"]) && !empty($_POST["prenom"]) &&
        !empty($_POST["tel"]) && !empty($_POST["email"]) && !empty($_POST["sexe"]) && !empty($_POST["etat_civil"])
        && !empty($_POST["nationalite"]) && !empty($_POST["adresse"]) && !empty($_POST["faculte"]) && !empty($_POST["datenaisse"])
        && !empty($_POST["departement"]) && !empty($_POST["anneacademique"]) && !empty($_POST["lieunaiss"])
    ) {
        #-----------------------------------------------------------------------------------------    
        $nom = ucfirst(strip_tags(trim(mb_strtolower($_POST["nom"]))));
        $postnom = ucfirst(strip_tags(trim(mb_strtolower($_POST["postnom"]))));
        $prenom = ucfirst(strip_tags(trim(mb_strtolower($_POST["prenom"]))));
        $sex = strip_tags(trim($_POST["sexe"]));
        $email = strip_tags(trim(mb_strtolower($_POST["email"])));
        $phone = strip_tags(trim($_POST["tel"]));
        $adresse = strip_tags($_POST["adresse"]);
        $etat_civil = strip_tags($_POST["etat_civil"]);
        $nationalite = strip_tags($_POST["nationalite"]);
        $faculte = strip_tags($_POST["faculte"]);
        $datenaisse = strip_tags($_POST["datenaisse"]);
        $departement = strip_tags($_POST["departement"]);
        $anneacademique = strip_tags($_POST["anneacademique"]);
        $lieunaiss = strip_tags(ucfirst($_POST["lieunaiss"]));

        #---------------------------------file2--------------------------------------------------------
        $sizemax = 5097152;
        $extvalide = array("jpg", "png", "jpeg");
        #----------------------------------------------------------------------------------------------
        if (!empty($_FILES["file2"]["name"])) {
            #----------------------------------------------------------------------------------------------
            $file2 = strip_tags($_FILES["file2"]["name"]);
            $extload = strtolower(pathinfo($file2, PATHINFO_EXTENSION));
            $name_file = "photo-" . substr(str_shuffle("123456789012345678901234567890"), 0, 9);
            #----------------------------------------------------------------------------------------------
            if ($_FILES["file2"]["size"] <= $sizemax) {
                #----------------------------------------------------------------------------------------------
                if (in_array($extload, $extvalide)) {
                    #----------------------------------------------------------------------------------------------
                    $chemin = "dossier/" . $name_file . "." . $extload;
                    $resultat = move_uploaded_file($_FILES["file2"]["tmp_name"], $chemin);
                    $file2 = $name_file . "." . $extload;
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
        #---------------------------------file3--------------------------------------------------------
        $sizemax = 5097152;
        $extvalide = array("jpg", "png", "jpeg");
        #----------------------------------------------------------------------------------------------
        if (!empty($_FILES["file3"]["name"])) {
            #----------------------------------------------------------------------------------------------
            $file3 = strip_tags($_FILES["file3"]["name"]);
            $extload = strtolower(pathinfo($file3, PATHINFO_EXTENSION));
            $name_file = "photo-" . substr(str_shuffle("123456789012345678901234567890"), 0, 9);
            #----------------------------------------------------------------------------------------------
            if ($_FILES["file3"]["size"] <= $sizemax) {
                #----------------------------------------------------------------------------------------------
                if (in_array($extload, $extvalide)) {
                    #----------------------------------------------------------------------------------------------
                    $chemin = "dossier/" . $name_file . "." . $extload;
                    $resultat = move_uploaded_file($_FILES["file3"]["tmp_name"], $chemin);
                    $file3 = $name_file . "." . $extload;
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
        } else {
            $file3 = null;
        }
        #---------------------------------file4--------------------------------------------------------
        $sizemax = 5097152;
        $extvalide = array("jpg", "png", "jpeg");
        #----------------------------------------------------------------------------------------------
        if (!empty($_FILES["file4"]["name"])) {
            #----------------------------------------------------------------------------------------------
            $file4 = strip_tags($_FILES["file4"]["name"]);
            $extload = strtolower(pathinfo($file4, PATHINFO_EXTENSION));
            $name_file = "photo-" . substr(str_shuffle("123456789012345678901234567890"), 0, 9);
            #----------------------------------------------------------------------------------------------
            if ($_FILES["file4"]["size"] <= $sizemax) {
                #----------------------------------------------------------------------------------------------
                if (in_array($extload, $extvalide)) {
                    #----------------------------------------------------------------------------------------------
                    $chemin = "dossier/" . $name_file . "." . $extload;
                    $resultat = move_uploaded_file($_FILES["file4"]["tmp_name"], $chemin);
                    $file4 = $name_file . "." . $extload;
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
        } else {
            $file4 = null;
        }
        #---------------------------------file5--------------------------------------------------------:
        $sizemax = 5097152;
        $extvalide = array("jpg", "png", "jpeg");
        #----------------------------------------------------------------------------------------------
        if (!empty($_FILES["file5"]["name"])) {
            #----------------------------------------------------------------------------------------------
            $file5 = strip_tags($_FILES["file5"]["name"]);
            $extload = strtolower(pathinfo($file5, PATHINFO_EXTENSION));
            $name_file = "photo-" . substr(str_shuffle("123456789012345678901234567890"), 0, 9);
            #----------------------------------------------------------------------------------------------
            if ($_FILES["file5"]["size"] <= $sizemax) {
                #----------------------------------------------------------------------------------------------
                if (in_array($extload, $extvalide)) {
                    #----------------------------------------------------------------------------------------------
                    $chemin = "dossier/" . $name_file . "." . $extload;
                    $resultat = move_uploaded_file($_FILES["file5"]["tmp_name"], $chemin);
                    $file5 = $name_file . "." . $extload;
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
        } else {
            $file5 = null;
        }
        #-----------------------------------------------------------------------------------------
        if (strlen($nom) <= 20 && strlen($postnom) <= 20 && strlen($prenom) <= 20) {
            if (strlen($email) <= 50 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (strlen($phone) == 10 && is_numeric($phone)) {
                    #----------------------------------------------------------------------------------------- 
                    $req_mail = $connect_db->prepare("SELECT * FROM student WHERE emailStudent=?");
                    $req_mail->execute(array($email));
                    $verify_mail = $req_mail->rowCount();
                    #-----------------------------------------------------------------------------------------
                    $req_phone = $connect_db->prepare("SELECT * FROM student WHERE telephoneStudent=?");
                    $req_phone->execute(array($phone));
                    $verify_phone = $req_phone->rowCount();
                    #-----------------------------------------------------------------------------------------   
                    if ($verify_mail == 0) {
                        if ($verify_phone == 0) {
                            #-----------------------------------------------------------------------------------------
                            if (isset($_SESSION["ADMIN_DATA"])) {
                                #-----------------------------------------------------------------------------------------  
                                $INSERT = $connect_db->prepare("INSERT INTO student(nomStudent,postnomStudent,prenomStudent,emailStudent,telephoneStudent,sexeStudent,etat_civilStudent,nationaliteStudent,date_naissStudent,lieu_naissStudent,adresseStudent,FaculteStundentID,DepartementStudentID,year_acStudent,diplomeGraduat,diplomeLicence,diplomeMaster,diplomeDoctorat,AdminStudentID,datesave) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
                                $INSERT->execute(array($nom, $postnom, $prenom, $email, $phone, $sex, $etat_civil, $nationalite, $datenaisse, $lieunaiss, $adresse, $faculte, $departement, $anneacademique, $file2, $file3, $file4, $file5, $ADMIN["AdminID"]));
                                header("location:add-student");
                                #-----------------------------------------------------------------------------------------
                            } else if (isset($_SESSION["ARCHIVISTE_DATA"])) {
                                #----------------------------------------------------------------------------------------- 
                                $INSERT = $connect_db->prepare("INSERT INTO student(nomStudent,postnomStudent,prenomStudent,emailStudent,telephoneStudent,sexeStudent,etat_civilStudent,nationaliteStudent,date_naissStudent,lieu_naissStudent,adresseStudent,FaculteStundentID,DepartementStudentID,year_acStudent,diplomeGraduat,diplomeLicence,diplomeMaster,diplomeDoctorat,ArchivisteStudentID,datesave) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
                                $INSERT->execute(array($nom, $postnom, $prenom, $email, $phone, $sex, $etat_civil, $nationalite, $datenaisse, $lieunaiss, $adresse, $faculte, $departement, $anneacademique, $file2, $file3, $file4, $file5, $ARCHIVISTE["ArchivisteID"]));
                                header("location:add-student");
                                #----------------------------------------------------------------------------------------- 
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
    <form method="post" enctype="multipart/form-data">
        <?php require("./widgets/header.php") ?>
        <br>
        <div class="container">
            <div class="card p-2">
                <h4 class="p-1">Ajouter etudiant</h4>
            </div>
            <br>
            <?php if (isset($eMsg)) { ?><div class="alert alert-danger"><?= $eMsg ?></div><?php } ?>
            <div class="card p-4">
                <div class="row g-3">
                    <h5>IDENTITE</h5>
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label">Postnom</label>
                        <input type="text" name="postnom" class="form-control" id="inputPassword4">
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" id="inputCity">
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="inputCity">
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Téléphone</label>
                        <input type="number" name="tel" class="form-control" id="inputCity">
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Sexe</label>
                        <select class="form-select" name="sexe" aria-label="Default select example">
                            <option>-- Sexe</option>
                            <option value="1">Homme</option>
                            <option value="2">Femme</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Etat civil</label>
                        <select class="form-select" name="etat_civil" aria-label="Default select example">
                            <option>-- Etat civil</option>
                            <option value="1">Marié(e)</option>
                            <option value="2">Célibataire</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Nationalité</label>
                        <input type="text" name="nationalite" class="form-control" id="inputCity">
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Date de naissance</label>
                        <input type="date" name="datenaisse" class="form-control" id="inputCity">
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Faculte</label>
                        <select class="form-select" name="faculte" aria-label="Default select example">
                            <option>-- faculte</option>
                            <?php while ($faculte = $REQ_faculte->fetch()) { ?>
                                <option value="<?= $faculte["FaculteID"] ?>"><?= $faculte["nom"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Departement</label>
                        <select class="form-select" name="departement" aria-label="Default select example">
                            <option>-- departement</option>
                            <?php while ($departement = $REQ_depaertement->fetch()) { ?>
                                <option value="<?= $departement["DepartementID"] ?>"><?= $departement["nom"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Annee academique</label>
                        <input type="text" name="anneacademique" class="form-control" id="inputCity" placeholder="Ex: 2023-2024">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Lieu de naissance</label>
                        <input type="text" name="lieunaiss" class="form-control" id="inputCity" placeholder="Ville">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Adresse domicile</label>
                        <input type="text" name="adresse" class="form-control" id="inputCity" placeholder="Av/Q/C">
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="container">
            <div class="card p-4">
                <div class="row g-3">
                    <h5>DOSSIER </h5>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Diplôme de Graduat (obligatoire)</label>
                        <input type="file" name="file2" class="form-control" id="inputPassword4">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Diplôme de Licence (facultatif)</label>
                        <input type="file" name="file3" class="form-control" id="inputPassword4">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Diplôme de Master (facultatif)</label>
                        <input type="file" name="file4" class="form-control" id="inputPassword4">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Diplôme de Doctorat (facultatif)</label>
                        <input type="file" name="file5" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-12">
                        <button type="submit" name="register" class="btn btnSearch w-100 ">Ajouter </button>
                    </div>
                </div>
            </div>

            <br>
        </div>
    </form>
</body>

</html>