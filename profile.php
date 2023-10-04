<?php
include("asstes/db.php") ;
if(!$_SESSION['user']){header("location:login.php");}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['user']['name'] ?></title>
    <!-- <link rel="stylesheet" href="./assest/css/cdn.jsdelivr.net_npm_bootstrap@5.2.3_dist_css_bootstrap.min.css"> -->
    <link rel='stylesheet' type='text/css' href='asstes/style/bootstrap.min.css'>


    <style> 
body{background:rgba(218, 165, 32, 0.089)}
h1{margin-top:50px}
</style>
</head>
<body>


   
<nav class="navbar navbar-expand-lg navbar-light bg-secandry">
  <div class="container-fluid">
    
  <a class="btn btn-warning" href="index.php" style="margin-left: 10%;">GO TO CHAT</a>
    <a class="navbar-brand btn btn-success" href="logout.php" style="margin-right: 10%;">LOGOUT</a>   

</div>
  </div>
</nav>
<div class="container"style='text-align:center ;margin-top:150px'>




<!-- ********************************* -->

<?php


if(isset($_SESSION['user'])){
$email=$_SESSION['user']['email'] ;
$search=mysqli_fetch_assoc(mysqli_query($con,"SELECT *FROM users WHERE email= '$email'")) ;
$search_photo=$search['pactuer'];
$search_name=$search['name'] ;
$search_email=$search['email'] ;

    echo "
    <img src='$search_photo' width='250' height='250px' style='border:5px inset black ; border-radius:130px'>  " ;
    echo "<i> <h1>"."Name: " .$search_name ."</h1></i>" ."<br>";
    echo "<i> <h1>"."Email: " .$search_email ."</h1></i>" ."<br>";
   
   
   }
?>
<a href='edit.php' class='btn btn-success'> EDIT </a>
</div>   
<a href="del.php" class="btn btn-outline-danger" onclick="return confirm('Are you sure to delete the e-mail?');">DELETE ACCOUNT</a>


</body>
</html>