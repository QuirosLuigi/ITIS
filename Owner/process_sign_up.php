<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['username']) && $_SESSION['role'] == "Owner")
{
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        @include 'connect.php';
    
        if ($_POST['password'] == $_POST['confirmpassword']) {
            

            $passer="INSERT INTO user (username, password, firstName, lastName, role, hireDate)"
            ." VALUES ('{$_POST['username']}', '{$_POST['password']}', '{$_POST['firstName']}', '{$_POST['lastName']}', '{$_POST['role']}', NOW())";

            // Perform query
            $query = mysqli_query($DBConnect, $passer);
            
        } else {
            echo "Incorrect Password! Try Again";
        }  
    ?>
</body>
</html>
<?php
}

else{
    header("Location: ../logout.php");
    exit();
}
?>