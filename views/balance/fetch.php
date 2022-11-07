<?php
    include('../../model/balanceModel.php');
    if(!isset($_POST['studentNumber']))
    {
        echo "<div class='card mt-2 border border-dark'><div class='card-body text-center'><img src='../../dist/img/search/search.png' width='200' height='200'><h1 class='text-success'><b>Search to display Data</b></h1></div></div>";
    }
    else{
        $balance = new Balance();
        $studentNumber = $_POST['studentNumber'];
        $datas = $balance->fetch($studentNumber);
        if($datas == null) echo "<div class='card mt-2 border border-dark'><div class='card-body text-center'><img src='../../dist/img/search/nodataFound.png' width='200' height='200'><h1 class='text-success'><b>No results found</b></h1><p>We couldn't find what your searched for.<br>Try searching again.</p></div></div>";  
        foreach( $datas as $data)
        {
        ?>
            <div class="card mt-2 border border-dark">
            <div class="card-body">
                <div class="row">
                <div class="col-md-4">
                    <span class="text-success">Student Number</span>
                    <h3 class="warning"><?php echo $data['studnumber']; ?></h3>
                </div>
                <div class="col-md-4">
                    <span class="text-success">School Year</span>
                    <h3 class="warning"><?php echo $data['syear']; ?></h3>
                </div>
                <div class="col-md-4">
                    <span class="text-success">Semester </span>
                    <h3 class="warning"><?php echo $data['semester']; ?></h3>
                </div>
                <div class="col-md-12">
                    <div class="text-center">
                    <hr>
                    <span class="text-success">Balance </span>
                    <h3 class="warning"><?php echo $data['balance']; ?></h3>
                    <hr>
                    <button class="btn btn-success w-100" 
                    onclick="clearBalance(`<?php echo $data['studnumber']; ?>`,`<?php echo $data['syear']; ?>`,`<?php echo $data['semester']; ?>`,`<?php echo $data['balance']; ?>`)" >CLEAR</button>
                    </div>  
                </div>
                </div>
            </div>
            </div>
        <?php
        }
    }
    
?>    



