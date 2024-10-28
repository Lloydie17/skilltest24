<?php 
    include('dbhelper.php');
    $row = array();

    $rows = getAllProducts('products');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge, safari">
    <title>PRODUCTS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="w3-container w3-bar w3-padding w3-red">
        <h3 style="font-weight: bold">PRODUCTS</h3>
        <div class="w3-container w3-right">
            <a href="index.php" class="w3-button w3-hover-white" style="font-weight: 600">HOME</a>
            <a href="sales.php" class="w3-button w3-hover-white" style="font-weight: 600">SALES</a>
        </div>
    </div>
    <div class="w3-container w3-padding w3-margin">
        <table class="w3-table-all">
            <tr>
                <th>ID</th>
                <th>CODE</th>
                <th>NAME</th>
                <th>PRICE</th>
                <th>UNIT</th>
            </tr>
            <?php 
                foreach($rows as $row){
                    echo "<tr>";
                        echo "<td>".$row['product_id']."</td>";
                        echo "<td>".$row['product_code']."</td>";
                        echo "<td>".$row['product_name']."</td>";
                        echo "<td>".$row['product_price']."</td>";
                        echo "<td>".$row['product_unit']."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>