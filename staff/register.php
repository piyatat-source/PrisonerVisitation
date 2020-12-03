<?php

if ($_POST) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $confirmpwd = $_POST['confirm-pwd'];
    $department = $_POST['department'];

    // Function Random String
    function generateRandomString($length = 12)
    {
        $characters =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    // $randString = generateRandomString();
    // $salt = password_hash($randString, PASSWORD_DEFAULT); // ค่า Salt
    // $hashPwd = sha1($pwd.$salt); // Hash Password

    $salt = password_hash(generateRandomString(), PASSWORD_DEFAULT); // ค่า Solt
    $saltedPW = $pwd . $salt; // รวม Password กับ ค่า Salt
    $hashedPW = hash('sha256', $saltedPW); //ค่า Password+Salt ที่แปลงแล้ว

    require_once '../database/connect.php';
    //ตรวจ username ซ้ำ
    $check = "SELECT  staff_username FROM tb_staffs WHERE staff_username = '$username'";
    ($check_result = mysqli_query($conn, $check)) or die(mysqli_error());
    $num = mysqli_num_rows($check_result);

    if ($num > 0) {
        echo '<script>';
        echo "SweetAlert('ชื่อผู้ใช้นี้ถูกใช้งานแล้ว','warning');";
        echo '</script>';
    } else {
        // สมัคร
        $sql =
            "INSERT INTO tb_staffs (staff_username,staff_password,staff_saltValue,staff_firstname,staff_lastname,department)
                VALUE ('" .
            $username .
            "','" .
            $hashedPW .
            "','" .
            $salt .
            "','" .
            $firstname .
            "','" .
            $lastname .
            "','" .
            $department .
            "')";

        ($result = mysqli_query($conn, $sql)) or
            die("Error in query: $sql " . mysqli_error());
    }
    mysqli_close($conn);
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/formjs.js"></script>
    <link rel="stylesheet" href="css/registerstyle.css">
    <title>สมัครสมาชิก</title>
</head>
<body>
    <div class="title-register">สมัครสมาชิก</div>
    <div class="box-register">
        <div class="form-register">
            <form name="regisStaff" id="regisStaff" action="register.php" method="post">
                <div class="info-register">
                    <div class="article">ชื่อจริง<div class="star"> *</div></div>
                    <div class="input">
                        <input type="text" name="firstname" id="firstname" placeholder="ชื่อจริง">
                    </div>
                </div>
                <div class="info-register">
                    <div class="article">นามสกุล<div class="star"> *</div></div>
                    <div class="input">
                        <input type="text" name="lastname" id="lastname" placeholder="นามสกุล">
                    </div>
                </div>
                <div class="info-register">
                    <div class="article">ชื่อผู้ใช้<div class="star"> *</div></div>
                    <div class="input">
                        <input type="text" name="username" id="username" placeholder="ชื่อผู้ใช้" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)">
                    </div>
                </div>
                <div class="info-register">
                    <div class="article">รหัสผ่าน<div class="star"> *</div></div>
                    <div class="input">
                        <input type="text" name="pwd" id="pwd" placeholder="รหัสผ่าน">
                    </div>
                </div>
                <div class="info-register">
                    <div class="article">ยืนยันรหัสผ่าน<div class="star"> *</div></div>
                    <div class="input">
                        <input type="text" name="confirm-pwd" id="confirm-pwd" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                </div>
                <div class="info-register">
                    <div class="article">แผนก<div class="star"> *</div></div>
                    <div class="input">
                        <select name="department" id="department">
                            <option value="" disabled selected>===== แผนก =====</option>
                            <option value="visitRelative">แผนกเยี่ยมญาติ</option>
                            <option value="prisonerRegis">แผนกทะเบียนผู้ต้องขัง</option>
                            <option value="relativeRegis">แผนกทะเบียนญาติ</option>
                        </select>
                    </div>
                </div>
                <div class="regis-sub">
                    <button type="button" onclick="checkRegister(document.regisStaff.firstname,document.regisStaff.lastname)">สมัครสมาชิก</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="js/sweetalert.js"></script>
</body>
</html>