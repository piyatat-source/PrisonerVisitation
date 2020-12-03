<?php
session_start();

require_once '../database/connect.php';

if ($_POST) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $saltSQL =
        "SELECT staff_saltValue FROM tb_staffs WHERE staff_username = '" .
        $username .
        "'";
    $saltRESULT = mysqli_query($conn, $saltSQL);
    $saltROW = mysqli_fetch_assoc($saltRESULT);

    $salt = $saltROW['staff_saltValue'];

    $saltedPW = $password . $salt;

    $hashedPW = hash('sha256', $saltedPW);
    // echo $hashedPW;

    $sql =
        "SELECT * FROM tb_staffs 
                WHERE staff_username = '" .
        $username .
        "' and staff_password = '" .
        $hashedPW .
        "'";

    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);

    if (!$result) {
        // user หรือ pw ผิด
        header('location:sign_in.php');
    } else {
        //ล็อคอินผ่าน
        $_SESSION['Id'] = $result['staff_id'];
        $_SESSION['Firstname'] = $result['staff_firstname'];
        $_SESSION['Lastname'] = $result['staff_lastname'];
        $_SESSION['Department'] = $result['department'];

        header('location:index.php'); // locate ไปหน้าจัดการของ Staff
    }

    mysqli_close($conn);
}
?>
