<?php
    // Configure connection settings
    $db = '5inarch';
    $db_admin = 'root';
    $db_password = 'root';
    $con = mysqli_connect("localhost", "$db_admin", "$db_password", "$db");

    // show arabic result
    $arabicsql= 'SET CHARACTER SET utf8';
    mysqli_query($con,$arabicsql);
?>