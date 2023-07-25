<?php
    session_start();
    include '../connect.php';
    if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'Chef') header("Location: ../Chef/viewRecipe.php");
        if ($_SESSION['role'] === 'Cashier') header("Location: ../Cashier/cashier.php");
        else if ($_SESSION['role'] === 'Inventory' || $_SESSION['role'] === 'Admin') {
            if ($_SERVER["REQUEST_METHOD"] === "POST") { 
                include '../connect.php';;
                $ingredientName = $_POST['ingredient'];
                $qty            = $_POST['qty'];
                $unit           = $_POST['unit'];
                $id             = $_SESSION['id'];

                $ingredientID = mysqli_fetch_array(mysqli_query($DBConnect, "SELECT ingredientID FROM ingredient WHERE ingredientName = '$ingredientName';"))[0];
                $defaultUnit = mysqli_fetch_array(mysqli_query($DBConnect, "SELECT unitID FROM unit WHERE type IN (SELECT type FROM unit WHERE unitID = $unit) AND conversion = 1;"));
                $conversion = mysqli_fetch_array(mysqli_query($DBConnect, "SELECT conversion FROM unit WHERE unitID = $unit;"))[0];

                $newQty = round(floatval($qty) * floatval($conversion), 2);

                $insertQuery = mysqli_query($DBConnect, "   INSERT INTO disparity(ingredientID, sQuantity, mQuantity, createdAt, createdBy) VALUES (
                                                            $ingredientID, 
                                                            (SELECT quantity 
                                                            FROM ingredient 
                                                            WHERE ingredientID = $ingredientID), 
                                                            $newQty, 
                                                            NOW(), 
                                                            $id);");
                
                header("Location: manstockcount.php");
                exit;
            }
            else {
                header("Location: viewstock.php");
                exit();
            }
        }
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>