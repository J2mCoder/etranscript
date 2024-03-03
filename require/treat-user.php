<?php

if(isset($_SESSION["ADMIN_DATA"])){
    $REQ_ADMIN = $connect_db->prepare("SELECT * FROM admin WHERE AdminID=?");
    $REQ_ADMIN->execute([$_SESSION["ADMIN_DATA"]]);
    $ADMIN = $REQ_ADMIN->fetch();
}else if(isset($_SESSION["ARCHIVISTE_DATA"])){
    $REQ_ARCHIVISTE = $connect_db->prepare("SELECT * FROM archiviste WHERE ArchivisteID=?");
    $REQ_ARCHIVISTE->execute([$_SESSION["ARCHIVISTE_DATA"]]);
    $ARCHIVISTE = $REQ_ARCHIVISTE->fetch();

} else{
    header("location:login");
}