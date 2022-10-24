<?php
    
    include('../../model/userModel.php');
    $user = new User();

    $pass =$_POST['newPassword'];
      
    if(isset($_POST['newPassword'],$_POST['id']))
    {
        $received = $user->update($_POST['id'],$_POST['newPassword']);
        if($received == 1)echo '1';   
        exit();
    }
    else{
        echo "alert($pass)";
        exit();
    }

?>
