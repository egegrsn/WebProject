<?php

            //  session_set_cookie_params(0);  
     session_start() ;
         require_once 'db.php';     
            
  // check if already login
    if ( !empty($_SESSION["user"])) {
        header("Location: index.php");
        exit ;
    } 
    
        if( isset($_COOKIE["autologin"])) {
        $autologinID =  $_COOKIE["autologin"] ;
        $sql = "select * from user where autologin = ?" ;
        $stmt = $db->prepare($sql) ;
        $stmt->execute([$autologinID]) ;
        if ( $stmt->rowCount() == 1) {
            $_SESSION["user"] = $user ;
            header("Location: main.php") ;
            exit ;
        } else {
            setcookie("autologin", "", 1) ;
        }
    }
    
    
    if ( isset($_POST["Login"])) {
    
      extract($_POST) ;
      $sql = "select * from user where email = ?" ;
      $stmt = $db->prepare($sql);
      $stmt->execute([$email]) ;
      
      
      if ( $stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
      //  var_dump($user) ;
        if ($password == $user["password"]) {

            echo "Authenticated" ;
            
            if ( isset($remember)) {
                
                setcookie("autologin", time() + 60*60*24) ;
                $stmt2 = $db->prepare("update user set autologin = 1 where email = ?") ;
                $stmt2->execute([$user["email"]]) ;
            }
            $_SESSION["user"] = $user;
            header("Location: index.php") ;
            exit ;
            
        } else {
           // echo "Authentication Failed" ;
           $login_error = true ;
        }
      } else {
          $login_error = true ;
      }
      
  } 
  ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Member Login 
        </title>
        <style>

            table {
                margin: 0 auto;
                margin-top: 10px;
                background-color: lightgray;   
                border: solid 1px #000;
                border-width: 0 1px 1px 0;
                border-spacing: 0;
                text-align: center;
            }

            td {
                border: solid 1px #000;
                border-width: 1px 0 0 1px;
                padding:10px;
            }

            .logocolor{
                background-color:#333 ;
            }
            tr:nth-child(2){
                background-color: #94ce22;
            }
            
            .lgn{
                background:#94ce22;
                padding:8px 50px;
            }
            
            footer{
                text-align: center;
                padding-top: 50px;
            }

            footer a{
                border-radius: 10px;
                border:1px solid black;
                color:black;
                background: #cccccc;    
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;

            }
            footer a:hover {
                background-color: #ddd;
                color: #94ce22;
                width: 1000px;
            }   
        </style>
    </head>
    <body>
        <form action="" method="post"> 
            <table>

                <tr class="logocolor">
                        <td colspan="2"> <img src="images/WebSiteLogo.png"  width="120" alt=""/></td>
                </tr>
                <tr>
                    <td colspan="2">Member Login</td>
                </tr>
                <tr>
                    <td>
                        E-Mail
                    </td>
                    <td>
                        <input type="text" name="email" id="uname" placeholder="Enter your username...">
                    </td>
                </tr>
                <tr>
                    <td>
                        Password
                    </td>
                    <td>
                        <input type="password" name="password" id="pw" placeholder="Enter your password...">
                    </td>
                </tr>
                <tr>
                    <td>Remember Me:</td>
                    <td><input type="checkbox" name="remember"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="Login" value="Login" class="lgn" name="loginBtn">
                    </td>
                </tr>
                
                  <tr >
                    <td colspan="2"><p class="center" color="red"><?= isset($login_error) ? "Login Error" : "" ; ?></p></td>
                </tr>

            </table>

        </form>
        <footer><a href="index.php">Go Back To Main Page</a></footer>
    </body>
</html>
