<?php
$id_date;
$id = $_GET['id'];
$date = $_GET['date'];
$time = $_GET['time'];
require_once '../../database/connect.php';
$sql =
    'SELECT * FROM tb_datecloses WHERE dateClose =  "' .
    $date .
    '"  AND timeClose = "' .
    $time .
    '" AND closeType = "byrequest"';
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $id_date = $row['dc_id'];
}

$sql2 =
    'UPDATE tb_requests SET req_status = "accept"  WHERE req_id  = "' .
    $id .
    '" ';
$result2 = mysqli_query($conn, $sql2);

$sql3 =
    "INSERT INTO tb_visits (req_id,dc_id) VALUES ('" .
    $id .
    "','" .
    $id_date .
    "')";

$result3 = mysqli_query($conn, $sql3);

if ($result && $result2 && $result3) {
    header('Location: ../approve_rq.php?success=true');
} else {
    header('Location: ../approve_rq.php?success=false');
}
?>

?>
