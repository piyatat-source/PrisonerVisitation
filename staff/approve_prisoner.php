<?php
session_start();
if (!isset($_SESSION['Department'])) {
    header('Location: sign_in.php');
}
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

$wait = 0;

require_once '../database/connect.php';
$sql = 'SELECT * FROM tb_requests Where doc_pri_status = "none"';
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $wait += 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prisoner Visitor</title>

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
</head>
<body style="font-family:'Kanit';" class="hold-transition sidebar-mini layout-fixed">
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
                <a href="approve_prisoner.php" class="nav-link  active">
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
            <a href="history_visit.php" class="nav-link">
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
            <h1 class="m-0">อนุมัติผู้ต้องขัง</h1>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $wait; ?></h3>

                <p>รายการ</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-clock"></i>
              </div>
              <a href="#" class="small-box-footer">รอตรวจสอบข้อมูล</a>
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
                <h3 class="card-title">รายการรอตรวจสอบข้อมูลผู้ต้องขังทั้งหมด</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>หมายเลขคำขอ</th>
                    <th>ชื่อผู้ต้องขัง</th>
                    <th>เลขประจำตัวประชาชน</th>
                 
                    <th>ตรวจสอบ & อนุมัติ</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                      $index = 1;
                      require_once '../database/connect.php';
                      $sql =
                          'SELECT * FROM tb_requests Where doc_pri_status = "none"';
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_array($result)) { ?>
                  <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['req_code']; ?></td>
                    <td><?php echo $row['pri_firstname'] .
                        ' ' .
                        $row['pri_lastname']; ?></td>
                    <td><?php echo $row['pri_id_num']; ?></td>


                  
                    
                    <td style="text-align:center"><?php echo '<button data-id="' .
                        $row['req_id'] .
                        '" class="btn btn-info chpri">ตรวจสอบ</button>'; ?></td>

                      <?php }
                      ?>
             
                 
                  </tbody>
                 
                </table>
              </div>
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
                <h4 class="col-12 modal-title text-center">ยืนยันการอนุมัติผู้ต้องขัง</h4>
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

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "responsive": true,
      
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
    $('.chpri').click(function(){
      var reqid =$(this).data('id');
        $.ajax({
          url:'async/loadinfo_pri_check.php',
          type:'post',
          data:{reqid:reqid},
          success: function(response){
              $('.modal-body').html(response);
              $('#requestInfo').modal('show');
          }
        })
    })
  });

</script>
</body>
</html>
