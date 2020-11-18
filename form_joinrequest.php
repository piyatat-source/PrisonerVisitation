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
            <div class="title-page">ส่งคำร้องขอเยี่ยมผู้ต้องขัง</div>
            <div class="box">
            
              <div class="info-box">
              <div class="title-info">การตรวจสอบคำขอ</div>
              <form id="ChecktoJoin" method="get" action="form_joinrequest.php">
              <div class="info">
                  <div class="info-name">หมายเลขคำร้องที่จะเข้าร่วม <div class="redstar">*</div></div>
                  <div class="info-value"><input type="text" name="reqcode" id="reqcode" placeholder="QR12345678" maxlength="10"></div>
                </div>

                <div class="btn-check-rq"><button type="button" onclick="CheckToJoin()">ตรวจสอบ</button></div>

              <!-- <div class="title-info">ข้อมูลผู้ส่งคำขอร่วม</div>
                <div class="info">
                  <div class="info-name">คำนำหน้า <div class="redstar">*</div></div>
                  <div class="info-value">
                  <select name="pre" id="pre">
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                  </select>
                  </div>
                </div>
                <div class="info">
                  <div class="info-name">ชื่อจริง <div class="redstar">*</div></div>
                  <div class="info-value"><input type="text" name="firstname" id="firstname" placeholder="ชื่อจริง"></div>
                </div>
                <div class="info">
                  <div class="info-name">นามสกุล <div class="redstar">*</div></div>
                  <div class="info-value"><input type="text" name="lastname" id="lastname" placeholder="นามสกุล"></div>
                </div>
                <div class="info">
                  <div class="info-name">เบอร์มือถือ<div class="redstar">*</div></div>
                  <div class="info-value"><input type="number" name="telnumber" id="telnumber" placeholder="เบอร์มือถือ" maxlength="10"></div>
                </div>
                <div class="info">
                  <div class="info-name">เลขประจำตัวประชาชน<div class="redstar">*</div></div>
                  <div class="info-value"><input type="number" name="idnumber" id="idnumber" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"maxlength = "13"/></div>
                </div>
                <div class="info">
                  <div class="info-name">LINE ID หรือเบอร์ที่ใช้สมัคร LINE<div class="redstar">*</div></div>
                  <div class="info-value"><input type="text" name="idline" id="idline" placeholder="LINE ID หรือเบอร์"></div>
                </div>
                
                <div class="info">
                  <div class="info-name">ความสัมพันธ์กับผู้ต้องขัง<div class="redstar">*</div></div>
                  <div class="info-value">
                    <select name="relation" id="relation">
                      <option value="พ่อ">พ่อ</option>
                      <option value="แม่">แม่</option>
                      <option value="ลูกสาว/ลูกชาย">ลูกสาว/ลูกชาย</option>
                      <option value="หลานสาว/หลานชาย">หลานสาว/หลานชาย</option>
                      <option value="ลุง/ป้า">ลุง/ป้า</option>
                      <option value="ปู่/ตา">ปู่/ตา</option>
                      <option value="ย่ายาย">ย่า/ยาย</option>
                    </select>
                  </div>
                </div>
                <div class="info">
                  <div class="info-name">อัพโหลดภาพบัตรประชาชน<div class="redstar">*</div></div>
                  <div class="info-value"><input type="file" name="idpic" id="idpic"></div>
                </div>
 
              <div style="clear:both;"></div> 
              <div class="btn-submit"><button type="button" onclick="CheckRequest()">ยืนยันส่งคำร้อง</button></div> -->
              <!-- <div class="btn-submit"><button type="submit">บันทึก</button></div> -->
              </form>


              <?php if ($_GET) {
                  require_once 'database/connect.php';
                  $AllowToJoin = false;
                  $code = $_GET['reqcode'];
                  $sql =
                      "SELECT * FROM tb_requests WHERE req_code = '" .
                      $code .
                      "' ";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                  if ($row['req_status'] == 'none') {
                  }
              } else {
                  echo 'NOTGET';
              } ?>
            </div>
              
            </div>
          </div>
       </div>

        <?php include 'footer.php'; ?>


        
</body>
</html>