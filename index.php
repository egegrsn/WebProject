<?php
session_start();
$admin = false;
if (empty($_SESSION["user"])) {
    $welcome = "Welcome Guest";
    $log = "Login";
} else {
    $log = "Logout";
    $welcome = "Welcome " . $_SESSION["user"]["fullname"];
    if ($_SESSION["user"]["type"] == "1") {
        $admin = true;
    }
}
?>
<html lang="en">
    <head>
        <title>At Sepete!</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="jquery-3.1.1.js" type="text/javascript"></script>
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans" rel="stylesheet">
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
                padding:0px 0px;
                border: solid 1px gray;
                padding:10px 10px;
            }

            .column{
                float: left;
                width: 50.00%;
                background: white;
            }


            /* Style the footer */
            .footer {
                clear:both;
                background-color: #f1f1f1;
                padding: 10px;
                font-size: 10px;

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

        <div class="top"> 

            <img src="images/WebSiteLogo.png" width="120" alt=""/>

            <input type="submit" class="src" value="Search" />
            <input type="text" class="src" placeholder="Search..">
            <img src="images/WebSiteLogo.png" class="imggg" width="40" alt=""/>
            <a href="register.php"><?= $log == "Login" ? "Create Account" : "" ?></a>
            <a href="<?= strtolower($log).'.php';?>"   >  <?= $log;?>  </a>

            <ul id="nav">
                <li><a href="#">Product Categories</a>
                    <ul>    
                        <?php
                        require_once 'db.php';
                        try {
                            $list = $db->query("select distinct category from product")->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($list as $row) {
                                echo "<li><a href='category.php?category={$row['category']}'>{$row['category']}</a></li>";
                            }
                        } catch (Exception $ex) {
                            echo "<p>DB Error : " . $ex->getMessage() . " </p>";
                        }
                        ?>
                    </ul>
                </li>
            </ul>

        </div>

        <div class="mid1">
            <h2><b>Dövizden etkilenmeyen site!</b></h2>
            <?php
            echo "<h3><b>" . $welcome . "</b></h3>";

            if ($admin == true) {
                echo " <a href='addProducts.php'>Add Product</a>";
                echo " <a href='promotionalItems.php'>Promotional Items</a>";
            }
            ?>
        </div>


        <div class="sliderDiv">
            <p>This week's special products.</p>
            <?php
            require_once 'db.php';
            try {
                $list = $db->query("select distinct category,id,picture from product where promotion=1")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($list as $row) {
                    echo "<a href='product.php?id={$row['id']}'><img class='mySlides' src='images/{$row['picture']}'></a>";
                }
            } catch (Exception $ex) {
                echo "<p>DB Error : " . $ex->getMessage() . " </p>";
            }
            ?>

            <div class = "miniDiv">
                <table>
                    <tr>
                        <?php
                        $i = 1;
                        require_once 'db.php';
                        try {
                            $list = $db->query("select * from product  where promotion=1")->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($list as $row) {
                                echo"<td><img class = 'miniSlides' src = 'images/{$row['picture']}' onclick = 'showDivs($i)'>";
                                echo "</td>";
                                $i++;
                            }
                        } catch (Exception $ex) {
                            echo "<p>DB Error : " . $ex->getMessage() . " </p>";
                        }
                        ?>

                    </tr>
                </table>
            </div>
        </div>

        <div class="mid1">
            <p>Ne duruyorsun, AT SEPETE!!!</p>
        </div>

        <div class = "productDiv">
           
                <?php
                require_once 'db.php';
                try {
                    $list = $db->query("select * from product")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($list as $row) {
                        echo "<div class='column'>";
                        echo "<table>";
                        echo "<tr>";
                        echo "<td colspan=2><a href='product.php?id={$row['id']}'><img class='profile' src='images/{$row['picture']}'></a></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class='description'>{$row['title']}</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class='description'>{$row['price']}TL</td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</div>";
                    }
                } catch (Exception $ex) {
                    echo "<p>DB Error : " . $ex->getMessage() . " </p>";
                }
                ?>
  
        </div>

        <div class="footer">
            <p>Atsepete.com Tüm hakları saklıdır.2018</p>
        </div>

        <script>
            var slideIndex = 1;
            showDivs(slideIndex);

            function showDivs(n) {
                slideIndex = n;
                var i;
                var x = document.getElementsByClassName("mySlides");
                if (n > x.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = x.length
                }
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                x[slideIndex - 1].style.display = "block";

            }


            $(document).ready(function () {
                $('#nav > li').each(function () {
                    var t = null;
                    var li = $(this);
                    li.hover(function () {
                        t = setTimeout(function () {
                            li.find("ul").slideDown(300);
                            t = null;
                        }, 300);
                    }, function () {
                        if (t) {
                            clearTimeout(t);
                            t = null;
                        } else
                            li.find("ul").slideUp(200);
                    });
                });
            });
        </script>
    </body>
</html>
