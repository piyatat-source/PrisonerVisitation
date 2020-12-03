<?php
$id_date;
$id = $_GET['id'];
require_once '../../database/connect.php';

$sql =
    'UPDATE tb_requests SET doc_pri_status = "deny"  WHERE req_id  = "' .
    $id .
    '" ';
$result = mysqli_query($conn, $sql);

if ($result) {
    header('Location: ../approve_prisoner.php?success=true');
} else {
    header('Location: ../approve_prisoner.php?success=false');
}
?>

?>
