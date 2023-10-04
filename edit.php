<?php
include("asstes/db.php") ;

if(isset($_SESSION['user'])){
$email=$_SESSION['user']['email'] ;
$serchs="SELECT *FROM users WHERE email ='$email'" ;
$serch=mysqli_fetch_assoc(mysqli_query($con,$serchs)) ;
$old_pactuer=$serch['name'];
$new_location=$serch['pactuer'] ;


}else{
    header("location:index.php");
}





if(isset($_POST['submit'])){
 $name=$_POST['name'] ;
 



if(!empty($_FILES['img']['name'])){
    $rimg =$_FILES['img'] ;

    $file_name=time() .$_FILES['img']['name']  ;
    
    $old_location=$_FILES['img']['tmp_name']  ;

    $new_location="asstes/users/" .$file_name ;

    if( move_uploaded_file($old_location,$new_location) ){
       unlink($serch['pactuer']) ;
}
    
}



 $update=mysqli_query($con,"UPDATE  users SET name='$name' ,pactuer='$new_location' WHERE email='$email'") ;

 if($update){
    $_SESSION['user']=['name'=>$name ,'email'=>$email ,'pactuer'=>$new_location ] ;
    header("location:profile.php");
}
} 
    
// echo "<pre>" ;
// print_r($_FILES['img']);
// echo "</pre>";

// }






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['user']['name'] ?></title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="./assest/css/cdn.jsdelivr.net_npm_bootstrap@5.2.3_dist_css_bootstrap.min.css">
    <style>
        
     body{background:rgba(218, 165, 32, 0.089)}
    .container{text-align:center ;margin-top:150px}
    input{font-size:30px ;margin-top:50px}
    input[type='file']{display:none}
    button{margin-top:50px}
    </style>
</head>
<body>
    <div class="container">
<form method='POST' enctype="multipart/form-data">
 <label for='photo'>upload New Photo</labe>
<input type='file' id='photo' name='img'>
<br>
<input type='text' value="
<?php
 if(isset($_POST['name'])){echo $_POST['name'] ;}else{ echo $serch['name'] ;}
  ?>
" name='name'>
<br>
<button type='submit' name='submit' class='btn btn-success'> EDIT </button> 
</form>
</div>
</body>
</html>