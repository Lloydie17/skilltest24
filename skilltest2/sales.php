<?php 
    include('dbhelper.php');
    $row = array();

    $rows = getAllSales();

    $sales_id = isset($_GET['sales_id']) ? $_GET['sales_id'] : null;
    $sales_data = null;

    if($sales_id) {
        $sales_data = getSalesById('sales', $sales_id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge, safari">
    <title>SALES</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="w3-container w3-bar w3-padding w3-red">
        <h3 style="font-weight: bold">SALES</h3>
        <div class="w3-container w3-right">
            <a href="index.php" class="w3-button w3-hover-white" style="font-weight: 600">HOME</a>
            <a href="sales.php" class="w3-button w3-hover-white" style="font-weight: 600">SALES</a>
        </div>
    </div>
    
    <?php include('alert.php') ?>

    <div class="w3-row-padding w3-margin-top">
        <div class="w3-third">
            <div class="w3-card-4 w3-padding w3-container w3-round-xlarge">
                <form action="addsales.php" method="POST">
                    <?php if ($sales_id): ?>
                        <input type="hidden" name="sales_id" value="<?php echo $sales_id; ?>">
                    <?php endif; ?>
                    <p>
                        <label><b>SALES DATE</b></label>
                        <input type="text" name="sales_date" value='<?php echo $sales_data ? $sales_data['sales_date'] : date('Y/m/d');?>' class="w3-padding w3-input w3-border">
                    </p>
                    <p>
                        <label><b>CUSTOMER NAME</b></label>
                        <input type="text" name="customer_name" value='<?php echo $sales_data ? $sales_data['customer_name'] : '';?>' placeholder="** CUSTOMER NAME **" class="w3-input w3-border">
                    </p>
                    <p>
                        <label><b>PRODUCT CODE</b></label>
                        <select name="product_id" class="w3-select w3-border">
                            <?php 
                                $products = getAllProducts('products');
                                foreach($products as $prod){
                                    $selected = ($sales_data && $sales_data['product_id'] == $prod['product_id']) ? 'selected' : '';
                                    echo "<option value='".$prod['product_id']."' $selected>";
                                        echo strtoupper($prod['product_name'])."----->".number_format($prod['product_price'],2);
                                    echo "</option>";
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label><b>QTY</b></label>
                        <input type="number" step="0.01" min="0" name="qty" value='<?php echo $sales_data ? $sales_data['qty'] : '';?>' class="w3-input w3-border">
                    </p>
                    <p>
                        <?php
                            if($sales_id) {
                                echo "<input type='submit' name='EDIT' value='EDIT' class='w3-button w3-green'>";
                            } else {
                                echo "<input type='submit' value='SAVE' class='w3-button w3-blue'>";
                            }
                        ?>
                        
                        <input type="reset" value='CANCEL' class="w3-button w3-red">
                    </p>
                </form>
            </div>
        </div>
        <div class="w3-twothird">
            <?php 
                $subtotal = 0.0;
                echo "<table class='w3-table-all w3-card-4'>";
                    echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>DATE</th>";
                        echo "<th>CUSTOMER</th>";
                        echo "<th class='w3-hide-medium w3-hide-large'>PRODUCT CODE</th>";
                        echo "<th class='w3-hide-medium w3-hide-small'>PRODUCT NAME</th>";
                        echo "<th class='w3-hide-medium w3-hide-small'>PRODUCT UNIT</th>";
                        echo "<th>PRICE</th>";
                        echo "<th>QTY</th>";
                        echo "<th>TOTAL</th>";
                    echo "</tr>";
                    foreach($rows as $row){
                        echo "<tr>";
                            echo "<td>".$row['sales_id']."</td>";
                            echo "<td>".$row['sales_date']."</td>";
                            echo "<td>".strtoupper($row['customer_name'])."</td>";
                            echo "<td class='w3-hide-medium w3-hide-large'>".strtoupper($row['product_code'])."</td>";
                            echo "<td class='w3-hide-medium w3-hide-small'>".$row['product_name']."</td>";
                            echo "<td class='w3-hide-medium w3-hide-small'>".$row['product_unit']."</td>";
                            echo "<td>".number_format($row['product_price'],2)."</td>";
                            echo "<td>".$row['qty']."</td>";
                            echo "<td>".number_format($row['total'],2)."</td>";
                            echo "<td>";
                            echo "<a href='sales.php?sales_id=".$row['sales_id']."' class='w3-button w3-round w3-green'>Edit</a>";
                            echo "</td>";
                            echo "<td>";
                                echo "<a href='deletesales.php?sales_id=".$row['sales_id']."' class='w3-button w3-round w3-red'>&times;</a>";
                            echo "</td>";
                        echo "</tr>";
                        $subtotal += $row['total'];
                    }
                echo "</table>";
                echo "<div class='w3-container w3-padding w3-margin-top w3-right'>";
                    echo "<b>SUBTOTAL --> ";
                        echo number_format($subtotal, 2);
                    echo "</b>";
                echo "</div>";
            ?>
        </div>
    </div>
</body>
</html>
