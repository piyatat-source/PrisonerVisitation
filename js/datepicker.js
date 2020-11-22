$(document).ready(function () {
  $(".datepicker")
    .datepicker({
      // daysOfWeekDisabled: [0, 6],
      format: "dd/mm/yyyy",
      todayBtn: false,
      language: "th", //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true,
      autoclose: true,
      startDate: dateAdd(), //Set เป็นปี พ.ศ.
      // startDate: "+5d", //Set เป็นปี พ.ศ.
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
  var arrayOfWeekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
  var dateObj = new Date()
  // dateObj.setDate(26)
  var weekdayNumber = dateObj.getDay()
  var weekdayName = arrayOfWeekdays[weekdayNumber]
  switch (weekdayName) {
    
    case "Sunday":
      //วันอาทิตย์
      return "+2d";
      break;
    
    case "Monday":
      //วันจันทร์
      return "+2d";
      break;
    
    case "Tuesday":
      //วันอังคาร
      return "+2d";
      break;
    
    case "Wednesday":
      //วันพุธ
      return "+2d";
      break;
    
    case "Thursday":
      //วันพฤหัส
      return "+4d";
      break;
    
    case "Friday":
      //วันศุกร์
      return "+4d";
      break;
     
    case "Saturday": 
      //วันเสาร์
      return "+3d";
      break;
    default:
      return "";
  }
}
