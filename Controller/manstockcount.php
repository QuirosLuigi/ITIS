<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['username']) && $_SESSION['role'] == "Inventory")
{
    ?>
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Manual Count</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <!-- <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script> -->
    <style>
        /* Style the pop-up form */
        .popup-form {
            /* display: none; */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            padding: 20px;
            background-color: #000000;
            border: 1px solid #ccc;
            border-radius: 4px;
            z-index: 9999;
        }
  </style>
</head>
<body>
    <?php 
        @include '../navbar.php';
        if (isset($_POST['ingredientName']) && isset($_POST['unitType'])) {
            $ingredient = $_POST['ingredientName'];
            $unitType   = $_POST['unitType'];

            $unitQuery = (mysqli_query($DBConnect, "SELECT unitName, unitID FROM unit WHERE type = '$unitType';"));

            if (!empty($ingredient) && !empty($unitType)) {
    ?>
                <script>
                    function manualCount() {
                        var tempContainer = document.createElement("div");
                        tempContainer.innerHTML =
                            '<div id="popupForm" class="popup-form">'                                                       +
                            '<form action="manualCount.php" method="POST">'                                                 +
                            '<p><?=$ingredient?></p>'                                                                       +
                            '<input type="hidden" name="ingredient" value="<?php echo $ingredient; ?>" />'                  +
                            '<label for="unit">Unit:</label>'                                                               +
                            '<select name="unit" id="unit">'                                                                +
                            <?php while($unit = mysqli_fetch_array($unitQuery)) { ?>
                                '<option value="<?php echo $unit['unitID'] ?>"><?php echo $unit['unitName'] ?></option>'    +
                            <?php } ?>
                            '</select><br />'                                                                               +
                            '<label for="qty">Quantity: </label>'                                                           +
                            '<input type="text" name="qty" />'                                                              +
                            '<br />'                                                                                        +
                            '<button style="color: black;" type="submit">Confirm</button>'                                  +
                            '<button><a href="manstockcount.php" style="color: black;">Cancel</a></button>'                 +
                            '</form>'                                                                                       +
                            '</div>'                                                                                        ;
                        // Get the body element
                        var body = document.body;

                        // Append the new element just before the </body> tag
                        body.insertBefore(tempContainer.firstChild, body.lastChild);
                    }
                    manualCount();
                </script>
    <?php
            }
        }
    ?>


    <div class="stockview">
    <h1>Stock View</h1>
        <div class="content">
            <table>
                <tr>
                    <th scope="col">Ingredient</th>
                    <th scope="col">Manual</th>
                </tr>
                <tbody>
                <?php 
                    include "connect.php";
                    $query = mysqli_query($DBConnect, "SELECT i.ingredientName, u.type FROM ingredient i JOIN unit u ON i.unitID=u.unitID");
                    while($retrieve = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?= $retrieve['ingredientName']?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="ingredientName" value="<?= $retrieve['ingredientName'] ?>" />
                            <input type="hidden" name="unitType" value="<?= $retrieve['type'] ?>" />
                            <button type="Submit" id="openPopupButton" name="stocksubmit" class="inputbutton"  style="color: black;">Input Manual Count</button>
                        </form>
                    </td>
                </tr>
                <?php 
                    }
                ?>
                </tbody>
            </table>
        </div>
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