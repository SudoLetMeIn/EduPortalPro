<?php
include("database.php");
session_start();
$_SESSION['permission'] = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            background: linear-gradient(to right, #3494e6, #ec6ead);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            width: 300px;
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
</head>
<body>

    <header>
        <img src="ant.jpg" alt="Your Logo" height="150">
    </header>

    <form action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="post">
        <label class="label" for="username">Username:</label>
        <input type="text" id="username" name="user" required>

        <label class="label" for="password">Password:</label>
        <input type="password" id="password" name="pass" required>

        <input type="submit" id="submit" name="submit" value="LOG IN">
    </form>

</body>
</html>


<?php
function verify($user,$pass,$conn): bool{
    try{
    $sql = "SELECT * FROM users Where name='$user' and pass='$pass'";
    $result = mysqli_query($conn, $sql);
    }catch(mysqli_sql_exception){
        return false;
    }
    if($result){
        if(mysqli_num_rows($result) > 0){ 
        return true;
        }
    }
    return false;
}
function alter_date($user,$pass,$conn){
    try{
    $currentTimestamp = date('Y-m-d H:i:s');
    $sql = "UPDATE Users SET last_login='$currentTimestamp' WHERE name='$user'";
    mysqli_query($conn,$sql);
    }catch(mysqli_sql_exception){
        echo "could not change the last_login";
    }
}
if(isset($_POST['submit'])){
    $verified = false;
    if(!empty($_POST['user']) && !empty($_POST['pass'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $user = mysqli_real_escape_string($conn, $user);
        $pass = mysqli_real_escape_string($conn, $pass);
        $user = filter_var($user,FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_var($pass,FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if(verify($user,$pass,$conn)){
        $verified = true;
    }
    if ($verified){
        echo "Logged in<br>";
        alter_date($user,$pass,$conn);
        $_SESSION["user"]=$user;
        $_SESSION["pass"]=$pass;
        $user = "";
        $pass = "";
        mysqli_close($conn);
        $_SESSION["time"]=$_SERVER["REQUEST_TIME"];
        $_SESSION['permission'] = true;
        header("Location: Optimize.php");
        exit();
    }
    
}
?>