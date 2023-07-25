<?php
    session_start();
    include '../connect.php';
    if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'Chef') header("Location: ../Chef/addDish.php");
        if ($_SESSION['role'] === 'Cashier') header("Location: ../Cashier/cashier.php");
        if ($_SESSION['role'] === 'Inventory') header("Location: ../Controller/viewstock.php");
        else if ($_SESSION['role'] === 'Admin') {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Approve Manual Count</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php @include 'navbar.php' ?>
    <div class="approvedishcss">
        <h2>Approve Manual Count</h2>
        <table class="reporttable">
            <th>Ingredient</th>
            <th>System Count</th>
            <th>Manual Count</th>
            <th>Measurement</th>
            <th>Date Created</th>
            <th>Created By</th>
            <th>Action</th>
            <?php 
                include '../connect.php';
                $selectQuery = mysqli_query($DBConnect, "   SELECT d.logID, i.ingredientID, i.ingredientName, d.sQuantity, d.mQuantity, u.unitName, d.createdAt, d.createdBy 
                                                            FROM disparity d 
                                                            JOIN ingredient i ON d.ingredientID = i.ingredientID 
                                                            JOIN unit u ON u.unitID = i.unitID
                                                            WHERE d.approved IS NULL
                                                            ORDER BY d.createdAt DESC");
                while($disparity = mysqli_fetch_array($selectQuery)) {
            ?>
                <tr>
                    <td><?= $disparity['ingredientName']?></td>
                    <td><?= $disparity['sQuantity']?></td>
                    <td><?= $disparity['mQuantity']?></td>
                    <td><?= $disparity['unitName']?></td>
                    <td><?= $disparity['createdAt']?></td>
                    <?php
                        $name = mysqli_fetch_array(mysqli_query($DBConnect, "SELECT CONCAT(firstName , ' ', lastName) AS name FROM user WHERE employeeID = " . $disparity['createdBy'] . ";"));
                    ?>
                    <td><?= $name['name']?></td>
                    <td>
                        <form method="POST" action="approvedDisparity.php">
                            <input type="hidden" name="ingredientID" value="<?= $disparity['ingredientID']; ?>"/>
                            <input type="hidden" name="logID" value="<?= $disparity['logID']; ?>"/>
                            <button type="submit" name="approve" class="approve">Approve</button>
                            <button name="deny" value="deny" class="deny">Deny</button>
                        </form>
                    </td>
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
</body>
</html>
<?php
        }
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>