<?php
include("database.php");
function execute($conn,$query):void{
    try{
        mysqli_query($conn,$query);
    }catch(mysqli_sql_exception){}
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $query) {
        execute($conn,$query);
    }
    unlink("uploads/input.xlsx");
}
?>
