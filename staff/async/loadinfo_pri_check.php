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
    '<div class="container"><table width="100%" border="0"><thead><tr><th width="50%"> </th><th width="50%"> </th></tr></thead><tbody><tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $response .= $response .=
        '<td style="vertical-align: top; padding:30px;" colspan="2">';

    $response .=
        '<p style="font-size:17px">
        ชื่อผู้ต้องขัง :  ' .
        $row['pri_firstname'] .
        '  ' .
        $row['pri_lastname'] .
        '<br>เลขประจำตัวประชาชนผู้ต้องขัง : ' .
        $row['pri_id_num'] .
        '<br>วันที่ญาติขอเยี่ยม : ' .
        $row['date_booking'] .
        '<br>เวลาที่ขอเยี่ยม : ' .
        $timeSet[$row['time_booking'] - 1] .
        '  (รอบที่ ' .
        $row['time_booking'] .
        ')' .
        ' </p> ';

    $response .= '</td></tr>';

    $response .=
        '<tr><td style="text-align:center" colspan="2">ผู้ต้องขัง สามารถให้เข้าเยี่ยมได้หรือไม่?<br><br>
            <a class="btn btn-success" href="action/confirm_accept_pri.php?id=' .
        $row['req_id'] .
        '
            "role="button">ยืนยัน! อนุญาตให้เยี่ยม</a> 
            
            <a class="btn btn-danger" href="action/confirm_deny_pri.php?id=' .
        $row['req_id'] .
        '
            
            " role="button">ไม่อนุญาต</a></td></tr>';

    $response .= '</tbody></table></div>';
}

echo $response;
exit();
