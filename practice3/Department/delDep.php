<?php

    if ($_GET['depCode'])
    {
        $depCode = $_GET['depCode'];

        $connection = new mysqli("localhost","root","","practice3");

        $sql = "DELETE FROM Departments WHERE depCode=$depCode";
        $connection->query($sql);

        header("location: /practice3/Department/depManagement.php");
    }

?>