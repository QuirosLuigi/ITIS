<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../Owner/style.css">
</head>
<body>
<?php
@include "navbar.php";
include "../connect.php";
$query = mysqli_query($DBConnect, "SELECT * FROM dish WHERE active = 'Yes' ");
$count = 1;
echo'<div class="recipe">';
echo'<h2>View Recipe</h2>';

while ($retrieve = mysqli_fetch_assoc($query)) {
    $dishID         = $retrieve['dishID'];
    $dishName       = $retrieve['dishName'];
    $dateCreated    = $retrieve['dateCreated'];
    $price          = $retrieve['price'];
    $dishImg        = $retrieve['img'];
	
	
	if ($count%3==1||$count==1){
        echo "<div class = 'row'>";
    }
	
    echo "<div class='column'><h3>$dishName</h3>";  
    echo "<form action='recipe.php' method='POST'>";
    echo "<img src='$dishImg'  class='dish-image' id='myBtn$dishID' onclick='this.parentNode.submit();'>";
    echo "<input type='hidden' name='dishID' value='$dishID'>";
    echo "</form>";
	echo "</div>";
	$count++;
	if ($count%3==1){
        echo "</div>";
    }
}
echo "</tr>";
echo "</div>";
?>
</body>
</html>