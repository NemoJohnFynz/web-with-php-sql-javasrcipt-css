<?php
session_start();
if(isset($_SESSION["username"])){
    echo  $_SESSION["username"];
}
else{
    echo "user";
    $path = $_SERVER["SCRIPT_NAME"];
    if (isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] != "") {
        $path = $path . "?" . $_SERVER["QUERY_STRING"];
    }
    $path = strstr($path, "/admin", true);
    $path = $path . "/login/container_login_register.php";
    //echo $path;
    header("Refresh:0,url='$path'");
}
?>