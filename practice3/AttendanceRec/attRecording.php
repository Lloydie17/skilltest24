<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Recording</title>
    <style>
        table, th, td {
            border: 1px solid;
            border-collapse: collapse;
            margin-left: 35%;
            text-align: center;
            padding: 10px;
        }
        .menu, form {
            margin-left: 35%;
        }
    </style>
</head>
<body>
    <div class="menu">
        <h2>Attendance Recording</h2>
        <a href="/practice3/index.php">Back To Menu</a>
        <br><br>
    </div>
    <div>
        <form method="post">
            <label>Date Time In</label>
            <input type="datetime-local" name="datetimeIn">
            <label>Date Time Out</label>
            <input type="datetime-local" name="datetimeOut">
            <input type="submit" name="datefilter" value="Filter by date">
        </form>
        <br>
        <form method="post">
            <label>Search</label>
            <input type="text" name="search" placeholder="Enter Details">
            <button type="submit">Search</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Record #</th>
                    <th>Emp ID</th>
                    <th>Date/Time In</th>
                    <th>Date/Time Out</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $connection = new mysqli("localhost", "root", "", "attendance");

                    if ($connection->connect_error) {
                        die("CONNECTION FAILED: " . $connection->connect_error);
                    }

                    $search = "";

                    $sql = "SELECT * FROM Departments";

                    if (isset($_POST['datefilter']) && !empty($_POST['datetimeIn']) && !empty($_POST['datetimeOut']))
                    {
                        $dateIn = $connection->real_escape_string($_POST['datetimeIn']);
                        $dateOut = $connection->real_escape_string($_POST['datetimeOut']);
                        $sql .= (strpos($sql, "WHERE") === false ? " WHERE" : " AND") . " attTimeIn BETWEEN '$dateIn' AND '$dateOut'";
                    }

                    if (isset($_POST['search']))
                    {
                        $search = $connection->real_escape_string($_POST['search']);
                        $sql .= " WHERE attRn LIKE '%$search%'";
                    }

                    $result = $connection->query($sql);

                    if (!$result) {
                        die("INVALID QUERY: " . $connection->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['attRn']}</td>
                            <td>{$row['empID']}</td>
                            <td>{$row['attTimeIn']}</td>
                            <td>{$row['attTimeOut']}</td>
                            <td>{$row['total']}</td>
                        </tr>";
                    }

                    $connection->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
