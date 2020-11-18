<?php 
    $conn = @mysqli_connect("localhost", "root", "", "prisoner") or die(mysqli_connect_error());
    mysqli_set_charset($conn,"utf8");
?>
