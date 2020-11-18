<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb7f694074.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/webstyle.css">
    <link rel="stylesheet" href="css/slide.css">

    <script src="jquery-2.1.3.min.js"></script>



    <title>Prisoner Visitor</title>
</head>
<body>
    
        <?php include 'header.php'; ?>
   
        <div class="content">
            <div class="slideshow-container">

                <div class="mySlides fade">
                <img src="img_slide/slide_1.jpg" style="width:100%">
                <!-- <div class="text">Caption Text</div> -->
                </div>
                <div class="mySlides fade">
                <img src="img_slide/slide_2.jpg" style="width:100%">
                <!-- <div class="text">Caption Text</div> -->
                </div>
                <div class="mySlides fade">
                <img src="img_slide/slide_2.jpg" style="width:100%">
                <!-- <div class="text">Caption Text</div> -->
                </div>
             
            </div>
            <div style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
            </div>
            <script src="js/slide.js"></script>

            <div class="menu-main">
              <div class="title-bar">เมนูบริการ</div>
              <div class="menu-all"> 
                <a href="form_request.php">
                  <div class="menu-list">
                      <div class="menu-pic"><i class="fas fa-paper-plane"></i></div>
                      <div class="menu-name">ส่งคำขอเยี่ยมผู้ต้องขัง</div>
                  </div>
                  </a>
                  <a href="#Menu2">
                    <div class="menu-list">
                      <div class="menu-pic"><i class="fas fa-users"></i></div>
                      <div class="menu-name">ส่งคำขอร่วมเยี่ยม</div>  
                    </div>
                  </a>
                  <a href="#Menu3">
                    <div class="menu-list">
                      <div class="menu-pic"><i class="fas fa-user-check"></i></div>
                      <div class="menu-name">ตรวจสอบสถานะ</div>
                    </div>
                  </a> 
                  <a href="#Menu4">
                    <div class="menu-list">   
                      <div class="menu-pic"><i class="fas fa-question-circle"></i></div>
                      <div class="menu-name">วิธีการใช้งาน</div>
                    </div>
                  </a>
                  
              </div>
              <div style="clear:both;"></div>
            </div>
          
        </div>

        <?php include 'footer.php'; ?>
    
</body>
</html>