<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../Owner/style.css">
</head>
<body>

<?php @include 'navbar.php' ?>
<div class="recipedetails">
<?php
include "../connect.php";

if (isset($_POST['dishID'])) {
    $dishIDs = $_POST['dishID'];
    $mamamoblue = mysqli_query($DBConnect, "SELECT * FROM dish WHERE dishID = $dishIDs");
    $chupain = mysqli_fetch_assoc($mamamoblue);
    $dishName = $chupain['dishName'];
    $dateCreated =  $chupain['dateCreated'];
    $price =    $chupain['price'];
    $dishImg =    $chupain['img'];
    ?>
    <div class="dishcontent">
        <?php
    echo "<h2>Recipe Details</h2>";
    echo" <hr style='height:1px;color:black;background-color:black'>";
    echo "<tr><td><img src='$dishImg' class='dish-image'></td>";
    echo "<tr><td><h3>$dishName</h3></td>";     
    echo "<tr><td>Date Created: $dateCreated</td></tr><br />";
    echo "<tr><td>Price: $price</td></tr>";
    echo "</div>";
    // Convert the dishIDs string into an array
    $dishIDArray = explode(",", $dishIDs);

    // Fetch the recipe details for the specified dishIDs
    $query = mysqli_query($DBConnect, "SELECT * FROM recipe WHERE dishID IN (".implode(",", $dishIDArray).")");

    // Display the recipe details
   
    echo "<table>";
    echo "<tr><td>Ingredient:</td><td>Quantity: </td><td>Unit: </td></tr>";
    while ($retrieve = mysqli_fetch_assoc($query)) {
        $ingredientID = $retrieve['ingredientID'];
        $quantity = $retrieve['quantity'];
        
        // Fetch the ingredient details
        $ingredientQuery = mysqli_query($DBConnect, "SELECT * FROM ingredient WHERE ingredientID = $ingredientID");
        $ingredient = mysqli_fetch_assoc($ingredientQuery);
        $ingredientName = $ingredient['ingredientName'];
        $unitID = $ingredient['unitID'];
        $unitQuery = mysqli_query($DBConnect, "SELECT * FROM unit WHERE unitID = $unitID");
        $unitg = mysqli_fetch_assoc($unitQuery);
        $unitname = $unitg['unitName'];
        echo "<tr><td>$ingredientName</td><td>$quantity</td><td>$unitname</td></tr>";
    }
    echo "</table>";
} else {
    echo "No dish ID specified.";
}

?>
<div class="dishcontent">
<br/><a  href="chefhome.php"><button class="sbt_btn">Back</button> </a>
</div>
</div>
</body>
</html>
