<?php session_start();
if(!isset($_SESSION["username"])){ header("location:../../views/auth/"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport"  http-equiv="Content-Type" content="width=device-width, initial-scale=1">
  <title>Clinic</title>
  
  <link rel="icon" href="../../dist/img/AdminLTELogo.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <script src="https://kit.fontawesome.com/930a17464c.js" crossorigin="anonymous"></script>
   <!-- MY CSS -->
   <link rel="stylesheet" href="../../dist/css/style.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <?php include("../../include/loader.php"); ?>

  <!-- Navbar -->
  <?php include("../../include/navbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("../../include/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
       
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h1 class="text-success text-center">Users</h1>
        <button class="btn btn-success rounded-10 mb-2" onclick="openAddModal()"><i class="bi bi-plus-square-fill"></i>Add User</button>

        <!-- DATA TABLE -->
            <div id="userFetch"></div>
        <!-- END DATA TABLE -->

        <!-- MODALS -->
        <?php include('../../modals/userModal.php'); ?>
        <!-- END MODALS -->
        
       


      </div>
    </section>
    <!-- /.content -->
  </div>


  <!-- /.content-wrapper -->
  <?php include("../../include/footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- Sweet Alert -->
<script src="../../dist/sweetalert/sweetalert_library.js"></script>
<script src="../../dist/sweetalert/sweet_alert.js"></script>

<script>
 jQuery('#userFetch').load('fetch.php', 'f' + (Math.random()*100000));
</script>

<script>


  $('#addShowPass').on('click', function(){
      $(this).toggleClass("fa-eye fa-eye-slash");
      var passInput=$("#addPassword");
      if(passInput.attr('type')==='password')
        {
          passInput.attr('type','text');
      }else{
         passInput.attr('type','password');
      }
  })

  $('#updateShowPass').on('click', function(){
      $(this).toggleClass("fa-eye fa-eye-slash");
      var passInput=$("#newPassword");
      if(passInput.attr('type')==='password')
        {
          passInput.attr('type','text');
      }else{
         passInput.attr('type','password');
      }
  })

  var addModal = document.getElementById("addModal");
  function openAddModal()
  {
    addModal.style.display = "block";
  }

  $(document).on("click", "#addUser", function() { 
  if($('#addPassword').val() =="" || $('#addConfirmPassword').val() == "" ||  $('#addUsername').val() =="")
  {
    warningfunction('Please fill up all required Field!');
    return false;   
  }
  
  $.ajax({
      url: "checkExist.php",
      type: "POST",
      cache: false,
      data:{
        username: $('#addUsername').val(),
      },
      success: function(userCheckData){
          if(userCheckData == 1)
          {
            warningfunction('Already exist!');
            return false;   
          }
          else{
            if($('#addPassword').val() != $('#addConfirmPassword').val())
            {
              warningfunction('Password and Confirm password does not match!');
              $('#addPassword').val("");
              $('#addConfirmPassword').val("");
              return false;   
            }
            
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success m-1 ',
                cancelButton: 'btn btn-danger '
            },
            buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "you want to add this data?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel   ',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "save.php",
                    type: "POST",
                    cache: false,
                    data:{
                      username: $('#addUsername').val(),
                      password: $('#addPassword').val(),
                    },
                    success: function(data){  
                        if(data == 1)
                        {
                            success('Data Added successfully!');
                            addModal.style.display = "none";
                            jQuery('#userFetch').load('fetch.php', 'f' + (Math.random()*100000));

                        }
                        else{
                            alert(data);
                            errorfunction('Data Adding Failed!');
                        }
                    }
                });
            }   
              else if (result.dismiss === Swal.DismissReason.cancel){}
              })        
          }
      }
  });   	
});



var updateModal = document.getElementById("updateModal");
function openUpdateModal(id,username)
{
  updateModal.style.display = "block";
  document.getElementById("userId").value=id;
  document.getElementById("updateUsername").value=username;

}

$(document).on("click", "#changePassword", function() { 
  if($('#newPassword').val() == "" || $('#confirmPassword').val() == "")
  {
    warningfunction('Please fill up all required field!');
    return false;
  }

  if($('#newPassword').val() != $('#confirmPassword').val())
  {
    $('#newPassword').val("");
    $('#confirmPassword').val("");
    warningfunction('Password and confirm password does not match!');
    return false;
  }


  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
      confirmButton: 'btn btn-success m-1 ',
      cancelButton: 'btn btn-danger '
  },
  buttonsStyling: false
  })
  swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "you want to update this data?",
  icon: 'question',
  showCancelButton: true,
  confirmButtonText: 'Confirm',
  cancelButtonText: 'Cancel   ',
  reverseButtons: true
  }).then((result) => {
  if (result.isConfirmed) {
      $.ajax({
          url: "update.php",
          type: "POST",
          cache: false,
          data:{
            id: $('#userId').val(),
            newPassword: $('#newPassword').val()
          },
          success: function(data){

              if(data == 1)
              {
                  success('Data updated successfully!');
                  updateModal.style.display = "none";
                  jQuery('#Fetch').load('fetch.php', 'f' + (Math.random()*100000));
              }
              else{
                  alert(data);
                  errorfunction('Data Updating Failed!');
              }
          }
      });
  }   
  else if (result.dismiss === Swal.DismissReason.cancel){}
  })    	
});
   	
// When the user clicks button close
function closebtn() 
{
    addModal.style.display = "none";
    updateModal.style.display = "none";
}   
</script>

</body>
</html>
