<?php 
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'sarisari';
    $conn;

    function connect(){
        global $host, $user, $pass, $database, $conn;

        $conn = mysqli_connect($host, $user, $pass, $database) or die('Connection Failed!');
    }

    function disconnect(){
        global $conn;

        mysqli_close($conn);
    }

    function getAllProducts($table){
        global $conn;
        $sql = "SELECT * FROM $table";
        connect();
        $query = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
        disconnect();
        return $rows;
    }

    function getAllSales(){
        global $conn;
        $sql = "SELECT sales_id, sales_date, customer_name, products.product_code, products.product_name, products.product_unit, products.product_price, qty, products.product_price * qty AS total FROM sales INNER JOIN products ON products.product_id = sales.product_id";
        connect();
        $query = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
        disconnect();
        return $rows;
    }

    function insertSales($table, $sales_date, $customer_name, $product_id, $qty){
        global $conn;
        $sql = "INSERT INTO $table(sales_date, customer_name, product_id, qty) VALUES('$sales_date', '$customer_name', '$product_id', '$qty')";
        connect();
        mysqli_query($conn, $sql);
        disconnect();
    }

    function updateSales($table, $sales_id, $sales_date, $customer_name, $product_id, $qty){
        global $conn;
        $sql = "UPDATE $table SET sales_date = '$sales_date', customer_name = '$customer_name', product_id = '$product_id', qty = '$qty' WHERE sales_id = '$sales_id'";
        connect();
        mysqli_query($conn, $sql);
        disconnect();
    }

    function deleteSales($table, $sales_id){
        global $conn;
        $sql = "DELETE FROM $table WHERE sales_id = $sales_id";
        connect();
        mysqli_query($conn, $sql);
        disconnect();
    }

    function getSalesById($table, $sales_id){
        global $conn;
        $sql = "SELECT * FROM $table WHERE sales_id = $sales_id";
        connect();
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        disconnect();
        return $row;
    }
?>