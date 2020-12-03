<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/webstyle.css">
    <link rel="stylesheet" href="css/contactusstyle.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <title>ติดต่อเรา</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="content">
        <div class="page">
            <div class="title-page">ติดต่อเรา</div>
            <div class="box">
                <div class="info-box">
                    <div class="map-content">
                        <div id="map"></div>
                    </div>
                    <div class="contact-box">
                        <div class="prison-title-name">เรือนจำจังหวัดกาฬสินธุ์</div>
                        <div class="prison-address"> 91 ถนนหน้าเรือนจำ ตำบลกาฬสินธุ์ จังหวัดกาฬสินธุ์ 46000</div>
                        <div class="contact-info">
                            <div>เบอร์โทรติดต่อ</div>
                            <div class="prison-tel">
                                <div><i class="fas fa-phone-alt"></i> 043 840 061 (ฝ่ายบริหารทั่วไป)</div>
                                <div><i class="fas fa-phone-alt"></i> 043 840 062 (ฝ่ายรักษาการณ์)</div>
                                <div><i class="fas fa-phone-alt"></i> 043 840 054 (ฝ่ายทัณฑปฎิบัติ)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKjvNZwhuC0RwkWxPY60DTWRTH6BST-xw&callback=initMap" async defer></script>
</body>
</html>