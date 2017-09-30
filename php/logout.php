<?php

session_start(); //to ensure you are using same session
require 'connection.php';

session_destroy(); //destroy the session
header("Location: ../login.php"); //to redirect back to "index.php" after logging out
exit();
?>
