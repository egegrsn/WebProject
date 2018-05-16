<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
    <style>
    table{
            margin: 0 auto;
             border-collapse: collapse;
              margin-top: 10px;
              background-color: lightgray;
              border: 1px solid #333;
        }
        td{
            text-align: center;
            border-bottom: 1px solid #333;
          padding: 10px;
  
/*          #f2f2f2*/
        }
        tr{
            margin-top: 10px;
            
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
        </style>
</head>
<body>
     <form action="" method="post">
    <table>       
        <tr class="logocolor">
            <td colspan="2"> <img src="resimler/WebSiteLogo.png" id="logo" width="120" alt=""/></td>
        </tr>
        <tr>
            <td colspan="2">Add Product(Administration)</td>
        </tr>
        <tr>
            <td>
                Category
            </td>
            <td>
                 <input type="text" id="uname" placeholder="Enter category">
            </td>
        </tr>
        <tr>
            <td>
               Brand
            </td>
            <td>
                <input type="text" id="pw" placeholder="Enter brand">
            </td>
        </tr>
        <tr>
            <td>
               Title
            </td>
            <td>
                <input type="password" id="pw" placeholder="Enter title">
            </td>
        </tr>
        <tr>
            <td>
               Price
            </td>
            <td>
                <input type="text" id="pw" placeholder="Enter price">
            </td>
        </tr>
            <td colspan="2">
             <input type="submit" value="Login" name="loginBtn">
            </td>
        </tr>
    </table>
        
   </form>
    <footer><a href="index.php">Go Back To Main Page</a></footer>
</body>
</html>
