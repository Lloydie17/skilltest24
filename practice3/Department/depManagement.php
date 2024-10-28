<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
    <style>
        table, th, td 
        {
            border: 1px solid;
            border-collapse: collapse;
            margin-left: 35%;
            text-align: center;
            padding: 10px;
        }
        .menu , form
        {
            margin-left: 35%;
        }

    </style>
</head>
<body>
    <div class="menu">
    <h2>Department Management</h2>
        <a href="/practice3/Department/addDep.php">Add a Department Here</a> &nbsp | &nbsp
        <a href="/practice3/index.php">Back To Menu</a>
        <br><br>
    </div>
    <div>
        <form method="post">
            <label>Accountings</label>
            <input type="checkbox" name="depName[]" value="accountings">
            <label>IT</label>
            <input type="checkbox" name="depName[]" value="it">
            <input type="submit" name="filter" value="Filter">
        </form><br>
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Head</th>
                    <th>Tel No.</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $connection = new mysqli("localhost","root","","practice3");

                    if ($connection->connect_error)
                    {
                        die ("CONNECTION FAILED". $connection->connect_error);
                    }

                    $sql = "SELECT * FROM Departments";

                    if (isset($_POST['filter']) && !empty($_POST['depName']))
                    {
                        $depNames = $_POST['depName'];
                        $depNames_list = implode("','" , $depNames);
                        $sql .= " WHERE depName IN ('$depNames_list')";
                    }

                    $result = $connection->query($sql);

                    if (!$result)
                    {
                        die ("INVALID QUERY" . $connection->connect_error);
                    }

                    while ($row = $result->fetch_assoc())
                    {
                        echo 
                        "
                        <tr>
                        <td>$row[depCode]</td>
                        <td>$row[depName]</td>
                        <td>$row[depHead]</td>
                        <td>$row[depTelNo]</td>
                        <td>
                            <a href='/practice3/Department/editDep.php?depCode=$row[depCode]'>Edit</a>
                            <a href='/practice3/Department/delDep.php?depCode=$row[depCode]'>Del</a>
                        </td>
                    </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>