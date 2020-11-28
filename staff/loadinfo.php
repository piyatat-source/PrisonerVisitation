<?php
include '../database/connect.php';
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
    '<div class="container"><table width="100%" border="0"><thead><tr><th width="50%"> </th><th width="50%"> </th></tr></thead><tbody><tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $response .=
        '<td style="padding:30px"><img width="100%" src="../uploads_RQ/' .
        $row['req_id_img'] .
        '"></td>';

    $response .= '<td style="vertical-align: top; padding:30px">';

    $response .=
        '<p class="lead"><strong>หมายเลขคำขอ : ' .
        $row['req_code'] .
        '</p></strong>
        <p style="line-height: 2.0;">ชื่อ :  ' .
        $row['req_pre'] .
        $row['req_firstname'] .
        '  ' .
        $row['req_lastname'] .
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
        <br>ความสัมพันธ์ :  ' .
        $row['req_relation'] .
        '';

    $response .=
        '<hr><p class="lead"><strong>ข้อมูลการจองเยี่ยม</strong></p>
        ชื่อผู้ต้องขัง :  ' .
        $row['pri_firstname'] .
        '  ' .
        $row['pri_lastname'] .
        '<br>วันที่จองเยี่ยม : ' .
        $row['date_booking'] .
        '<br>เวลาที่จองเยี่ยม : ' .
        $timeSet[$row['time_booking'] - 1] .
        ' </p> ';

    $response .= '</td></tr>';

    if (
        $row['doc_relat_status'] == 'deny' ||
        $row['doc_pri_status'] == 'deny'
    ) {
        $response .=
            '<tr><td style="text-align:center" colspan="2">คำขอนี้มีสถานะ <h4 style="color:red;display:inline">ไม่ผ่าน</h4> ยืนยันปฏิเสธคำร้องหรือไม่ ?<br><br><a class="btn btn-danger btn-lg" href="action/confirm_deny.php?id=' .
            $row['req_id'] .
            '&date=' .
            $row['date_booking'] .
            '&time=' .
            $row['time_booking'] .
            '" role="button">ยืนยันปฏิเสธ</a></td></tr>';
    }

    if (
        $row['doc_relat_status'] == 'accept' &&
        $row['doc_pri_status'] == 'accept'
    ) {
        $response .=
            '<tr><td style="text-align:center" colspan="2">คำขอนี้มีสถานะ <h4 style="color:green;display:inline">ผ่าน</h4> ยืนยันอนุมัติคำร้องหรือไม่ ?<br><br>
            <a class="btn btn-success btn-" href="action/confirm_accept.php?id=' .
            $row['req_id'] .
            '&date=' .
            $row['date_booking'] .
            '&time=' .
            $row['time_booking'] .
            '
            "role="button">ยืนยันอนุมัติ</a> 
            
            <a class="btn btn-danger btn-sm" href="action/confirm_deny.php?id=' .
            $row['req_id'] .
            '&date=' .
            $row['date_booking'] .
            '&time=' .
            $row['time_booking'] .
            '
            
            " role="button">ไม่อนุมัติ</a></td></tr>';
    }

    $response .= '</tbody></table></div>';
}

echo $response;
exit();
