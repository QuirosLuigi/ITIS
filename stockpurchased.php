<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    ?>

    <!DOCTYPE html>
    
    <html>
    <head>
        <title>Stock Purchased Page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php @include 'navbar.php' ?>
    <div class="stockpurchcard">
        <h2>Input Stock Purchased</h2>
        <ul>
            <li>
                <label>Ingredient:</label>
                <input type="text" name="username" list="ingredients" class="inputarea">
                <datalist id="ingredients">
                <option value="Meatballs">
                <option value="Spaghetti">
                <option value="Tomato Sauce">
                <option value="Salt">
                <option value="Pepper">
                <option value="Orange">
                </datalist>
            </li>
            <li>
            <label>Quantity: </label>
            <input type="number" name="Quantity" class="inputarea" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </li>
            <li>
            <label>Expiry Date:</label>
            <input type="date" name="date"  class="inputarea">
            </li>
        </ul>
        <input type="Submit" name="stocksubmit"  class="inputbutton" value="Submit Restock"><br>
    </div>
    </body>
    </html>

<?php
}

else{
    header("Location: index.php");
    exit();
}
?>