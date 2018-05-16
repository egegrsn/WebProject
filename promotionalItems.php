<?php
    session_start();

    
    if(empty($_SESSION["user"]))
    {
        header("Location: index.php");
    }
    else
    {
        if($_SESSION["user"]["type"]!="1")
        {
            header("Location: index.php");
        }
    }
    
    ?>
<html>
    <head>
        <meta charset="UTF-8">
        
        <style>
            #addDiv { text-align: center;}
            .product {  border-collapse: collapse; margin: 10px auto; }
            .product td, th { border: 1px solid black; 
                         padding: 5px; text-align: center; width: 100px; }
            .product tr:first-of-type { background: #AFA;}
            .product a { color: red; text-decoration: none; }
            .icon { width: 24px; height: 24px; }

        </style>
    <title></title>
</head>
<body>
    <?php
     require_once 'db.php'; 
        try {
          echo '<table class="product">';
          echo "<tr>" ;
          echo '<td>Product</td><td>Promotional</td><td>Add/Remove</td></tr>' ;
          
          $sql = "select * from product";
          $stmt = $db->query($sql) ;
          if ( $stmt->rowCount() > 0) {
          foreach ( $stmt as $item) {
             echo '<tr>' ;
             echo '<td>' . $item['title'] . '</td>' ;
             echo '<td>' . $item['promotion'] . '</td>' ;
             if($item['promotion']!=1)
             {
                  echo "<td><a href='AddPromotion.php?id={$item['id']}'>Add Promotional</a></td>" ;
             }
             else
             {
                 echo "<td><a href='RemovePromotion.php?id={$item['id']}'>Remove Promotional</a></td>" ;
             }
            
          
             echo '</tr>' ;
          } 
              echo "<td colspan=3><a href='index.php'>Back to Main</a></td>" ;
          } else {
              echo '<tr><td colspan=3>No records yet.</td></tr>' ;
          }
          echo '</table>' ;
          } catch( Exception $ex) {
              echo '<p>Query error ' . $ex->getMessage() . '</p>' ;
          }
    ?>
</body>
</html>
