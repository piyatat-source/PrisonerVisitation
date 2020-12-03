<?php
session_start();
if (!isset($_SESSION['Department'])) {
    header('Location: sign_in.php');
}
date_default_timezone_set('Asia/Bangkok');

if ($_GET) {
    $currentDate = $_GET['inputdatepicker'];
} else {
    $currentDate = '';
}

$numVisitorAll = 0;

$numVisitorFinished = 0;
$numVisitorFailed = 0;
$monthTH = [
    null,
    'มกราคม',
    'กุมภาพันธ์',
    'มีนาคม',
    'เมษายน',
    'พฤษภาคม',
    'มิถุนายน',
    'กรกฎาคม',
    'สิงหาคม',
    'กันยายน',
    'ตุลาคม',
    'พฤศจิกายน',
    'ธันวาคม',
];

$timeSet = [
    '09.00 - 09.15น.',
    '09.20 - 09.35น.',
    '09.40 - 09.55น.',
    '10.00 - 10.15น.',
    '10.20 - 10.35น.',
    '10.40 - 10.55น.',
    '11.00 - 11.15น.',
    '11.20 - 11.35น.',
    '11.40 - 11.55น.',
    '12.00 - 12.15น.',
    '12.20 - 12.35น.',
    '12.40 - 09.55น.',
    '13.00 - 13.15น.',
    '13.20 - 13.35น.',
    '13.40 - 13.55น.',
    '14.00 - 14.15น.',
    '14.20 - 14.35น.',
    '14.40 - 14.55น.',
];

$PriName = [];
$RelName = [];
$VID = [];
$StatusVID = [];
$RQCode = [];
$RQID = [];

function getTHdate($time)
{
    // 27-11-63
    global $dayTH, $monthTH;
    $thai_date_return = date('d', $time);
    $thai_date_return .= '/' . date('m', $time);
    $thai_date_return .= '/' . (date('Y', $time) + 543);
    return $thai_date_return;
}

function getFullTHdate($time)
{
    // 19 ธันวาคม 2556
    global $dayTH, $monthTH;
    $thai_date_return = date('j', $time);
    $thai_date_return .= ' ' . $monthTH[date('n', $time)];
    $thai_date_return .= ' ' . (date('Y', $time) + 543);
    return $thai_date_return;
}
//จำลองวันที่
// $currentDate = getTHdate(time());
$currentFullDate = getFullTHdate(time());

require_once '../database/connect.php';
$sql =
    'SELECT * FROM tb_visits LEFT JOIN tb_requests ON tb_visits.req_id = tb_requests.req_id ';
