<?php
session_start();
require("./require/connect_db.php");
require("./require/treat-user.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php require('./widgets/head.php'); ?>

<body>
  <?php require("./widgets/header.php") ?>
  <br>
  <section>
    <div class="container">
      <div class="card p-4">
        <form class="row g-3" method="post">
          <h2>Ajouter archiviste</h2>
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Nom</label>
            <input type="email" class="form-control" id="inputEmail4" required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Postnom</label>
            <input type="password" class="form-control" id="inputPassword4" required>
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">Prenom</label>
            <input type="text" class="form-control" id="inputCity" required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Photo</label>
            <input type="file" class="form-control" id="inputPassword4">
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">Telephone</label>
            <input type="text" class="form-control" id="inputCity" required>
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">Email</label>
            <input type="text" class="form-control" id="inputCity" required>
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">sexe</label>
            <input type="text" class="form-control" id="inputCity" required>
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">Mot de passe</label>
            <input type="text" class="form-control" id="inputCity" required>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btnAdd w-25 btn-primary">Ajouter</button>
          </div>
        </form>

      </div>
    </div>
  </section>
  <br>
  <?php require('widgets/footer.php'); ?>
</body>

</html>