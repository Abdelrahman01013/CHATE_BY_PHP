<?php
include("asstes/db.php") ; ;

// لو عامل تسجيل دخول
if(isset($_SESSION['user'])){
    header("location:index.php") ;
    exit() ;}

if(isset($_POST['submit'])){
  

    $name=filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password=filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $repet=$_POST['repet'] ;



    ///validat

    $error=[] ;
    //check name
    if(empty($name)){
        $error[]= "PLZ Enter Name";
    }elseif(strlen($name)>100)
    {$error[]= "The name must not exceed 100 characters" ;}
   

    //check Email
    if(empty($email)){
        $error[]= "PLZ Enter Email" ;
    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
        $error[]="The Email Is Not Valid" ;
    } ;

   // البحث عن الاميل في قاعده البينات

    $search="SELECT email FROM users WHERE email='$email'" ;

    $qsearch= mysqli_query($con,$search) ;
   
    $date =mysqli_num_rows($qsearch) ;

    if($date){$error[]="This Email Already Exists" ;}

    // check password
    if(empty($password)){$error[]= "PLZ Enter Password" ;}
    elseif(strlen($password)<=5 || strlen($password)>=20)
    {$error[]="Password must not be more than 20 and not less than 5 from numbers" ;}
// else {
//     $pass_hash=password_hash($password,PASSWORD_DEFAULT);  ==> NEW 
// }
if(empty($repet)){ $error[]="Password mismatch" ;}
   
    if(empty($error)){
    $password=password_hash($password,PASSWORD_DEFAULT) ;
    $insert="INSERT INTO users(name,email,password) VALUES('$name','$email' ,'$password')" ;  
    mysqli_query($con,$insert) ;
    $_POST['name']='' ;
    $_POST['email']='' ;

    $_SESSION['user']=["name"=>$name ,"email"=>$email ] ;
    header("location:index.php") ;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <title>Document</title>
    <link type='text/css' rel='stylesheet' href='asstes/style/bootstrap.min.css'>
    
</head>
<body>

    <form method="POST" action='register.php'>


<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

               

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control"
                      name='name' placeholder='Name'  value="<?php if(isset($_POST['name'])){echo $_POST['name'] ;} ?>" />
                      <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control"
                      name='email' placeholder='Email'  value="<?php if(isset($_POST['email'])){echo $_POST['email'] ;} ?>"
                      />
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" 
                      name='password' placeholder='Password'/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" name="repet" />
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                  </div>

                 
                  <?php 
               if(!empty($error)){
                foreach($error as $er){
                echo "<p class='text-danger'>" .$er ."</p>" ;
                }
               }
               ?>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button class="btn btn-primary btn-lg"
                    type='submit' name='submit'>Register</button>
                  </div>

                </form>
                


            

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://www.emojiall.com/en/svg-to-png/blobmoji/640/emoji_u1f425.png"
                  class="img-fluid" alt="Students">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>