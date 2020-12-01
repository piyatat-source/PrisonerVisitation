<?php
include '../../database/connect.php';
$reqid = $_POST['reqid'];

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

$sql = "SELECT * FROM tb_requests WHERE req_id = '" . $reqid . "' ";
$result = mysqli_query($conn, $sql);

$response =
    '<div class="container"><table width="100%" border="0"><thead><tr><th width="100%"> </th> </th></tr></thead><tbody><tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $response .= '<td style="vertical-align: top; padding:30px">';

    $response .=
        '<p class="lead"><strong>หมายเลขคำขอ : ' .
        $row['req_code'] .
        '</p></strong>';

    $response .=
        'ชื่อผู้ต้องขัง :  ' .
        $row['pri_firstname'] .
        '  ' .
        $row['pri_lastname'] .
        '<br>วันที่จองเยี่ยม : ' .
        $row['date_booking'] .
        '<br>เวลาที่จองเยี่ยม : ' .
        $timeSet[$row['time_booking'] - 1] .
        '<br><br><hr><p class="lead"><strong>ข้อมูลผู้ส่งคำขอ</strong></p> </p> ' .
        '<p style="line-height: 2.0;">
        <img width="50%" src="../uploads_RQ/' .
        $row['req_id_img'] .
        '">
        <br><br>ชื่อ :  ' .
        $row['req_pre'] .
        $row['req_firstname'] .
        '  ' .
        $row['req_lastname'] .
        ' 

        <br>ความสัมพันธ์ :  ' .
        $row['req_relation'] .
        '
        <br>เบอร์โทร :  ' .
        $row['req_tel_num'] .
        '
        <br>เลขประจำตัวประชาชน :  ' .
        $row['req_id_num'] .
        '
        <br>LINE ID :  ' .
        $row['req_line_id'] .
        '
        
        <br><br><hr><p class="lead"><strong>ข้อมูลผู้ร่วมเยี่ยม</strong></p> </p>';

    $sql2 =
        'SELECT * FROM tb_joinrequests WHERE req_code = "' .
        $row['req_code'] .
        '" AND jreq_status = "accept" ';
    $Joinmember = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($Joinmember) == 0) {
        $response .= ' - ไม่มี';
    }

    while ($each = mysqli_fetch_assoc($Joinmember)) {
        $response .=
            '<img width="50%" src="../uploads_JQ/' .
            $each['jreq_id_img'] .
            '"><br><br>' .
            'ชื่อ :  ' .
            $each['jreq_pre'] .
            $each['jreq_firstname'] .
            '  ' .
            $each['jreq_lastname'] .
            '<br>ความสัมพันธ์ :  ' .
            $each['jreq_relation'] .
            '<br><br>';
    }

    $response .= '</td></tr>';

    $response .= '</tbody></table></div>';
}

echo $response;
exit();
