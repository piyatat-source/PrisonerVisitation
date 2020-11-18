
function CheckRequest(){
   
    // return SweetAlert("Hello","success");

    var pre = document.getElementById("pre").value;
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var telnumber = document.getElementById("telnumber").value;
    var idnumber = document.getElementById("idnumber").value;
    var idline = document.getElementById("idline").value;
    var relation = document.getElementById("relation").value
    var idpic = document.getElementById("idpic").files.length;
    var prifirstname = document.getElementById("prifirstname").value;
    var prilastname = document.getElementById("prilastname").value;
    var priidnum = document.getElementById("priidnum").value;
    var inputdatepicker =  document.getElementById("inputdatepicker").value;
 
    // console.log(pre);
    // console.log(firstname);
    // console.log(lastname);
    // console.log(telnumber);
    // console.log(idnumber);
    // console.log(idline);
    // console.log(relation);
    // console.log(idpic);
    // console.log(prifirstname);
    // console.log(prilastname);
    // console.log(priidnum);
    // console.log(inputdatepicker);
  

    if(pre==""||firstname==""||lastname==""||telnumber==""||idnumber==""||idline==""||relation==""||idpic==0||prifirstname==""||prilastname==""||priidnum==""||inputdatepicker==""){
        SweetAlert("กรุณากรอกข้อมูลให้ครบ","warning");

    }else{
        try {
            var timepicker = document.querySelector('input[name="timepicker"]:checked').value;
            console.log(timepicker);
            
            Swal.fire({
              title: 'กรุณารอสักครู่',
              html: 'กำลังบันทึกข้อมูล',
              allowOutsideClick: false,
              onBeforeOpen: () => {
                  Swal.showLoading()
              },
            });
            setTimeout(function(){
              swal.close();
              document.getElementById("addReq").submit();
            },3000);
            
          }
          catch(err) {
            SweetAlert("กรุณากรอกข้อมูลให้ครบ","warning");
          }
        
        
    }
        
}


function CheckToJoin(){
  var code = document.getElementById('reqcode').value;

  if(code!=""&&code.length==10){
    Swal.fire({
      title: 'กรุณารอสักครู่',
      html: 'กำลังตรวจสอบ',
      allowOutsideClick: false,
      onBeforeOpen: () => {
          Swal.showLoading()
      },
    });
    setTimeout(function(){
      swal.close();
      document.getElementById("ChecktoJoin").submit();
    },3000);
    
  }
  else{
    SweetAlert("กรุณากรอกหมายเลขให้ถูกต้อง","warning")
  }
  


}

