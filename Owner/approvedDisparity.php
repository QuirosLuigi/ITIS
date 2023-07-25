<?php
    session_start();
    include '../connect.php';
        if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'Chef') header("Location: ../Chef/viewRecipe.php");
        if ($_SESSION['role'] === 'Cashier') header("Location: ../Cashier/cashier.php");
        if ($_SESSION['role'] === 'Inventory') header("Location: ../Controller/viewstock.php");
        else if ($_SESSION['role'] === 'Admin') {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {  
                include '../connect.php';
                $ingredientID = $_POST['ingredientID'];
                $logID = $_POST['logID'];

                
                if(isset($_POST['approve'])) {
                    mysqli_query($DBConnect, "UPDATE ingredient SET quantity = (SELECT mQuantity FROM disparity WHERE logID = $logID) WHERE ingredientID = '$ingredientID';");
                    $updateQuery = mysqli_query($DBConnect, "UPDATE disparity SET approved = 'Yes' WHERE logID = $logID;");
                    echo '<script>window.location.href = "approvedisparity.php";</script>';
                }
                if(isset($_POST['deny'])) {
                    mysqli_query($DBConnect, "UPDATE disparity SET approved = 'No' WHERE logID = $logID;");
                    echo '<script>window.location.href = "approvedisparity.php";</script>';
                }
            }
            else {
                header("Location: notification.php");
                exit();
            }
        }
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>