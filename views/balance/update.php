<?php
    date_default_timezone_set('Asia/Manila');
    include('../../model/balanceModel.php');
    $balance = new balance();
    
    $timeStamp=date_create()->format("Y-m-d H:i:s.v");

 
      
    if(isset($_POST['studentNumber'],$_POST['syear'],$_POST['semester']))
    {
        $received = $balance->update($_POST['studentNumber'],$_POST['syear'],$_POST['semester'],$timeStamp);
        if($received == 1)echo '1';   
        exit();
    }
    else{
        echo "alert('error')";
        exit();
    }

?>
