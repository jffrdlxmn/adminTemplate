<?php session_start();
if(!isset($_SESSION["username"])){ header("location:views/auth/"); }
else if(($_SESSION["type"]) !='admin'){ header("location:views/main/");}
?>