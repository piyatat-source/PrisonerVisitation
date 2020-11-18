<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php if ($_POST) {
    // เลขท้ายเบอร์กับเลขประจำตัว 2 หลัก
    $lasttelnum = substr($_POST['telnumber'], -2);
    $lastidnum = substr($_POST['idnumber'], -2);

    $req_code =
        'RQ' .
        $lasttelnum .
        $lastidnum .
        str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
    $req_pre = $_POST['pre'];
    $req_firstname = $_POST['firstname'];
    $req_lastname = $_POST['lastname'];
    $req_id_num = $_POST['idnumber'];
    $req_tel_num = $_POST['telnumber'];
    $req_line_id = $_POST['idline'];
    $req_relation = $_POST['relation'];
    $pri_firstname = $_POST['prifirstname'];
    $pri_lastname = $_POST['prilastname'];
    $pri_id_num = $_POST['priidnum'];
    $date_booking = $_POST['inputdatepicker'];
    $time_booking = $_POST['timepicker'];

    // Upload
    $fileupload = isset($_POST['idpic']) ? $_POST['idpic'] : '';
    $upload = $_FILES['idpic'];
    $date = date('Y-m-d');
    $dateArr = explode('-', $date);
    $dateThai = $dateArr['0'] + 543 . '-' . $dateArr[1] . '-' . $dateArr[2];

    $path = 'uploads_RQ/';

    if (isset($_FILES['idpic'])) {
        $errors = [];
        $maxsize = 2097152;
        $acceptable = ['image/jpeg', 'image/jpg', 'image/png'];

        if (
            $_FILES['idpic']['size'] >= $maxsize ||
            $_FILES['idpic']['size'] == 0 ||
            (!in_array($_FILES['idpic']['type'], $acceptable) &&
                !empty($_FILES['idpic']['type']))
        ) {
            $errors[] = 'TypeErr';
        }

        if (count($errors) === 0) {
            $type = strrchr($_FILES['idpic']['name'], '.');
            $req_id_img = $dateThai . '-' . $req_code . $type;
            $filename = $path . $dateThai . '-' . $req_code . $type;
            move_uploaded_file($_FILES['idpic']['tmp_name'], $filename);

            //Check Value Bofore Insert to DB
            // echo "code = ".$req_code."<br>";
            // echo "pre = ".$_POST["pre"]."<br>";
            // echo "firstname = ".$_POST["firstname"]."<br>";
            // echo "lastname = ".$_POST["lastname"]."<br>";
            // echo "telnumber = ".$_POST["telnumber"]."<br>";
            // echo "idnumber = ".$_POST["idnumber"]."<br>";
            // echo "idline = ".$_POST["idline"]."<br>";
            // echo "relation = ".$_POST["relation"]."<br>";
            // echo "idpic = ".$req_id_img."<br>";
            // echo "prifirstname = ".$_POST["prifirstname"]."<br>";
            // echo "prilastname = ".$_POST["prilastname"]."<br>";
            // echo "priidnum = ".$_POST["priidnum"]."<br>";
            // echo "inputdatepicker = ".$_POST["inputdatepicker"]."<br>";
            // echo "timepicker = ".$_POST["timepicker"]."<br>";

            require_once 'database/connect.php';

            //INSERT TO REQUEST DB
            $sql1 =
                "INSERT INTO tb_requests (req_code,req_pre,req_firstname,req_lastname,req_id_num,req_tel_num,req_line_id,req_relation,req_id_img,pri_firstname,pri_lastname,pri_id_num,date_booking,time_booking)
            VALUES ('" .
                $req_code .
                "','" .
                $req_pre .
                "','" .
                $req_firstname .
                "','" .
                $req_lastname .
                "','" .
                $req_id_num .
                "','" .
                $req_tel_num .
                "','" .
                $req_line_id .
                "','" .
                $req_relation .
                "','" .
                $req_id_img .
                "','" .
                $pri_firstname .
                "','" .
                $pri_lastname .
                "','" .
                $pri_id_num .
                "','" .
                $date_booking .
                "','" .
                $time_booking .
                "')";
            ($result = mysqli_query($conn, $sql1)) or
                die("Error in query: $sql1 " . mysqli_error());

            //INSERT TO CLOSE DATE DB
            $sql2 =
                "INSERT INTO tb_datecloses (dateClose,timeClose,closeType) VALUES ('" .
                $date_booking .
                "','" .
                $time_booking .
                "','" .
                'byrequest' .
                "')";
            ($result2 = mysqli_query($conn, $sql2)) or
                die("Error in query: $sql2 " . mysqli_error());
            mysqli_close($conn);
            echo '<script type="text/javascript">window.location.href = "confirm_request.php?code=' .
                $req_code .
                '"</script>';
        } else {
            foreach ($errors as $error) {
                echo '<script type="text/javascript">console.log("' .
                    $error .
                    '");
                        window.location.href = "form_request.php?typeErr=true";</script>';
            }
            die();
        }
    }
} ?>

        <script src="js/animate.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="js/sweetalert.js"></script>
</body>
</html>