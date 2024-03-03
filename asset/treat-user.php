<?php

if(isset($_SESSION["ADMIN_DATA"])){
    $REQ_ADMIN = $connect_db->prepare("SELECT * FROM admin WHERE AdminID=?");
    $REQ_ADMIN->execute([$_SESSION["ADMIN_DATA"]]);
    $ADMIN = $REQ_ADMIN->fetch();
    
}else{
    header("location:login");
} 

?>