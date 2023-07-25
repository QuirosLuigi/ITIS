<?php
    session_start();
    include '../connect.php';
    if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'Chef') header("Location: ../Chef/viewRecipe.php");
        if ($_SESSION['role'] === 'Cashier') header("Location: ../Cashier/cashier.php");
        else if ($_SESSION['role'] === 'Inventory' || $_SESSION['role'] === 'Admin') {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Expired Stock</title>
    <link rel="stylesheet" type="text/css" href="../Owner/style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
<?php @include 'navbar.php' ?>
<div class="stockpurchcard">
    <h2>Input Expired Stock</h2>
    <form action="expiredIngredient.php" method="POST">
        <ul>
            <li>
                <label>Ingredient:</label>
                <input type="text" name="ingredientName" class="inputarea" placeholder="Input Ingredient">
            </li>
            <li>
                <label>Quantity: </label>
                <input type="number" name="qty" class="inputarea" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </li>
            <li>
                <label>Unit:</label>
                <select name="unit" style="color: black;">
                    <option value="" disabled selected hidden></option>
                    <?php
                        $query = mysqli_query($DBConnect, "SELECT unitID, unitName FROM unit;");
                        foreach ($query as $unit) {
                            echo '<option value="' . $unit['unitID'] . '" style="color: black;">' . $unit['unitName'] . '</option>';
                        }
                    ?>
                </select>
            </li>
            <li>
                <label>Package:</label>
                <input type="number" name="multiplier" class="inputarea" value="1" required />
            </li>
        </ul>
        <input type="Submit" name="stocksubmit"  class="inputbutton" value="Submit Expired"><br>
    </form>
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
