<?php
include("database.php");
include("menu.php");
function write($r,$id):void{
    echo "<script>
    function showPopup() {
        var overlay = document.createElement('div');
        overlay.className = 'overlay';
        document.body.appendChild(overlay);

        var popup = document.createElement('div');
        popup.className = 'popup';
        popup.innerHTML = '<p><strong>$r</strong> $id</p><button onclick=\"closePopup()\">Close</button>';
        document.body.appendChild(popup);
    }

    function closePopup() {
        var overlay = document.querySelector('.overlay');
        var popup = document.querySelector('.popup');
        overlay.parentNode.removeChild(overlay);
        popup.parentNode.removeChild(popup);
    }

    window.onload = showPopup;
  </script>";

echo "<style>
    body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        font-size: 90%;
        font-weight: bolder;
        color: #000;
        text-align: center;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border-radius: 10px;
        background: linear-gradient(45deg, #3498db, #2ecc71);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        color: #000;
    }

    .popup p {
        padding: 20px;
        margin: 0;
        color: #fff;
    }

    .popup button {
        cursor: pointer;
        padding: 10px;
        border: none;
        background: #fff;
        color: #3498db;
        border-radius: 5px;
    }
  </style>";
}
function check_for_spaces($entry):bool{
for($i = 0;$i < strlen($entry);$i++){
    if($entry[$i] == ' '){
        return false;
    }
}
return true;
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
<style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            background: linear-gradient(to right, #5f6fff, #c1c8ff);
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
        <label class="label" for="name1">Username</label><br>
        <input type="text" id="name1" name="user1" placeholder="User_1" minlength="8" maxlength="20" required><br>

        <label class="label" for="name2">Retype Username</label><br>
        <input type="text" id="name2" name="user2" placeholder="User_1" minlength="8" maxlength="20" required><br>

        <label class="label" for="pass1">Password</label><br>
        <input type="password" id="pass1" name="pass1" placeholder="ABCDEF_!@#$%" minlength="8" maxlength="32" required><br>

        <label class="label" for="pass2">Retype Password</label><br>
        <input type="password" id="pass2" name="pass2" placeholder="ABCDEF_!@#$%" minlength="8" maxlength="32" required><br>

        <input type="submit" id="submit" name="submit" value="Submit">
    </form>
</div>

</body>
</html>


<?php
function add_user($user,$pass,$conn){
    try{
    $sql="INSERT INTO users (name, pass)
            VALUES ('$user', '$pass')";
    mysqli_query($conn,$sql);
    write("Successfully created new user","");
    }catch(mysqli_sql_exception){
        write( "Unable to Register","<br>Reason: Unknown");
    }
}
if(isset($_POST['submit'])){
    if(!empty($_POST['user1']) && !empty($_POST['user2']) && !empty($_POST['pass1']) && !empty($_POST['pass2'])){
        if($_POST['user1'] == $_POST['user2'] && $_POST['pass1'] == $_POST['pass2']){
            $user = $_POST['user1'];
            $pass = $_POST['pass1'];
            if(!check_for_spaces($user)){
                write("Not valid username","");
            }
            elseif(!check_for_spaces($pass)){
                write("Not valid password","");
            }
            else{
            $user = mysqli_real_escape_string($conn, $user);
            $pass = mysqli_real_escape_string($conn, $pass);
            $user = filter_var($user,FILTER_SANITIZE_SPECIAL_CHARS);
            $pass = filter_var($pass,FILTER_SANITIZE_SPECIAL_CHARS);
            if(strlen($user)>=8 && strlen($user)<=20){
            add_user($user,$pass,$conn);
            }else{
        write("Unable to Register","<br>Reason: The username requirements don't meet.");
            }
            mysqli_close($conn);
        }

        }
    }
}

?>