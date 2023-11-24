<?php 
$id = $_POST["id"];
    deleteSP($conn, $id);
    $path = $_SERVER["SCRIPT_NAME"];
    if (isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] != "") {
        $path = $path . "?" . $_SERVER["QUERY_STRING"];
    }
    header("Refresh:0,url='$path'"); 
?>