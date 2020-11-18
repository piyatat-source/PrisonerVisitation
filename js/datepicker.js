$(document).ready(function () {
  $(".datepicker")
    .datepicker({
      daysOfWeekDisabled: [0, 6],
      format: "dd/mm/yyyy",
      todayBtn: false,
      language: "th", //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true,
      autoclose: true,
      startDate: dateAdd(), //Set เป็นปี พ.ศ.
    })
    .datepicker(); //กำหนดเป็นวันปัจุบัน
});

function LoadTime(date) {
  // $('#inputdatepicker').datepicker('hide');
  // alert("คุณเลือก "+date);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("box-time").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "loadtime.php?date=" + date, true);
  xmlhttp.onloadstart = function () {
    document.getElementById("box-time").innerHTML =
      '<i class="fas fa-spinner fa-pulse"></i>';
  };
  xmlhttp.send();
}

// CheckDate
// console.log(dateAdd())

function dateAdd() {
  var dateObj = new Date();
  var weekdayNumber = dateObj.getDay();

  switch (weekdayNumber) {
    case 0:
      return "+2d";
      break;
    case 1:
      return "+3d";
      break;
    case 2:
      return "+3d";
      break;
    case 3:
      return "+3d";
      break;
    case 4:
      return "+4d";
      break;
    case 5:
      return "+4d";
      break;
    case 6:
      return "+3d";
      break;
    default:
      return "0";
  }
}
