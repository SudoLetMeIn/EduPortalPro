<?php
include("Permission.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Menu Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            font-weight: bolder;
        }

        #menu {
            height: 100vh;
            /* width: 200px; */
            background: #333;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #content {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        a {
            color: #fff;
            text-decoration: none;
            margin: 10px 0;
            font-size: 90%;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        a:hover {
            background: #555;
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }
    </style>
</head>
<body>

    <div id="menu">
        <a href="main_page.php">
            <img src="no_background_ant.png" width="70vw" alt="logo">
        </a>
        <a href="Add_user.php">Хэрэлэгч бүртгэх</a>
        <a href="Add_student.php">Сурагч бүртгэх</a>
        <a href="Payment.php">Төлбөр</a>
        <a href="Search.php">Хайх</a>
        <a href="Tables.php">Хүснэгт</a>
        <a href="Logout.php">Гарах</a>
    </div>
    <script>
        var menu = document.getElementById("menu");
        let str = 20000/screen.width;
        menu.style.width = str+"%";
        </script>
</body>
</html>
