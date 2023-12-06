<?php
include("database.php");
include("menu.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            background: linear-gradient(to right, #5effa3, #8affd7);
            display: flex;
            color: #fff;
        }

        .f {
            width: 70vh;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        #submit {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        label{
            color: black;
            font-size: large;
        } 
    </style>
<div style="margin: auto; padding: 10px;" class="f">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label class="label" for="id">ID</label><br>
        <input type="text" id="id" name="id" placeholder="123" required><br>

        <label class="label" for="amount_paid">Amount Paid</label><br>
        <input type="text" id="amount_paid" name="amount_paid" placeholder="120000" required><br>

        <input type="submit" id="submit" name="submit" value="Submit">
    </form>
</div>

</body>
</html>
<?php
function payment($id,$amount,$conn):void{
try{
$sql = "UPDATE students SET payment_left = payment_left - $amount WHERE id = $id";
mysqli_query($conn,$sql);
echo "SUCCESSFUL<br>";
}catch(mysqli_sql_exception){
echo "Problem Ocurred!!<br>";
}
}
if(isset($_POST['submit'])){
    if(!empty($_POST['id']) && !empty($_POST['amount_paid'])){
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $amount_paid = mysqli_real_escape_string($conn, $_POST['amount_paid']);
        payment($id,$amount_paid,$conn);
        mysqli_close($conn);
        sleep(2);
        header("Location: main_page.php");
        exit();
    }
}
?>