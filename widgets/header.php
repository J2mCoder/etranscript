<header class="navbar navbar-expand-md" data-bsb-sticky-target="#header">
  <div class="container">
    <a class="navbar fs-3 fw-bold" href="home.php">
      ETRANSCRIPT
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#bsbNavbar"
      aria-controls="bsbNavbar" aria-label="Toggle Navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="bsbNavbar">
      <ul class="navbar-nav m-auto ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link navlink" href="home.php">
            <i class="fa-solid fa-house fs-5"></i>
            <span>Accueil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link navlink" href="list-notification.php">
            <i class="fa-solid fa-bell fs-5"></i>
            <span>Notification</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link navlink" href="./archive.php">
            <i class="fa-solid fa-box-archive fs-5"></i>
            <span>Archives</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav justify-content-md-center align-items-center">
        <li class="nav-item float-end">
          <a class="nav-link d-flex gap-3" href="profil.php">
            <p class="fs-5 fw-bold text-wrap m-auto ">
              <span><?php
              if (isset($ADMIN)) {
                echo $ADMIN["prenomAdmin"];
              } elseif (isset($ARCHIVISTE)) {
                echo $ARCHIVISTE['prenomArchi'];
              }
              ?></span>
              <br>
              <span class="d-none d-md-block">
                <?php
              if (isset($ADMIN)) {
                echo $ADMIN["nomAdmin"];
              } elseif (isset($ARCHIVISTE)) {
                echo $ARCHIVISTE['nomArchi'];
              }
              ?>
              </span>
            </p>
            <img style="object-fit:cover" src="<?php 
            if (isset($ADMIN) && $ADMIN["profilAdmin"] != NULL) { 
              echo './profil/' . $ADMIN["profilAdmin"];
            } elseif (isset($ARCHIVISTE) && $ARCHIVISTE["profilArchi"] != NULL) {
              echo './profil/' . $ARCHIVISTE["profilArchi"];
            } else {
              echo './asset/default.png';
            } 
            ?>" alt="" width="45" height="45" class="rounded-circle mt-2">
          </a>
        </li>
      </ul>
    </div>
  </div>
</header>