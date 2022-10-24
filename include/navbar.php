
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       <li class="nav-item dropdown bg-gray-light">
        <a class="nav-link rounded border  border-success p-2 text-success" data-toggle="dropdown" href="#">
          <i class="fas fa-user-circle"></i><b><?php echo $_SESSION["username"];?>  </b>    <i class="fas fa-chevron-circle-down"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-m dropdown-menu-right  border-success p-2 ">
          <a href="../../views/auth/logout.php" class="dropdown-item text-success" >
            <i class="fas fa-sign-out-alt "></i> Sign out
            
          </a>  
        </div>
      </li>
    <ul>
  </nav>

  <script>
    

  </script>
  