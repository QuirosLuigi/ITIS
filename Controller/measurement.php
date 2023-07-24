<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['username']) && $_SESSION['role'] == "Inventory")
{
    ?>
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Measurement</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <!-- <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script> -->
</head>
<body>
    <?php @include "../navbar.php" ?>
    <div class="stockpurchcard">
        <h2>Add Measurement Unit</h2>
        <h4>Instructions: Conversion specifies the quantity of the system unit in relation to one new unit.</h4>
        <form action="addUnit.php" method="POST">
            <ul>
                <li>
                    <label>New Unit: </label>
                    <input type="text" name="unitName" class="inputarea" placeholder="Input Unit Name" required />
                </li>
                <li>
                <label>Convert to:</label>
                    <select name="unit" style="color: black;">
                        <option value="" disabled selected hidden></option>
                        <?php
                            $DBConnect = mysqli_connect("127.0.0.1:4306", "root", "") or die ("Unable to Connect". mysqli_error());
                            $db = mysqli_select_db($DBConnect, 'itisdev');

                            $query = mysqli_query($DBConnect, "SELECT unitID, unitName FROM unit;");

                            foreach ($query as $unit) {
                                echo '<option value="' . $unit['unitID'] . '" style="color: black;">' . $unit['unitName'] . '</option>';
                            }
                        ?>
                    </select>
                </li>
                <li>
                    <label>Conversion: </label>
                    <input type="text" name="conversion" class="inputarea" required />
                </li>
            </ul>
            <input type="Submit" name="unitSubmit" class="inputbutton" value="Submit New Unit" />
        </form>
    </div>
</body>
</html>
<?php
}

else{
    header("Location: ../logout.php");
    exit();
}
?>