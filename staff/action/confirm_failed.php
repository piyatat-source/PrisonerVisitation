<?php

$id = $_GET['id'];
$note = $_GET['note'];

require_once '../../database/connect.php';
$sql =
    'UPDATE tb_visits SET vid_status = "failed" , vid_note = "' .
    $note .
    '"  WHERE vid  = "' .
    $id .
    '" ';
$result = mysqli_query($conn, $sql);

if ($result) {
    header('Location: ../index.php?success=true');
} else {
    header('Location: ../index.php?success=false');
}
?>

