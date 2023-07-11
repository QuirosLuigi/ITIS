<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    ?>

    <!DOCTYPE html>
<html>
    <head>
        <title>Detailed Reports</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php @include '../navbar.php' ?>
    <div class="reportview">
        
    <?php 
        include 'detailed_report_backend.php';
    ?>
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