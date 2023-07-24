<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['username']) && $_SESSION['role'] == "Owner")
{
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
<?php @include '../navbar.php' ?>
<div class="reportview">
    <h2> Dish Details </h2>
    <div style="width: 50%">
        <?php 
            include "connect.php";
            $nDishID = $_POST['nDishID'];
            $selectDishQuery = mysqli_query($DBConnect, "   SELECT nDishID, dishName, dateCreated, approved, img 
                                                            FROM pending_dish
                                                            WHERE nDishID = '$nDishID'");
            $pendingDish = mysqli_fetch_array($selectDishQuery);
        ?>
        <!-- dish image -->
        <img src="<?= $pendingDish['img'] ?>" alt="<?= $pendingDish['img'] ?>" style="width:100%; border-radius:10px" />
    </div>
    <!-- ingridient list  -->
    <h3>Ingredients</h3>
    <ul>
        <?php 
            $selectRecipeQuery = mysqli_query($DBConnect, " SELECT i.ingredientName, pr.quantity, u.unitName 
                                                            FROM pending_recipe pr 	JOIN ingredient i	ON i.ingredientID=pr.ingredientID
                                                                                    JOIN unit u			ON i.unitID=u.unitID
                                                            WHERE pr.nDishID = $nDishID;"); 
            while ($pendingRecipe = mysqli_fetch_array($selectRecipeQuery)) echo "<li>" . $pendingRecipe['ingredientName'] . "</li>";
        ?>
    </ul>
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