// "SELECT * FROM tb_visits LEFT JOIN tb_requests ON tb_visits.req_id = tb_requests.req_id WHERE tb_visits.vid_status = 'none'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['date_booking'] == $currentDate) {
        $PriName[$row['time_booking']] =
            $row['pri_firstname'] . '  ' . $row['pri_lastname'];
        $RelName[$row['time_booking']] =
            $row['req_pre'] .
            $row['req_firstname'] .
            '  ' .
            $row['req_lastname'];
        $VID[$row['time_booking']] = $row['vid'];
        $StatusVID[$row['time_booking']] = $row['vid_status'];
        $RQCode[$row['time_booking']] = $row['req_code'];
        $RQID[$row['time_booking']] = $row['req_id'];
        $numVisitorAll += 1;
    }
    if ($row['date_booking'] == $currentDate && $row['vid_status'] == 'none') {
    } elseif (
        $row['date_booking'] == $currentDate &&
        $row['vid_status'] == 'finished'
    ) {
        $numVisitorFinished += 1;
    } elseif (
        $row['date_booking'] == $currentDate &&
        $row['vid_status'] == 'failed'
    ) {
        $numVisitorFailed += 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ประวัติการเยี่ยมวันที่ <?php if ($_GET) {
      echo $_GET['inputdatepicker'];
  } ?></title>

  <!-- Calendar -->
  <link rel="stylesheet" href="src/css/vanilla-calendar.css">
  <script src="src/js/vanilla-calendar-min.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <style>
    .is-blurred {
      filter: brightness(80%);
      -webkit-filter: brightness(80%);
    }
   @media print {
       table td:last-child {display:none}
       table th:last-child {display:none}
   }
   </style>


</head>
<body style="font-family:'Kanit';" class="hold-transition sidebar-mini layout-fixed ">
<div id="myCalendar" class="vanilla-calendar"></div>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
    
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a style="text-align: center;" href="index3.html" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span  class="brand-text font-weight-light">เรือนจำจังหวัดกาฬสินธุ์</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/icon.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?php echo $_SESSION['Firstname'] .
              ' ' .
              $_SESSION['Lastname']; ?> </a>
        </div>
      </div>



     
      <nav class="mt-2"> 
        
      
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-header">รายการเยี่ยมประจำวัน</li>
            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon far fa-calendar-check"></i>
                <p>
                  รายการเยี่ยมประจำวัน
                </p>
              </a>
            </li>

            <li class="nav-header">จัดการบริการ</li>

            <?php if ($_SESSION['Department'] == 'visitRelative') { ?>
            
               <li class="nav-item">
                <a href="approve_rq.php" class="nav-link">
                  <i class="nav-icon fas fa-check"></i>
                  <p>
                    อนุมัติคำขอเยี่ยม
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="approve_jq.php" class="nav-link">
                  <i class="nav-icon fas fa-check-double"></i>
                  <p>
                    อนุมัติคำขอร่วมเยี่ยม
                  </p>
                </a>
              </li>

            <?php } ?>


            <?php if ($_SESSION['Department'] == 'relativeRegis') { ?>
              <li class="nav-item">
                <a href="approve_relation.php" class="nav-link">
                <i class="nav-icon fas fa-check"></i>
                  <p>
                    อนุมัติเอกสารญาติ
                  </p>
                </a>
              </li>

            <?php } ?>

            <?php if ($_SESSION['Department'] == 'prisonerRegis') { ?>


              <li class="nav-item">
                <a href="approve_prisoner.php" class="nav-link">
                <i class="nav-icon fas fa-check"></i>
                  <p>
                    อนุมัติผู้ต้องขัง
                  </p>
                </a>
              </li>

              <?php } ?>

              <!-- <li class="nav-item">
                <a href="date_manager.php" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    จัดการวันที่ปิดบริการ
                  </p>
                </a>
              </li> -->


          <li class="nav-header">ประวัติและการค้นหา</li>

          <?php if ($_SESSION['Department'] == 'visitRelative') { ?>

          <li class="nav-item">
            <a href="history_approve.php" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                ประวัติการอนุมัติ
              </p>
            </a>
          </li>

          <?php } ?>

          <li class="nav-item">
            <a href="history_visit.php" class="nav-link  active">
              <i class="nav-icon fas fa-history"></i>
              <p>
                ประวัติการเยี่ยม
              </p>
            </a>
          </li>
        
          

          <li class="nav-item">
            <a style="color:#f73144" href="sign_out.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                ออกจากระบบ
              </p>
            </a>
          </li>
         

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ประวัติการเยี่ยม </h1>
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>/.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php
// print_r($PriName);
// echo '<br>';
// print_r($RelName);
// echo '<br>';
// print_r($VID);
// echo '<br>';
// print_r($StatusVID);
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

      <div class="row">
    
            <div class="card-body" style="text-align:left">
              
            </div>  
       
      </div>

        <div class="row">
          <div class="col-12">
          <form>
                <div class="form-row align-items-center">
                  
                  <div class="col-auto">
                    <label class="sr-only" for="inlineFormInputGroup">Username</label>
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                      </div>
                      <input style="cursor:pointer;background:#fff" name="inputdatepicker" id="inputdatepicker"  class="datepicker form-control" data-date-format="mm/dd/yyyy" readonly="readonly" placeholder="" onchange="NO(this.value)">
                    </div>
                  </div>
                  <div class="col-auto">
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="btn btn-success mb-2">ค้นหา</button>
                  </div>
                </div>
             </form>
          </div>
        </div>

      <hr>
  
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $numVisitorAll; ?></h3>

                <p>รายการ</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">รายการเยี่ยมทั้งหมด</a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $numVisitorFinished; ?></h3>

                <p>รายการ</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <a href="#" class="small-box-footer">เยี่ยมสำเร็จ</a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $numVisitorFailed; ?></h3>
                <p>รายการ</p>
              </div>
              <div class="icon">
                <i class="fas fa-times-circle"></i>
              </div>
              <a href="#" class="small-box-footer">เยี่ยมไม่สำเร็จ</a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

       

        <div class="row">

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                
                <h3 class="card-title"><br>รายการเยี่ยมญาติ <?php if ($_GET) {
                    echo 'ของวันที่ ' . $_GET['inputdatepicker'];
                } ?><br><br></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <?php if ($_GET) { ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="3%">รอบที่</th>
                    <th width="15%">เวลา</th>
                    <th>ชื่อญาติ</th>
                    <th>ชื่อผู้ต้องขัง</th>
                    <th>ผลการเยี่ยม</th>
                    <th width="20%">ดูข้อมูลเพิ่มเติม</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php for ($i = 0; $i < 18; $i++) { ?>
                  
                  <tr style="text-align:center">
                    <td style="text-align:center"><?php echo $i + 1; ?></td>
                    <td ><?php echo $timeSet[$i]; ?></td>
                    <td><?php if (isset($RelName[$i])) {
                        echo $RelName[$i];
                        if (isset($RQCode[$i])) {
                            require_once '../database/connect.php';
                            $sqlgetJoinmember =
                                'SELECT * FROM tb_joinrequests WHERE req_code = "' .
                                $RQCode[$i] .
                                '" AND jreq_status = "accept" ';
                            $Joinmember = mysqli_query(
                                $conn,
                                $sqlgetJoinmember
                            );

                            while ($each = mysqli_fetch_assoc($Joinmember)) {
                                echo ',<br>' .
                                    $each['jreq_pre'] .
                                    $each['jreq_firstname'] .
                                    '  ' .
                                    $each['jreq_lastname'];
                            }
                        }
                    } else {
                        echo '-';
                    } ?></td>
                    <td><?php if (isset($PriName[$i])) {
                        echo $PriName[$i];
                    } else {
                        echo '-';
                    } ?></td>


                    <td>

                    <?php if (
                        isset($VID[$i]) &&
                        $StatusVID[$i] == 'finished'
                    ) { ?>
                          <b style="color:#28a745">✔ การเยี่ยมสำเร็จ</b>
                    <?php } elseif (
                        isset($VID[$i]) &&
                        $StatusVID[$i] == 'failed'
                    ) { ?>
                          <b style="color:#dc3545">✖ การเยี่ยมไม่สำเร็จ</b>
                    <?php } ?>

                    </td>



                    <td style="text-align:center">
                      <?php if (isset($VID[$i])) { ?> 
                        <button data-id="<?php echo $RQID[
                            $i
                        ]; ?>" class="btn btn-primary" href="#<?php echo $VID[
    $i
]; ?>">ข้อมูลเพิ่มเติม</button> 
                      <?php } ?>
                    </td>
                  </tr>
                  <?php } ?>
               
                  </tbody>
                 
                </table>
              </div>
