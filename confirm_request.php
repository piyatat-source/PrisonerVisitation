<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb7f694074.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/webstyle.css">
    

    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/formjs.js"></script>

    <link href="bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" />
    <link href="bootstrap-3.3.7-dist/css/bootstrap-theme.css" rel="stylesheet" />
    <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>

    <link href="dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <script src="dist/js/bootstrap-datepicker-custom.js"></script>
    <script src="dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
   


    <title>Prisoner Visitor</title>
</head>
<body>

        <?php
        $code = $_GET['code'];

        include 'header.php';
        ?>
   
       <div class="content">
          <div class="page">
            <div class="title-page">ส่งคำขอสำเร็จ</div>
            <div class="box">
            <form id="addReq" method="post" action="add_request.php" enctype="multipart/form-data">
              <div class="info-box" style="height:400px !important">
                
                <div class="show-code"><i class="far fa-check-circle"></i><br><br>หมายเลขคำขอของคุณคือ  <h3><?php echo $code; ?></h3>  </div>
                  <div class="txt">กรุณารอเจ้าหน้าที่ตรวจสอบข้อมูล (อาจใช้เวลา 1-2วันทำการ)<br><br>หมายเหตุ : กรุณาจดบันทึกหมายเลขคำขอของท่านไว้เพื่อตรวจสอบสถานะการอนุมัติ</div>
              </div>
              </form>
            </div>
          </div>
       </div>

        <?php include 'footer.php'; ?>


        
</body>
</html>