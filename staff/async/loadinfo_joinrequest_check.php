<?php
include '../../database/connect.php';
$jreqid = $_POST['jreqid'];

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

$sql = "SELECT * FROM tb_joinrequests WHERE jreq_id = '" . $jreqid . "' ";
$result = mysqli_query($conn, $sql);

$response =
    '<div class="container"><table width="100%" border="0"><thead><tr><th width="50%"> </th><th width="50%"> </th></tr></thead><tbody><tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $response .=
        '<td style="padding:30px"><img width="100%" src="../uploads_JQ/' .
        $row['jreq_id_img'] .
        '"></td>';

    $response .= '<td style="vertical-align: top; padding:30px">';

    $response .=
        '<p class="lead"><strong>หมายเลขคำขอ : ' .
        $row['jreq_code'] .
        '</p></strong>
        <p style="line-height: 2.0;">ชื่อ :  ' .
        $row['jreq_pre'] .
        $row['jreq_firstname'] .
        '  ' .
        $row['jreq_lastname'] .
        ' 
        <br>เบอร์โทร :  ' .
        $row['jreq_tel_num'] .
        '
        <br>เลขประจำตัวประชาชน :  ' .
        $row['jreq_id_num'] .
        '
        <br>LINE ID :  ' .
        $row['jreq_line_id'] .
        '
        <br>ความสัมพันธ์ :  ' .
        $row['jreq_relation'] .
        '';

    $sql2 =
        "SELECT * FROM tb_requests WHERE req_code = '" .
        $row['req_code'] .
        "' ";
    $result2 = mysqli_query($conn, $sql2);

    while ($row2 = mysqli_fetch_assoc($result2)) {
        $response .=
            '<hr><p class="lead"><strong>ข้อมูลการขอเยี่ยม</strong></p>
        ชื่อผู้ต้องขัง :  ' .
            $row2['pri_firstname'] .
            '  ' .
            $row2['pri_lastname'] .
            '<br>วันที่จองเยี่ยม : ' .
            $row2['date_booking'] .
            '<br>เวลาที่จองเยี่ยม : ' .
            $timeSet[$row2['time_booking'] - 1] .
            '  (รอบที่ ' .
            $row2['time_booking'] .
            ')' .
            ' </p> ';

        $response .= '</td></tr>';
    }

    $response .=
        '<tr><td style="text-align:center" colspan="2">ข้อมูลดังกล่าวถูกตรวจสอบ และมีความถูกต้องหรือไม่?<br><br>
            <a class="btn btn-success" href="action/confirm_accept_jreq_relation.php?id=' .
        $row['jreq_id'] .
        '
            "role="button">ยืนยัน! สามารถให้เยี่ยมได้</a> 
            
            <a class="btn btn-danger" href="action/confirm_deny_jreq_relation.php?id=' .
        $row['jreq_id'] .
        '
            
            " role="button">ข้อมูลไม่ถูกต้อง</a></td></tr>';

    $response .= '</tbody></table></div>';
}

echo $response;
exit();