<?php } ?>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
    
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div class="container">
   <div class="modal fade" id='requestInfo' role='dialog'>
     <div class="modal-dialog modal-lg">

          <div class="modal-content">
            <div class="modal-header">
                <h4 class="col-12 modal-title text-center">ข้อมูลรายละเอียด</h4>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <div class="modal-body"></div>
            <!-- <div class="modal-footer">
            
            </div> -->
       </div>
       </div>
   </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    เรือนจำจังหวัดกาฬสินธุ์ 2020 
   
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>

<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- SweetAlert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">


// $(document).ready(function () {
//   $(".datepicker")
//     .datepicker({
//       daysOfWeekDisabled: [0, 6],
//       format: "dd/mm/yyyy",
//       todayBtn: false,
//       language: "th", //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
//       thaiyear: true,
//       autoclose: true,
//       startDate: new Date(), //Set เป็นปี พ.ศ.
//       // startDate: "+5d", //Set เป็นปี พ.ศ.
//     })
//     .datepicker(); //กำหนดเป็นวันปัจุบัน
    
// });

//   ConfirmVisited = (pname,vid) =>{
//     Swal.fire({
//   title: 'ยืนยันหรือไม่',
//   text: 'การเข้าเยี่ยม  \''+pname+'\'  เสร็จสมบูรณ์',
//   icon: 'question',
//   showCancelButton: false,
//   confirmButtonColor: '#28a745',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'ยืนยันการเยี่ยมเสร็จสิ้น'
// }).then((result) => {
//   if (result.isConfirmed) {
//     window.location.href = 'action/confirm_vistited.php?id='+vid;
//   }
// })
// }

// ConfirmFailed = (pname,vid) =>{
//   Swal.fire({
//   icon: 'warning',
//   title: 'การเยี่ยมไม่สำเร็จ',
//   input: 'textarea',
//   text: 'การเข้าเยี่ยม  \''+pname+'\'  ไม่เสร็จสมบูรณ์',
//   inputPlaceholder: 'สาเหตุการเยี่ยมไม่สำเร็จ...',
//   confirmButtonColor: '#bd2130',
//   confirmButtonText: 'ยืนยันการเยี่ยมไม่สำเร็จ',

//   showCancelButton: false
// }).then((result) => {
//   if (result.value) {
//     window.location.href = 'action/confirm_failed.php?id='+vid+'&note='+result.value;
//     }
// })
// }


</script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "paging": false,
      "responsive": true,
      "buttons": ["print","excel"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": false,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
  });
  </script> 
  <script type="text/javascript">
  $().ready(function(){
    $('.btn-primary').click(function(){
      var reqid =$(this).data('id');
        $.ajax({
          url:'async/loadinfo_visit.php',
          type:'post',
          data:{reqid:reqid},
          success: function(response){
              $('.modal-body').html(response);
              $('#requestInfo').modal('show');
          }
        })
    })
  })
  
  ;
  </script>
  <script>
            let calendar = new VanillaCalendar({
                selector: "#myCalendar",
                months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
                shortWeekday: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                onSelect: (data) => {
                    var date = moment(new Date(data.date.substr(0, 16)));
                    var selectedDate = date.format("DD/MM/YYYY");
                    var array = selectedDate.split("/");
                    var newDate = array[0]+"/"+array[1]+"/"+(eval(array[2])+543);
                    document.getElementById("inputdatepicker").value = newDate;
                    document.getElementById("myCalendar").style.display = "none";
                    $('.wrapper').removeClass('is-blurred');

                }
            })

            $(document).ready(function() {
            $("#inputdatepicker").click(function(event) {
              $('.wrapper').addClass('is-blurred');
              document.getElementById("myCalendar").style.display = "block";
            });
            });
            
            
  </script>
</body>
</html>
