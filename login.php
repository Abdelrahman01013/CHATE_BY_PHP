<?php

include("asstes/db.php") ;
// لو عامل تسجيل دخول
if(isset($_SESSION['user'])){
    header("location:index.php") ;
    exit() ;}

if(isset($_POST['submit'])){

   
    $email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password=filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);



   

    $error=[] ;
  
   //check Email
    if(empty($email)){
        $error[]= "Enter Email" ;
    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
        $error[]="The Email Is Not Valid" ;} ;

        //check Password
    if(empty($password)){$error[]= "PLZ Enter Password" ;}
    

    // search Email in database

    if(empty($error)){
        $search="SELECT * FROM users WHERE email='$email'" ;

$search_db=mysqli_query($con,$search) ;
$date=mysqli_fetch_assoc($search_db) ;
// $count=mysqli_num_rows($search_db) ;
        if(!$date){
            $error[]= "Verify your email and password" ;
            } else {

            // check password in database

            $password_hash=$date['password'] ; // password in database 
            if(!password_verify($password,$password_hash)){    //مقارنه 
           $error[]="Verify your email and password" ;
            }else{ $_SESSION['user']=['name'=>$date['name'] ,'email'=>$date['email']]; 
            header('location:index.php') ;}
}
         
} 

} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link type='text/css' rel='stylesheet' href='asstes/style/bootstrap.min.css'>

    <title>Login - CHAT</title>
    <style> 
    .btn-color{
  background-color: #0e1c36;
  color: #fff;
  
}

.profile-image-pic{
  height: 200px;
  width: 200px;
  object-fit: cover;
}



.cardbody-color{
  background-color: #ebf2fa;
}

a{
  text-decoration: none;
}
    </style>
    
</head>
<body>

    <div class="row">
      <div class="col-md-6 offset-md-3">
       
        <div class="card my-5">

          <form class="card-body cardbody-color p-lg-5" method="POST">

            <div class="text-center">
              <img src="https://cdn6.aptoide.com/imgs/0/3/9/039f963d266cbde60e943d76632cc121_icon.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-6"
                width="200px" alt="profile">
           
              </div>
              <div class="text-center">

                <p class="text-primary">LOGIN CHAT</p>
              </div>

            <div class="mb-3">
              <input  class="form-control" id="Username" aria-describedby="emailHelp"
                placeholder="User Name" type='email' name='email'  value="<?php if(isset($_POST['email'])){echo $_POST['email'] ;} ?>">
            <p class="text-danger"><?php if(isset($error_email)){echo $error_email ;} ?></p>
            </div>
           
            <div class="mb-3">
              <input type='password' name='password'  class="form-control" id="password" placeholder="password">
              <p class="text-danger"><?php if(isset($error_pass)){echo $error_pass ;} ?></p>
            </div>
            <?php 
           if(!empty($error)){
            foreach($error as $e){echo ' <p class="text-danger">' .$e .'</p>' ."<br>" ; }
           }
           
           ?>
            <div class="text-center">
            <input type='submit' name='submit' value='Login' class="btn btn-color px-5 mb-5 w-100"><br>
                <!-- <button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button> -->
            
            </div>
       
            
            <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
              Registered? <a href='register.php' class="text-dark fw-bold"> Create an
                Account</a>
                <br> <br>
                <p class="text-danger"><?php if(isset($error_email)){echo $error_email ;} ?></p>
                
            </div>
          
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>