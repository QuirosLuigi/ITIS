<!DOCTYPE html>
<html>
<head>
    <title>Stock Purchased Page</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
<?php @include 'navbar.php' ?>
<div class="stockpurchcard">
    <h2>Input Stock Purchased</h2>
    <form action="addIngredient.php" method="POST">
        <ul>
            <li>
                <label>Ingredient:</label>
                <input type="text" name="ingredientName" class="inputarea" placeholder="Input Ingredient">
            </li>
            <li>
                <label>Quantity:</label>
                <input type="text" name="qty" class="inputarea">
            </li>
            <li>
                <label>Unit:</label>
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
        </ul>
        <input type="Submit" name="stocksubmit"  class="inputbutton" value="Submit Restock"><br>
    </form>
</div>
</body>
</html>