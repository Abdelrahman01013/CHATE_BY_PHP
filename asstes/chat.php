<?php
include("db.php");
// include('index.php') ;
$select=mysqli_query($con,"SELECT * FROM chat ORDER BY date");

while($row=mysqli_fetch_array($select)){
$name=$row['user_name'] ;
$mes=$row['msg'] ;
$date=$row['date'] ;




?>
<div class="row" >  
<div class="col-10">
    <span class='text-warning ' style="font-size:25px; font-weight:bold"><?php echo $name ?> </span>   
    <br>
<span class='text-light' style="font-size:20px ;font-weight:bold"> <?php echo $row['msg']?> </span>
 </div>

<div class="col-2">
<span class='text-danger'><?php echo $row['date'] ?> </span>    
</div>
</div>
<hr>

<?php } ?>