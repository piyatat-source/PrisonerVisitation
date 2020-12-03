<?php
$id = $_GET['id'];
$date = $_GET['date'];
$time = $_GET['time'];
require_once '../../database/connect.php';
$sql =
    'UPDATE tb_joinrequests SET jreq_status = "deny"  WHERE jreq_id  = "' .
    $id .
    '" ';
$result = mysqli_query($conn, $sql);

if ($result) {
    header('Location: ../approve_jq.php?success=true');
} else {
    header('Location: ../approve_jq.php?success=false');
}
?>
