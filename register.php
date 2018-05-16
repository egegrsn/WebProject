<?php
// This part inserts a new record. 
  if ( isset($_POST['Register'])) {
      require_once './db.php';
      // 1. get form data
      extract($_POST) ; 
      // 3. Process/Save data.
          
     try{
         $sql = 'select * from user where email = :email';
         $stmt = $db->prepare($sql);
         $stmt->execute(['email' => $email]);
     } catch (Exception $ex) {

     }
     
     if ($stmt->rowCount() < 1)
     {
               try {
      $sql1 = "insert into user (fullname, password, email, cargoaddress, type) values (?, ?, ?, ?, ?)" ;
      $stmt1 = $db->prepare($sql1) ;
      $res = $stmt1->execute(array($name, $password, $email, $cargo, "0")) ;
      
         } catch( Exception $ex) {
          print "<p>DB Error " . $ex->getMessage() . "</p>" ;
          $error = true ;
         }
     }
     else
     {
         $login_error = true ;
     }
    
  }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
                    <td colspan="2"> <img src="images/WebSiteLogo.png" id="logo" width="200" alt=""/></td>
                </tr>
                <tr>
                    <td colspan="2">Register now for free!</td>
                </tr>
                <tr>
                    <td>Your Full Name:</td>
                    <td><input type="text" name="name" id="uname" placeholder="Enter your full name..."></td>
                </tr>
                <tr>
                    <td>Your Email Address:</td>
                    <td> <input type="text" name="email" id="pw" placeholder="Enter your email address..."></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" id="pw" placeholder="Enter your password..."></td>
                </tr>
                <tr>
                    <td>Cargo Address:</td>
                    <td>
                        <textarea id="cargo" name="cargo" placeholder="Enter your cargo address..." style="height:100px"></textarea>
                    </td>
                </tr>
                <tr>
                <td colspan="2">
                    <input type="submit" value="Register" name="Register">
                    
                </td>
                </tr>
                <tr>
                    <td colspan="2"><p class="center" style="color:red"><?= isset($login_error) ? "Login Error" : "" ; ?></p></td>
                </tr>
                
            </table>

        </form>
        <footer><a href="index.php">Go Back To Main Page</a></footer>
    </body>
</html>
