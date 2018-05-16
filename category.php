<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .demo {cursor:pointer}

            * {
                box-sizing: border-box;
                font-family: 'Merriweather Sans', sans-serif;


            }
            body{
                background: url(images/bg.png);

            }

            div {
                width: 75%;
                margin:0px auto;
                background-color: white;
            }


            /* Style the search bar*/
            .src {
                margin:10px 10px;
                float: right;
                width: 100px;
            }

            /* Style the search button*/

            .imggg{float:right;}


            /* Style the top navigation bar */
            .top {
                overflow: hidden;
                background-color:indigo;
                font-size: 14px;
            }

            /* Style the top links */
            .top a {
                float: right;
                display: block;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            /* Change color on hover */
            .top a:hover {
                background-color: #ddd;
                color: black;
            }       

            /* Style the mid */
            .mid1{
                background-color: #94ce22;
                padding: 10px;
                font-size:18px;
            }

            .sliderDiv {
                padding: 10px 10px;
                font-size:22px;
                text-align: center; 
            }    
            .mySlides{margin:0px auto; max-width: 40%;}
            .miniDiv{width: 50%;}
            .miniSlides:hover{opacity:1.0;}
            .miniSlides{ width: 50%; opacity:0.5;}
            td{text-align: center; width: 20%;font-size: 14px;}

            .description{
                background:#cccccc;

            }


            /* Products Div */

            .profile{width:15%;}

            .productDiv table { 
                border: solid 1px #000;
                padding:0px 0px;
                border-collapse: collapse;
                margin:0px auto;         
            }

            .productDiv td {    
                padding:10px 10px;
                border: solid 1px gray;
                
            }  

            .column{
                float: left;
                width: 50.00%;
                background: white;
            }


            /* Style the footer */
            .footer {
                background-color: #f1f1f1;
                padding: 10px;
                font-size: 10px;
                text-align: center;
                clear:both;
            }
            .footer a{
                color:red;
                font-size: 12px;
            }


            #nav,
            #nav ul {
                list-style: none;
                margin-top: 4px;
            }
            #nav {
                float: right;
            }

            #nav li a{
                display: block;
                padding:10px;
                min-width:80px;
                text-decoration: none;
            }
            #nav ul {
                position: absolute;
                margin:38px 0px;
                padding:0px;
                display:none; 

            }
            #nav ul li a {
                width: 150px;
                background-color: indigo;
            }


        </style>
    </head>
    <body>
        <?php
        require_once 'db.php';
        $category = $_GET["category"];
        ?>

        <div class="top"> 

            <img src="images/WebSiteLogo.png" width="120" alt=""/>

            <input type="submit" class="src" value="Search" />
            <input type="text" class="src" placeholder="Search..">
            <img src="images/WebSiteLogo.png" class="imggg" width="40" alt=""/>
            <a href="register.php">Create Account</a>
            <a href="login.php">Login</a>

        </div>
        <div class="mid1">
            <h2><b>Dövizden etkilenmeyen site!</b></h2>
        </div>

        <div class = "productDiv">

            <?php
            try {
                $stmt = $db->prepare("select * from product where category= ?");
                $stmt->execute([$category]);
                $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($product as $row) {
                    echo "<div class='column'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<td><a href='detail.php?id={$row['id']}'><img class='profile' src='images/{$row['picture']}'></a></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>{$row['title']}</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>{$row['price']}TL</td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
                }
            } catch (Exception $ex) {
                echo "<p>DB Error : " . $ex->getMessage() . " </p>";
            }
            ?>
        </div>
        <div class="footer"><a href="index.php">Go Back To Main Page</a><p>Atsepete.com Tüm hakları saklıdır.2018</p></div>
    </body>
</html>
