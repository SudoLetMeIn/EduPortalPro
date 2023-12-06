<?php
include("database.php");
session_start();
if($_SESSION["permission"] == false){
    sleep(2);
    header("Location: Login.php");
    exit();
}
function timeout(){
    $time = $_SERVER["REQUEST_TIME"];
    $s_time = $_SESSION["time"];
    $interval = intval($time) - intval($s_time);
    if($interval > 1800){
        return true;
    }
    return false;
    }
    if(timeout()){
    echo "Time Out<br>";
    $_SESSION["permission"] = false;
    sleep(1);
    header("Location: Login.php");
    exit();
    }
if($_SESSION["permission"] == false){
    sleep(2);
    header("Location: Login.php");
    exit();
}

?>