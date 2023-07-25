<?php
     $DBConnect = mysqli_connect("127.0.0.1:4306", "root", "") or die ("Unable to Connect". mysqli_error());
     $db = mysqli_select_db($DBConnect, 'itisdev');
?>