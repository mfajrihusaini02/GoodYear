<?php
  $host = 'localhost';
  $db_user = 'postgres';
  $db_pass = 'tvu443xx22';
  $port = '5432';
  $db_name = 'db-goodyear';

  // $db = new PDO("pgsql:dbname=$db_name;host=$host", $db_user, $db_pass);
  $db = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_pass port=$port");

  if($db) {
    echo '';
  } else {
    echo 'FAILED';
  }
?>