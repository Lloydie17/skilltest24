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
        .menu 
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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dept.</th>
                    <th>LastName</th>
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