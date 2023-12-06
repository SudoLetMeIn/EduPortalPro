<?php
include("database.php");
include("menu.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            background: linear-gradient(to right, #ffa36c, #ffdb7d);
            display: flex;
            color: #fff;
        }
        .container {
        position: relative;
        height: 100vh;
        margin: auto; 
        }
        

        .welcome-container {
            text-align: center;
            border-radius: 10px;
            padding: 30px;
            left: 200px;
        }

        h1 {
            color: #fff;
            margin-bottom: 20px;
        }

        p {
            color: #fff;
            font-size: 16px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container" >
    <div class="welcome-container" style="margin: auto; padding: 10px">
        <h1>Welcome to Teachers' Portal</h1>
        <p>Explore the features and services we offer. And make your teaching experience better</p>
    </div>
</div>
</body>
</html>
