<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['username']) && $_SESSION['role'] == "Owner")
{
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Generate Reports</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
<?php @include '../navbar.php' ?>
<div class="reportview">
<h1>Inventory/Stock Report</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Start Date: <input class="txdate" type="date"  name="date1" value="<?php if(!isset($_POST['date1'])){ echo date('Y-m-d');} else{ echo $_POST['date1']; } ?>" required >
    End Date: <input class="txdate" type="date" name="date2" value="<?php if(!isset($_POST['date2'])){ echo date('Y-m-d');} else{ echo $_POST['date2']; } ?>" required >
    <input type="submit" class="sbt_btn" value="Generate Report">
</form>
<?php 
    include 'report_module_backend.php';
?>
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