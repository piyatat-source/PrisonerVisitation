<?php
$id_date;
$id = $_GET['id'];
require_once '../../database/connect.php';

$sql =
    'UPDATE tb_joinrequests SET doc_relat_status = "deny"  WHERE jreq_id  = "' .
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
