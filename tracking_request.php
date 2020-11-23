<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb7f694074.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/webstyle.css">
    <link rel="stylesheet" href="css/timepicker.css">

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
 
        <?php include 'header.php'; ?>
   
       <div class="content">
          <div class="page">
            <div class="title-page">การติดตามคำร้อง</div>
            <div class="box">
            
              <div class="info-box">

              <?php if (!$_GET) { ?>
              <div class="title-info">ติดตามคำร้อง</div>
              <form id="ChecktoTrack" method="get" action="tracking_request2.php">
              <div class="info">
                  <div class="info-name">หมายเลขคำร้อง <div class="redstar">*</div></div>
                  <div class="info-value"><input type="text" name="reqcode" id="reqcode" placeholder="QR12345678" maxlength="10"></div>
                </div>
                <div class="btn-check-rq"><button id="btn-ch" type="button" onclick="CheckToTrack()">ตรวจสอบ</button></div>

              </form>

              <?php } ?>


              <?php if ($_GET) {
                  $timeSet = [
                      '09.00-09.15น.',
                      '09.20-09.35น.',
                      '09.40-09.55น.',
                      '10.00-10.15น.',
                      '10.20-10.35น.',
                      '10.40-10.55น.',
                      '11.00-11.15น.',
                      '11.20-11.35น.',
                      '11.40-11.55น.',
                      '12.00-12.15น.',
                      '12.20-12.35น.',
                      '12.40-09.55น.',
                      '13.00-13.15น.',
                      '13.20-13.35น.',
                      '13.40-13.55น.',
                      '14.00-14.15น.',
                      '14.20-14.35น.',
                      '14.40-14.55น.',
                  ];
                  $AllowToJoin = false;
                  require_once 'database/connect.php';
                  $codeReq = $_GET['reqcode'];
                  $string = $codeReq; // RQ12345678
                  $parts = preg_split(
                      '/(,?\s+)|((?<=[a-z])(?=\d))|((?<=\d)(?=[a-z]))/i',
                      $string
                  );
                  if ($parts[0] == 'RQ') {
                      $sql = "SELECT * FROM tb_requests WHERE req_code = '$codeReq'";
                      $result = mysqli_query($conn, $sql);
                      $row = mysqli_fetch_assoc($result);
                      if (
                          isset($row['req_status']) &&
                          $row['req_status'] == 'accept'
                      ) { ?>
                        
                            <div class="title-info"><?php echo $codeReq; ?></div>
                            <div class="info-box" style="height:400px !important">
                                <div class="show-code"><i class="far fa-file-alt"></i><br><br>ผลอนุมัติคำขอผ่านแล้ว </div>
                                <div class="txt">การจองของคุณคือวันที่ <b style="color:#82a7bf">
                                <?php echo $row['date_booking']; ?> 
                                </b>
                                <b style="color:#4388b5">
                                <?php
                                $time = $row['time_booking'];
                                echo '(รอบที่ ' .
                                    $time .
                                    ' เวลา ' .
                                    $timeSet[$time - 1] .
                                    ')';
                                ?>
                                </b><br><br> กรุณาติดต่อเจ้าหน้าที่ <b>ก่อนเวลาเยี่ยม 10 นาที</b><br> ผ่านช่องทาง <b style="color:#32CD32">LINE ID : kalasin-prison </b>
                                </div>
                                <div class="btn-check-rq"><button id="btn-back" type="button" onclick="window.location.href='tracking_request2.php'">กลับ</button></div>
                            </div>
                      

                        <?php } elseif (
                          isset($row['req_status']) &&
                          $row['req_status'] == 'deny'
                      ) { ?>
                          <div class="title-info"><?php echo $codeReq; ?></div>
                            <div class="info-box" style="height:400px !important">
                                <div class="show-code"><i style="color:#a81a27" class="fas fa-exclamation-circle"></i><br><br>ผลอนุมัติคำขอไม่ผ่าน </div>
                                <div class="txt">เนื่องจากการตรวจสอบเอกสารไม่ถูกต้อง <br>ข้อมูลเพิ่มเติมติดต่อ 043-840-061</div>
                                <div class="btn-check-rq"><button id="btn-back" type="button" onclick="window.location.href='tracking_request2.php'">กลับ</button></div>
                            </div>
                          <?php } elseif (
                          isset($row['req_status']) &&
                          $row['req_status'] == 'none'
                      ) { ?>
                        <div class="title-info"><?php echo $codeReq; ?></div>
                          <div class="info-box" style="height:400px !important">
                              <div class="show-code"><i style="color:#DAA520" class="far fa-clock"></i><br><br>อยู่ระหว่างรอตรวจสอบ </div>
                              <div class="txt">กรุณารอเจ้าหน้าที่ตรวจสอบข้อมูล (อาจใช้เวลา 1-2วันทำการ)
                              <div class="btn-check-rq"><button id="btn-back" type="button" onclick="window.location.href='tracking_request2.php'">กลับ</button></div>
                          </div>
                        <?php } else {echo '<b>ไม่พบหมายเลขคำขอนี้</b>';}
                  } elseif ($parts[0] == 'JQ') {
                      $sql = "SELECT * FROM tb_joinrequests WHERE jreq_code = '$codeReq'";
                      $result = mysqli_query($conn, $sql);
                      $row = mysqli_fetch_assoc($result);
                      if (
                          isset($row['jreq_status']) &&
                          $row['jreq_status'] == 'accept'
                      ) { ?>
                        
                        <div class="title-info"><?php echo $codeReq; ?></div>
                        <div class="info-box" style="height:400px !important">
                            <div class="show-code"><i class="far fa-file-alt"></i><br><br>ผลอนุมัติคำขอผ่านแล้ว </div>
                            <div class="txt">
                           <br> กรุณาติดต่อเจ้าหน้าที่ <b>ก่อนเวลาเยี่ยม 10 นาที</b><br> ผ่านช่องทาง <b style="color:#32CD32">LINE ID : kalasin-prison </b>
                            </div>
                            <div class="btn-check-rq"><button id="btn-back" type="button" onclick="window.location.href='tracking_request2.php'">กลับ</button></div>
                        </div>
                  

                    <?php } elseif (
                          isset($row['jreq_status']) &&
                          $row['jreq_status'] == 'deny'
                      ) { ?>
                          <div class="title-info"><?php echo $codeReq; ?></div>
                            <div class="info-box" style="height:400px !important">
                                <div class="show-code"><i style="color:#a81a27" class="fas fa-exclamation-circle"></i><br><br>ผลอนุมัติคำขอไม่ผ่าน </div>
                                <div class="txt">เนื่องจากการตรวจสอบเอกสารไม่ถูกต้อง <br>ข้อมูลเพิ่มเติมติดต่อ 043-840-061</div>
                                <div class="btn-check-rq"><button id="btn-back" type="button" onclick="window.location.href='tracking_request2.php'">กลับ</button></div>
                            </div>
                          <?php } elseif (
                          isset($row['jreq_status']) &&
                          $row['jreq_status'] == 'none'
                      ) { ?>
                        <div class="title-info"><?php echo $codeReq; ?></div>
                          <div class="info-box" style="height:400px !important">
                              <div class="show-code"><i style="color:#DAA520" class="far fa-clock"></i><br><br>อยู่ระหว่างรอตรวจสอบ </div>
                              <div class="txt">กรุณารอเจ้าหน้าที่ตรวจสอบข้อมูล (อาจใช้เวลา 1-2วันทำการ)
                              <div class="btn-check-rq"><button id="btn-back" type="button" onclick="window.location.href='tracking_request2.php'">กลับ</button></div>
                          </div>
                        <?php } else { ?>
                            <div class="title-info"><?php echo $codeReq; ?></div>
                              <div class="info-box" style="height:400px !important">
                                  <div class="show-code"><i style="color:#e5e5e5" class="fas fa-times"></i><br><br>ไม่พบหมายเลขคำขอ </div>
                                  <div class="txt">หากลืมหมายเลขคำขอ หรือมีข้อสงสัยกรุณาติดต่อเจ้าหน้าที่
                                  <div class="btn-check-rq"><button id="btn-back" type="button" onclick="window.location.href='tracking_request2.php'">กลับ</button></div>
                              </div>
                            <?php }
                  } else {
                       ?>
                    <div class="title-info">รูปแบบผิดพลาด</div>
                      <div class="info-box" style="height:400px !important">
                          <div class="show-code"><i style="color:#e5e5e5" class="fas fa-times"></i><br><br> </div>
                          <div class="txt">รูปแบบของหมายเลขคำขอผิด
                          <div class="btn-check-rq"><button id="btn-back" type="button" onclick="window.location.href='tracking_request2.php'">กลับ</button></div>
                      </div>
                    <?php
                  }
              } ?>

               
            </div>
              
            </div>
          </div>
       </div>

        <?php include 'footer.php'; ?>

</body>
</html>