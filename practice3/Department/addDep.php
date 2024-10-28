<?php
$connection = new mysqli("localhost","root","","practice3");

$depCode = "";
$depName = "";
$depHead = "";
$depTelNo = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $depCode = $_POST['depCode'];
    $depName = $_POST['depName'];
    $depHead = $_POST['depHead'];
    $depTelNo = $_POST['depTelNo'];

    do 
    {
        if (empty($depCode) || empty($depName) || empty($depHead) || empty($depTelNo) )
        {
            $errorMessage = "All Fields Are Required";
            break;
        }

        $sql = "INSERT INTO Departments(depCode,depName,depHead,depTelNo)".
                "Values('$depCode','$depName','$depHead','$depTelNo')";
        $result = $connection->query($sql);

        if (!$result)
        {
            $errorMessage = "Error". $successMessage;
            break;
        }

        $depCode = "";
        $depName = "";
        $depHead = "";
        $depTelNo = "";

        $successMessage = "Department Added Successfully";

    }
    while(false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Deparment</title>
    <style>
        h4, .form1 
        {
            text-align: center;
        }
    </style>
</head>
<body>
    <div>
        <h4>Add Deparment</h4>
        <?php 
            if(!empty($errorMessage))
            {
                echo "<div style='text-align: center; color:red'>$errorMessage</div>";
            }
            if(!empty($successMessage))
            {
                echo "<div style='text-align: center; color:green'>$successMessage</div>";
            }
        ?>
        <form method="post" class="form1">
            <label>Code</label>
            <input type="text" name="depCode" value="<?php echo"$depCode"?>">
            <br><br>
            <label>Name</label>
            <input type="text" name="depName" value="<?php echo"$depName"?>">
            <br><br>
            <label>Head</label>
            <input type="text" name="depHead" value="<?php echo"$depHead"?>">
            <br><br>
            <label>TelNo</label>
            <input type="text" name="depTelNo" value="<?php echo"$depTelNo"?>">
            <br><br>
            <button type="submit">Submit</button> &nbsp | &nbsp
            <a href="/practice3/Department/depManagement.php">Back</a>
        </form>        
    </div>
</body>
</html>