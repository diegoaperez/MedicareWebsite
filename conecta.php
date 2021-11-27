<?php
    $db_password = "ZjiPPmCMDAmyTEZd";

// print_r($_GET);

// exit();

    $db_username = "medicare_costs";
    $db_hostname = "localhost";
    $db_database = "medicare_costs";

    try
    {
        $dbconnection = mysqli_connect($db_hostname, $db_username, $db_password,$db_database) or $error=1;
    }
    catch(Exception $ex)
    {
        die("No pude conectar a la base de datos: " . $ex->getMessage());
    }

     mysqli_set_charset($dbconnection,"utf8");
?>
