
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport"  http-equiv="Content-Type" content="width=device-width, initial-scale=1">
  <title>BALANCE RESET</title>
  
  <link rel="icon" href="../../dist/img/AdminLTELogo.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
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

  



    <!-- Main content -->
<section class="content">
  <div class="container mt-2">
    <div class="card border border-success" >
      <div class="card-header bg-green"><h1 class="text-center ">BALANCE RESET</h1></div>
      <div class="card-body">
        <input type="search" class="form-control" id="filters" placeholder="ENTER STUDENT NUMBER">

        <div id="balanceFetch"></div>

      </div>
    </div>
    
  </div>
</section>






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

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- Sweet Alert -->
<script src="../../dist/sweetalert/sweetalert_library.js"></script>
<script src="../../dist/sweetalert/sweet_alert.js"></script>

<script>
 jQuery('#balanceFetch').load('fetch.php', 'f' + (Math.random()*100000));
</script>

<script>


$(document).ready(function(){
	$('#filters').on('input',function(e){
		var rec=$('#filters').val();
    if( !$(this).val() ) {
      $('#balanceFetch').html("<div class='card mt-2 border border-dark'><div class='card-body text-center'><img src='../../dist/img/search/search.png' width='200' height='200'><h1 class='text-success'><b>Search to display Data</b></h1></div></div>");        
    }


    else{
      $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{studentNumber:rec},
        dataType:"text",
        beforeSend: function() {
        $('#balanceFetch').html("<div class='card mt-2'><div class='card-body text-center'><h5>Loading new data . . . .</h5></div></div>");},
        success:function(data) 
        {
          $('#balanceFetch').html(data);
        }
		  });
    }
    
    
	});
});


 function clearBalance(studentnumber,syear,semester,balance)
 {
 
   $.ajax({
        url: "balanceValidation.php",
        type: "POST",
        cache: false,
        data:{
          studentNumber: studentnumber,
          syear: syear,
          semester: semester,
          balance: balance,
        },
        success: function(data){
            if(data == 0)
            {
              const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                  confirmButton: 'btn btn-success m-1 ',
                  cancelButton: 'btn btn-danger '
              },
              buttonsStyling: false
              })
              swalWithBootstrapButtons.fire({
              title: 'Are you sure?',
              text: "you want to clear this student data?",
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
                      studentNumber: studentnumber,
                      syear: syear,
                      semester: semester,
                    },
                    success: function(data){
                        if(data == 1)
                        {
                            success('Balance cleared successfully!');
                            $('#filters').val('');
                            $('#filters').focus();
                            $('#balanceFetch').html("<div class='card mt-2 border border-dark'><div class='card-body text-center'><img src='../../dist/img/search/search.png' width='200' height='200'><h1 class='text-success'><b>Search to display Data</b></h1></div></div>");        
                          
                         }
                        else{
                            alert(data);
                            errorfunction('Data Updating Failed!');
                        }
                    }
                });
                 
              }   
              else if (result.dismiss === Swal.DismissReason.cancel){}
              });    	
            
            
            }
            else
            {
              warningfunction(data);
              // $('#balanceFetch').html("<div class='card mt-2 border border-dark'><div class='card-body text-center'><img src='../../dist/img/search/search.png' width='200' height='200'><h1 class='text-success'><b>Search to display Data</b></h1></div></div>");
              // $('#filters').val('');
              // $('#filters').focus();
             }
        }
    });
 }
</script>
</body>
</html>


