function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

  for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
  }
};

var status = getUrlParameter('typeErr')
$(document).ready(function() {
  if(status=="true"){
    Swal.fire({
        position: "center",
        icon: "error",
        title: "ไฟล์ภาพผิดพลาด",
        text: "ภาพต้องเป็นไฟล์ .jpg .png และขนาดไม่เกิน 2MB",
        showConfirmButton: false,
        timer: 5000,
    });
  }else{

  }
});


function SweetAlert(text,type) {
    Swal.fire({
      position: "center",
      icon: type,
      title: text,
      showConfirmButton: false,
      timer: 3000,
    });
  }