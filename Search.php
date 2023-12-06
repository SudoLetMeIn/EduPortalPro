<?php
include("database.php");
include("menu.php");
function displayTablePopup($header, $data): void {
    echo '<style>
            body {
                margin: 0;
                font-family: "Arial", sans-serif;
                font-size: 24px;
                font-weight: bolder;
                color: #000;
                text-align: center;
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
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
                background: linear-gradient(45deg, '.getRandomColor().', '.getRandomColor().');
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                color: #000;
            }

            .popup p {
                padding: 20px;
                margin: 0;
                color: #fff;
            }

            .popup-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .popup-table th, .popup-table td {
                padding: 10px;
                border: 1px solid #fff;
                text-align: center;
                color: #fff;
                min-height: 80px; 
            }

            .popup button {
                cursor: pointer;
                padding: 10px;
                border: none;
                background: #fff;
                color: #3498db;
                border-radius: 5px;
            }
            a:hover {
                background: none;
            }
        </style>';
    echo '<div class="overlay" onclick="closePopup()">';
    echo '<div class="popup" onclick="event.stopPropagation()">';
    echo '<table class="popup-table">';
    echo '<tr>';
    foreach ($header as $column) {
        echo '<th>' . $column . '</th>';
    }
    echo '</tr>';
    foreach ($data as $row) {
        echo '<tr>';
        foreach ($row as $cell) {
            echo '<td>' . $cell . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '<a href="Search.php" ><button onclick="closePopup()">Close</button><a>';
    echo '</div>';
    echo '</div>'; 
    echo '<script>
            function closePopup() {
                document.querySelector(".overlay").style.display = "none";
            }
          </script>';
}
function getRandomColor() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
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
function displayMobileTablePopup($header, $data) {
    // HTML and CSS for the simplified mobile-friendly popup
    echo '<style>
            .mobile-popup-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .mobile-popup {
                position: fixed;
                top: 10%;
                left: 5%;
                width: 90%;
                padding: 10px;
                border-radius: 10px;
                background: linear-gradient(45deg, #3498db, #2ecc71);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                color: #fff;
                overflow: auto;
            }

            .mobile-popup-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }

            .mobile-popup th, .mobile-popup td {
                padding: 8px;
                border: 1px solid #fff;
                text-align: center;
            }

            .mobile-popup button {
                cursor: pointer;
                padding: 8px;
                border: none;
                background: #fff;
                color: #3498db;
                border-radius: 5px;
                display: block;
                margin-top: 10px;
                margin-left: auto;
                margin-right: auto;
            }
            a:hover {
                background: none;
            }
        </style>';

    // HTML for the simplified mobile-friendly popup container
    echo '<div class="mobile-popup-container" onclick="closeMobilePopup()">';
    
    // HTML for the simplified mobile-friendly popup content (table)
    echo '<div class="mobile-popup" onclick="event.stopPropagation()">';
    
    echo '<table class="mobile-popup-table">';
    
    // Table header
    echo '<tr>';
    foreach ($header as $column) {
        echo '<th>' . $column . '</th>';
    }
    echo '</tr>';

    // Table content
    if (is_array($data)) {
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . $cell . '</td>';
            }
            echo '</tr>';
        }
    } else {
        // Handle the case where $data is not an array (e.g., display an error message)
        echo '<tr><td colspan="' . count($header) . '">No data available</td></tr>';
    }

    echo '</table>';
    echo '<a href="Search.php" <button onclick="closeMobilePopup()">Close</button></a>';
    echo '</div>'; // Close mobile-popup content
    echo '</div>'; // Close mobile-popup container

    // JavaScript to close the simplified mobile-friendly popup
    echo '<script>
            function closeMobilePopup() {
                document.querySelector(".mobile-popup-container").style.display = "none";
            }
          </script>';
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
        background: linear-gradient(to right, #5fafff, #a2dfff);
        display: flex;
        color: #fff;
    }

    .f {
        width: 70%;
        max-width: 400px; 
        margin: auto;
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    input {
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }
    input[type="text"]{
        width: 100%;
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

    label {
        color: black;
        font-size: large;
        margin-bottom: 5px;
    }
</style>


    <div style="margin: auto; padding: 10px;" class="f">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label class="label">ID/Name </label><br>
        <input type="text" name="id_or_name" required><br>

        <label class="label">Select Type:</label>
        <label class="radio-label">
            <input type="radio" name="type" value="id"> ID
        </label>
        <label class="radio-label">
            <input type="radio" name="type" value="name"> Name
        </label><br>

        <input type="submit" id="submit" name="submit" value="Submit">
    </form>
</div>

</body>
</html>
<?php

function table($id,$name,$type,$conn): array{
    try{
        $sql = "";
    if($type == "id"){
        $sql = "SELECT * FROM `students` WHERE id = '$id'";
    }else{
        $sql = "SELECT * FROM `students` WHERE name = '$name'";
    }
    $result = mysqli_query($conn,$sql);
    $arr = array();
    $sarr = array();
    foreach($result as $r){
        $sarr = array();
        foreach($r as $el){
            array_push($sarr,$el);
        }
        array_push($arr,$sarr);
    }
    return $arr;
    }catch(mysqli_sql_exception){
        return [];
    }
}
function isPhone():bool {
    $isMobile = (isset($_SERVER['HTTP_USER_AGENT']) && 
                  (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false || 
                   strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false)
                 );
    return $isMobile ? true : false;
}
function display($array)
    {
        $titles = array("ID", "Овог нэр","Утасны дугаар", "Анги", "Сарын төлбөр", "Төлөгдөөгүй төлбөр", "Хичээл эхэлсэн өдөр","Нийт орсон оролт");
        try{
        if (!empty($array)) {
            if(!isPhone()){
                displayTablePopup($titles,$array);
            }else{
                displayMobileTablePopup($titles,$array);
            }
        } else {
            write("No results found.","");
        }
    }catch(Exception){
        write("Error","<br>REASON: Functional error!!!");
    }
    }
if(isset($_POST['submit'])){
    $id = "";
    $name = "";
    $type="";
    if(!empty($_POST['type'])){
        $type = $_POST['type']; 
    }
    if(!empty($_POST['id_or_name'])){
        if($type == "id"){
            $id =  mysqli_real_escape_string($conn, $_POST['id_or_name']);
        }else{
            $name = mysqli_real_escape_string($conn, $_POST['id_or_name']);
        }
        display(table($id,$name,$type,$conn));
        mysqli_close($conn);
    }
}
?>