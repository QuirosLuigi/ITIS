<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['username']) && $_SESSION['role'] == "Inventory")
{
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Stock View</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
<?php @include '../navbar.php' ?>
<div class="stockview">
<h1>Stock View</h1>
    <div class="content">
        <table>
            <tr>
                <th scope="col">Ingredient</th>
                <th scope="col">Quantity</th>
                <th scope="col">Measurement</th>
            </tr>
            <tbody>
            <?php 
                include "connect.php";
                $query = mysqli_query($DBConnect, "SELECT i.ingredientName, i.quantity, u.unitName FROM ingredient i JOIN unit u ON i.unitID=u.unitID");
                while($retrieve = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $retrieve['ingredientName']?></td>
                <td><?= $retrieve['quantity']?></td>
                <td><?= $retrieve['unitName']?></td>
            </tr>
            <?php 
                }
            ?>
            </tbody>
        </table>
    </div>
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