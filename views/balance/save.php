<?php
    include('../../model/userModel.php');
    $user = new User();
    
    if(isset($_POST['username'],$_POST['password']))
    {
        $received = $user->save($_POST['username'],$_POST['password']);
        if($received == 1)echo '1';   
    }
?>


