<?php 
include("database.php");
function getArr_($conn):array{
    try{
        $sql = "SELECT * FROM `students`";
        $result = mysqli_query($conn,$sql);
        $arr = array();
        foreach($result as $r){
            array_push($arr,$r);
        }
        return $arr;
    }catch(mysqli_sql_exception){
        return array();
    }
}
function daysBetweenDates($date1, $date2) {
    $timestamp1 = strtotime($date1);
    $timestamp2 = strtotime($date2);

    $seconds_per_day = 60 * 60 * 24;

    $difference = abs($timestamp2 - $timestamp1);

    $days = floor($difference / $seconds_per_day);

    return $days;
}
function Expired($initial,$today,$total_months):bool{
$interval = daysBetweenDates($initial,$today);
if($interval / $total_months >= 30){
    return true;
}
return false;
}
function Extend_Period($id,$conn){
    try{
        $sql = "UPDATE students SET payment_left = payment_left + monthly_pay , total_months = total_months + 1 WHERE id = $id";
        mysqli_query($conn,$sql);
        echo "Succesful<br>";
    }catch(mysqli_sql_exception){
        echo "Query problem detected!!<br>";
    }
}
$arr = getArr_($conn);
$today = date('Y-m-d');
foreach($arr as $a){
    if(Expired($a['enrolled_date'],$today,$a['total_months'])){
        Extend_Period($a['id'],$conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
header("Location: main_page.php");
exit();
?>