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
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            display: flex;
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
</head>
<body>
    <div style = "margin: auto;padding: 10px;" class="f" >
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="myForm" enctype="multipart/form-data" onsubmit="return validateForm()">
    <label class="label" for="name">Name</label><br>
    <input type="text" id="name" name="name" placeholder="Баасан Пүрэв" required><br>

    <label class="label" for="class">Class</label><br>
    <input type="text" id="class" name="class" placeholder="Математик 12" required><br>

    <label class="label" for="telephone">Telephone</label><br>
    <input type="text" id="telephone" name="telephone" placeholder="99999999" minlength="8" maxlength="16" required><br>

    <label class="label" for="pay">Monthly Pay</label><br>
    <input type="text" id="pay" name="monthly_pay" placeholder="200000" required><br>

    <label class="label" for="file">Insert xlsx</label><br>
    <input type="file" id="file" name="excel" onchange="checkFile()"><br>

    <input type="submit" id="submit" name="submit" value="Submit">
</form>
</div>
<script>
    function checkFile() {
        var fileInput = document.getElementById('file');
        var isFileAttached = fileInput.files.length > 0;

        var form = document.getElementById('myForm');
        form.noValidate = isFileAttached;
    }

    function validateForm() {
        var fileInput = document.getElementById('file');
        var allowedExtensions = ['xlsx'];
        if (fileInput.files.length > 0) {
            var fileName = fileInput.files[0].name;
            var fileExtension = fileName.split('.').pop().toLowerCase();
            if (allowedExtensions.indexOf(fileExtension) === -1) {
                alert('Please attach a valid Excel file (.xlsx).');
                return false;
            }
        }
        return true;
    }
</script>
</body>
</html>
<?php
function isUniqueData($conn, $name, $class) {
    $query = "SELECT * FROM `students` WHERE name = '$name' AND class = '$class'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
    $numRows = mysqli_num_rows($result);
    mysqli_free_result($result);
    return ($numRows === 0);
}
function insert($name,$telephone,$class,$monthly_pay,$payment_left,$conn):int{
    $id=0;
try{
$sql = "INSERT INTO `students` (`id`, `name`, `phone` , `class`, `monthly_pay`, `payment_left`, `enrolled_date`, `total_months`) 
        VALUES (null, ?, ?, ?, ?, ?, current_timestamp(), 1)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $telephone, $class, $monthly_pay, $payment_left);
$stmt->execute();
$id = $conn->insert_id;
}catch(mysqli_sql_exception){
    echo "Unable to create new student!!";
}
return $id;
}
if(isset($_POST['submit'])){
    if(!empty($_POST['name']) && !empty($_POST['telephone']) && !empty($_POST['class']) && !empty($_POST['monthly_pay'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $monthly_pay = mysqli_real_escape_string($conn, $_POST['monthly_pay']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
        $monthly_pay = intval($monthly_pay);
        $payment_left = $monthly_pay;
        if(isUniqueData($conn,$name,$class)){
        $id = insert($name,$telephone,$class,$monthly_pay,$payment_left,$conn);
        mysqli_close($conn);
        write("Student ID:",$id);
        } else{
            write("Unable to create new user","");
        }
    }elseif(!empty($_FILES['excel'])){
    include "readExcel.php";
    operation($_FILES['excel'],$conn);
    }
}
?>