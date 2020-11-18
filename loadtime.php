

<?php
$date = $_GET['date'];

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
$timeLoad = [];

$con = mysqli_connect('localhost', 'root', '', 'prisoner');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con, 'prisoner');
$sql = " SELECT * FROM tb_datecloses WHERE dateClose = '" . $date . "' ";
$result = mysqli_query($con, $sql);

// echo $date;
while ($row = mysqli_fetch_array($result)) {
    array_push($timeLoad, $row['timeClose']);
}
// print_r($timeLoad);
// echo count($timeLoad);

for ($x = 0; $x < 18; $x++) {
    echo "<div class=\"time\">";
    echo "<input type=\"radio\" id=\"timepicker" .
        ($x + 1) .
        "\" name=\"timepicker\" value=\"" .
        ($x + 1) .
        "\"";
    for ($y = 0; $y < count($timeLoad); $y++) {
        if ($x + 1 == $timeLoad[$y]) {
            echo 'disabled';
        } else {
            echo '';
        }
    }
    echo '>';
    echo "<label for=\"timepicker" . ($x + 1) . "\">";
    echo "<div class=\"time-name\">รอบที่ " . ($x + 1) . '</div>';
    echo '<p>' . $timeSet[$x] . '</p>';
    echo '</label>';
    echo ' </div>';
}

mysqli_close($con);


?>
