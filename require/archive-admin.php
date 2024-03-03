<?php

if (isset($ADMIN)) {
  $REQ_ARCHIVISTES = $connect_db->query("SELECT * FROM archiviste");
  $COUNT_ARCHIVISTES = $REQ_ARCHIVISTES->rowCount();
  echo $COUNT_ARCHIVISTES;
}