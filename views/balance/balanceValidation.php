
<?php
    include('../../model/balanceModel.php');
    $balance = new balance();
    
    if(isset($_POST['studentNumber'],$_POST['syear'],$_POST['semester']))
    {
        $checkBalance = $balance->balanceValidation($_POST['studentNumber'],$_POST['syear'],$_POST['semester'],$_POST['balance']);
        
        if($checkBalance == 1)echo 'ALREADY ASSEST FOR THIS SEMESTER!'; 
        else if($checkBalance == 2)echo 'BALANCE ALREADY CLEAR!'; 
        else if($checkBalance == 3)echo 'NO SCHOLARSHIP, PLEASE PAY THE REMAINING BALANCE!'; 
        else{
            echo $checkBalance;
        }
      
    }
   
    
?>

