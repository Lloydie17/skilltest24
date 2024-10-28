<?php
    session_start();
    include('dbhelper.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sales_id = isset($_POST['sales_id']) ? $_POST['sales_id'] : null;
        $sales_date = $_POST['sales_date'];
        $customer_name = $_POST['customer_name'];
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];
        
        if(!empty($customer_name) && $qty > 0){
            if($sales_id) {
                $ok = updateSales('sales', $sales_id, $sales_date, $customer_name, $product_id, $qty);
                $_SESSION['alert'] = (!$ok) ? "Sales Updated" : "Error Updating Sales"; 
            } else {
                $ok = insertSales('sales', $sales_date, $customer_name, $product_id, $qty);
                $_SESSION['alert'] = (!$ok) ? "New Sales Added" : "Error Adding Sales"; 
            }
        } else {
            if(empty($customer_name)) {
                $_SESSION['alert'] = "Customer Name is required!";
            } elseif($qty <= 0) {
                $_SESSION['alert'] = "Quantity must be greater than zero";
            }
        }

        header('location:sales.php');
        exit();
    }
?>