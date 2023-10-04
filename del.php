<?php
include("asstes/db.php") ;

if(isset($_SESSION['user'])){
    $email=$_SESSION['user']['email'] ;
    $delpactuer=mysqli_query($con,"SELECT *FROM users WHERE email='$email'") ;
    $delpactuer_fetch=mysqli_fetch_assoc($delpactuer) ;
    $pactuer=$delpactuer_fetch['pactuer'] ;
  


$del=mysqli_query($con,"DELETE FROM users WHERE email='$email'") ;

if($del){
    unlink($pactuer);
session_destroy() ;
header("location:index.php") ;
}
}else{header("location:login.php") ;}


?>