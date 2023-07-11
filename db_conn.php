<?php


    $dbname = "localhost";
    $dbuser = "root";
    $dbpassword = "";

    $db_title = "ITISDEV";

    $conn = mysqli_connect($dbname,$dbuser,$dbpassword,$db_title);


    if(!$conn){
        
        echo "Connection Failed";
    }