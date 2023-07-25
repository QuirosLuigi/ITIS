<?php
    session_start();
    include '../connect.php';
    if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'Chef') header("Location: ../Chef/viewRecipe.php");
        if ($_SESSION['role'] === 'Cashier') header("Location: ../Cashier/cashier.php");
        if ($_SESSION['role'] === 'Inventory') header("Location: ../Controller/viewstock.php");
        else if ($_SESSION['role'] === 'Admin') {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'navbar.php' ?>
    <main>
        <div class="notifications">
            <h2>Notifications</h2>
            <ul>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
                <li>Tomato Sauce Out of Stock</li>
            </ul>
        </div>
    </main>
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