<?php
$id_date;
$id = $_GET['id'];
require_once '../../database/connect.php';

$sql =
    'UPDATE tb_requests SET doc_relat_status = "accept"  WHERE req_id  = "' .
    $id .
    '" ';
$result = mysqli_query($conn, $sql);

if ($result) {
    header('Location: ../approve_relation.php?success=true');
} else {
    header('Location: ../approve_relation.php?success=false');
}
?>

?>
