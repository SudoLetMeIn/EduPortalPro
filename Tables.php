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
    echo '<a href="Tables.php" ><button onclick="closePopup()">Close</button><a>';
    echo '</div>';
    echo '</div>'; 
    echo '<script>
            function closePopup() {
                document.querySelector(".overlay").style.display = "none";
            }
          </script>';
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
    echo '<a href="Tables.php"> <button onclick="closeMobilePopup()">Close</button></a>';
    echo '</div>'; // Close mobile-popup content
    echo '</div>'; // Close mobile-popup container

    // JavaScript to close the simplified mobile-friendly popup
    echo '<script>
            function closeMobilePopup() {
                document.querySelector(".mobile-popup-container").style.display = "none";
            }
          </script>';
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
        font-size: 24px;
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
function getAllUniqueClasses($conn) {
    $query = "SELECT DISTINCT class FROM students";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
    $classes = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $classes[] = $row['class'];
    }
    mysqli_free_result($result);
    return $classes;
}
function __Get_Class__($class,$conn):array{
    try{
        $sql = "SELECT * FROM `students` WHERE class='$class'";
        // echo "<script>alert('" . mysqli_real_escape_string($conn, $sql) . "')</script>";
        $result = mysqli_query($conn,$sql);
        $arr = array();
        if(mysqli_num_rows($result)>0){
        foreach($result as $r){
            array_push($arr,$r);
        }}
        return $arr;
    }catch(mysqli_sql_exception){
        return array();
    }
}
function getRandomColor() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
function generateStyledClassSquares($conn) {
    $uniqueClasses = getAllUniqueClasses($conn);
    $classStyles = array();
    foreach ($uniqueClasses as $class) {
        $color1 = getRandomColor();
        $color2 = getRandomColor();
        $style = "background: linear-gradient(45deg, $color1, $color2);";
        $classStyles[$class] = $style;
    }
    echo '<form action="Tables.php" method="post">';
    echo '<div class="square-container" id="squareContainer">';
    foreach ($classStyles as $class => $style) {
        echo "<input type=\"submit\" name='class_name' class='square' style='$style' value='$class'>";
    }
    echo '</div>
    </form>';

    echo "<script>
            var squaresContainer = document.getElementById('squareContainer');
            var squares = document.querySelectorAll('.square');
            
            squaresContainer.style.display = 'flex';
            squaresContainer.style.flexWrap = 'wrap';

            squares.forEach(function(square) {
                square.style.width = '23vh';
                square.style.height = '23vh';
                square.style.borderRadius = '10px';
                square.style.margin = '10px';
                square.style.color = 'white';
                square.style.font = 'bold';
                square.style.borderRadius = '10px';
                square.style.margin = '10px';
                square.style.display = 'flex';
                square.style.alignItems = 'center';
                square.style.justifyContent = 'center';
                square.style.textAlign = 'center';
                square.style.transition = 'transform 0.3s, font-size 0.3s';

                square.addEventListener('mouseenter', function() {
                    square.style.transform = 'scale(1.05)';
                    square.style.fontSize = '1.2em';
                });

                square.addEventListener('mouseleave', function() {
                    square.style.transform = 'scale(1)';
                    square.style.fontSize = '1em';
                });
                function shake() {
                    var originalTransform = square.style.transform;
                    square.style.transform = 'translate(-2px, -2px)';
                    setTimeout(function() {
                        square.style.transform = 'translate(2px, 2px)';
                        setTimeout(function() {
                            square.style.transform = originalTransform;
                        }, 50);
                    }, 50);
                }

                square.addEventListener('mouseenter', shake);
            });
          </script>";

        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #a95fff, #d0a4ff);
            display: flex;
            text-align: center;
        }
    </style>
</head>
<body>
</body>
</html>
<?php
function print2DArray($array) {
    foreach ($array as $row) {
        foreach ($row as $element) {
            echo $element . " ";
        }
        echo "<br>";
    }
}
function isPhone():bool {
    $isMobile = (isset($_SERVER['HTTP_USER_AGENT']) && 
                  (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false || 
                   strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false)
                 );
    return $isMobile ? true : false;
}


generateStyledClassSquares($conn);
if(isset($_POST['class_name'])){
    $class = $_POST['class_name'];
    $titles = array("ID", "Овог нэр","Утасны дугаар", "Анги", "Сарын төлбөр", "Төлөгдөөгүй төлбөр", "Хичээл эхэлсэн өдөр","Нийт орсон оролт"); 
    $content = __Get_Class__($class,$conn);
    if(!isPhone()){
        displayTablePopup($titles,$content);
    }else{
        displayMobileTablePopup($titles,$content);
    }
}


?>