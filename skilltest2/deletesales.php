<?php 
    session_start();
    include('dbhelper.php');
    
    if(isset($_GET['sales_id'])){
        $sales_id = $_GET['sales_id'];
        $ok = deleteSales('sales', $sales_id);

        $_SESSION['alert'] = ($ok != 1) ? "Sales Transaction Deleted" : "Error Deleting Sales";

        header('location:sales.php');
        exit();
    }
?>