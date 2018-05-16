<?php

  require_once 'db.php';
  
  $id = $_GET["id"] ;
  
  $sql = "update product set promotion = 0 where id = ? " ;
  $stmt = $db->prepare($sql) ;
  $stmt->execute([$id]) ;
  
  header("Location: promotionalItems.php");
