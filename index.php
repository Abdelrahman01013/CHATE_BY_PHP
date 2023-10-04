<?php 
include("asstes/db.php") ;

if(!isset($_SESSION['user']) ){
    header("location:login.php") ;
}

// $date_after_month = time() + (30 * 24 * 60 * 60);
// $sql = "DELETE FROM chat WHERE time(date) < $date_after_month";
// mysqli_query($con, $sql);

$date_after_month = "DATE_SUB(NOW(), INTERVAL 30 DAY)";
$sql = "DELETE FROM chat WHERE date < $date_after_month";
$result = mysqli_query($con, $sql);

if (!$result) {
    die('Error: ' . mysqli_error($con));
}


$select=mysqli_query($con,"SELECT*FROM chat ORDER BY date DESC") ;
$se=mysqli_fetch_array($select) ;

if(isset($_POST['send'])){
    $new_user=$_SESSION['user']['name'];
    $new_msg=$_POST['msg'] ;
    if(!empty($new_user)){
        if(!empty($new_msg)){
    $insert= mysqli_query($con,"INSERT INTO chat(user_name,msg) VALUE ('$new_user','$new_msg')");
     if($insert){echo '<emped loop="false" hidden="true" src="asstes/1.mp3" autoplay="true>' ;}
    
    
     header("location:index.php") ;

        }
    }
    
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' type='text/css' href='asstes/style/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='asstes/style/style.css'>
    <script>
        // XMLHttpRequest(); ==> ارسال الطلبات
        function aj(){
            var req = new XMLHttpRequest(); 
            req.onreadystatechange = function(){           //بنراجع هل في تغير خحدث ام لا
                if(req.readyState==4 && req.status==200){  //4 اكتمل    
                                                        //   200 نجح الطلب
                    document.getElementById('chat').innerHTML=req.responseText;
                
                }
            }
        req.open('GET','asstes/chat.php',true);
        req.send();
        } setInterval(function(){aj()},1000);



    </script>
</head>
<body onload="aj();">

<nav class="navbar navbar-expand-lg ">
  <div class="container" style="background-color: gold;">
    <a href="profile.php">
    <?php $email=$_SESSION['user']['email'] ;
     $photos=mysqli_query($con,"SELECT *FROM users WHERE email='$email' ") ;
     $fetch_photo=mysqli_fetch_assoc($photos) ;
     ?>
    <img src="<?php echo $fetch_photo['pactuer'] ?>" 
    alt="<?php echo $_SESSION['user']['name'] ?>" style="border-radius: 100%; width:70px ;height:60px;"> 
    </a>
    <a href="profile.php" style="text-decoration: none;"><h3 class="text-success"><b><i> <?php echo $_SESSION['user']['name'] ?></h3> </a>
    <a class="navbar-brand btn btn-success" href="logout.php" >LOGOUT</a>   
</div>
  </div>
</nav>



<div class="container">
<form method="POST" action="index.php"> 

<div class="row" id="chat"> 


</div>



<div class="row put p-3" style="cursor:pointer"> 
<div class="col-12" style="width:100%">

<div class="col-12">   
<textarea rows="5" cols="30" placeholder="Message" class="form-control mb-3" name="msg" autofocus multiple></textarea>
</div> 
  
<button class='btn btn-warning w-100' name='send' >SEND</button>

</div>


</div>
</form>
</div>
<div class="contact">
<span>
Abdelrahman Ahmed
<a href="https://wa.me/201013230248" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
<a href="https://www.facebook.com/abdelrahman.algeneral" target="_blank"><i class="fa-brands fa-facebook"></i></a>
<a href="https://github.com/Abdelrahman01013" target="_blank"><i class="fa-brands fa-github"></i></a>
<a href="mailto:generalal@gmail.com" target="_blank"><i class="fa-brands fa-google-plus"></i></a>
<a href="https://wa.me/201118003381" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
</span>
</div>


<script >
document.querySelector('textarea[name="msg"]').addEventListener('keydown', function(e){
    if (e.key === 'Enter') {
        e.preventDefault();
        document.querySelector('button[name="send"]').click();
    }
});



</script>
</body>
</html>


