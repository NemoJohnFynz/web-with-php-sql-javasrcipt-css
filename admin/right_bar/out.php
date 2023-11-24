
<?php

if (isset($_POST["out"]) and $_SESSION["out"]>0) {
    $a=$_SESSION["out"];
    header("Refresh:0,url='$a'");
}
else if(isset($_POST["out"])) {
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