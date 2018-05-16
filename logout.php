<?php

require_once 'db.php' ;

session_start() ;
   if (empty($_SESSION["user"])) {
      header("Location: index.php") ;
      exit ;
   }


$cookie_session_name = session_name() ;
setcookie( $cookie_session_name, "", 1 , '/') ;


// Autologin 
setcookie("autologin", "", 1) ; // delete auto login.
$stmt = $db->prepare("update user set autologin = 0 where email = ?") ;
$stmt->execute([$_SESSION["user"]["email"]]) ;


session_destroy();

header("Location: index.php");