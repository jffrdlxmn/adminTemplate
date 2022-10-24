
<?php
    include('../../model/userModel.php');
    $user = new User();
    
    if(isset($_POST['username']))
    {
        $checkDulplicate = $user->checkExist($_POST['username']);
        if($checkDulplicate == 1)echo '1';   
    }
?>

