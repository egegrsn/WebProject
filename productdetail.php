<!DOCTYPE html>
<?php
  require_once './db.php';
  $id = $_GET["id"] ;
  $stmt = $db->prepare("select * from product where id=?");
  $stmt->execute([$id]);
  $product = $stmt->fetch() ;  
  
?>
<html>
    <head>
        <meta charset="UTF-8">
        
    <title>
        
    </title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans" rel="stylesheet">
    <style>
        a{
             padding-top: 30px;
             text-decoration: none;
             color: white;
        }
        table{
            margin:0 auto;      
            width: 1000px;
            background-color: white;
           
        }
        .productimg{
            width: 100%;          
        }
         
        body{
                background: url(images/bg.png);
    font-family: 'Merriweather Sans', sans-serif;
            }
            
            .gomain{
                background-color: green;
                border-radius: 10px;
            }
        .addtocart img
        {
           border-radius:  15px;
           width: 16%;
           background-color: lightgray; 
        }
        .radius{
            background-color: gray;
            color: white;
            border-radius: 10px;
            width: 80%;
            
        }
        
    </style>
</head>
<body>
    
    
    <table>
    <tr><td align='center'><h1 class='radius'><?=$product['title'];?></h1></td></tr>
    </table>
     <table>
    <tr><td rowspan=5 align='center'><img src='images/<?=$product['picture'];?>' class='productimg'></td></tr>   
    <tr><td align='center'><h3>Properties: <?=$product['properties'];?></h3></td></tr>
    <tr><td align='center'><h3><?=$product['price'];?> TL</h3></td></tr>
    <tr><th align='center'><h3>Amount Left: <?=$product['amount'];?></h3></th></tr>
    <tr><td align='center' class='addtocart'><a href='index.php'><img src='images/Add_to_Cart-512.png'</td></tr>
    </table>
   
    <table> 
    <tr><td align='center'><h2 class='radius'>Comments and Ratings</h2></td></tr>
    </table>
    
    <table> 
    <tr><td align='center'><h2 class='radius'>Comments and Ratings</h2></td></tr>
    </table>
    
    <a href='index.php'><table> 
    <tr><td align='center' class='gomain'>Go Back To Main Menu</td></tr>
    </table> 
    
      
    
    
</body>
</html>
