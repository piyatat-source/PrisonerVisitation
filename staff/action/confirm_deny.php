<?php
$id = $_GET['id'];
$date = $_GET['date'];
$time = $_GET['time'];
require_once '../../database/connect.php';
$sql =
    'UPDATE tb_requests SET req_status = "deny"  WHERE req_id  = "' .
    $id .
    '" ';
$result = mysqli_query($conn, $sql);

$sql2 =
    'DELETE FROM tb_datecloses WHERE dateClose = "' .
    $date .
    '" AND timeClose = "' .
    $time .
    '"';
$result2 = mysqli_query($conn, $sql2);

if ($result && $result2) {
    header('Location: ../approve_rq.php?success=true');
} else {
    header('Location: ../approve_rq.php?success=false');
}
?>
