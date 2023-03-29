<html>
<?php

   extract($_POST);

   if(!isset($age))
   {

?>

<body>
    <form method="post" action="redisstore.php" >

      <h1>
      <?php
      echo "<h1> Accessed for localStorage and writing to redis</h1>";
        ?>
       </h1>
        <div>
        <label> Name </label>
        <input type="text" name="uname" id="uname"/> 
         </div>
         <div>
         <label> Age </label>
        <input type="text" name="age" id="age"/>
</label>
</div>
        <div>
        <label> DOB </label>
        <input type="text" name="dob" id="dob"/>
</div>
        <div>
        <label> Contact </label>
        <input type="text" name="contact" id="contact"/>
</div>

<div>
      <input type="submit" value="Writinging into Redis"/>

</div>



    <form>
    
        
</body>

<?php
   }
   else
   {
    echo "<h1> Sending the Session Data to redis server </h1>";

    require_once '../vendor/autoload.php';

    $redis=new Predis\Client();
   
    echo "<h1>". $redis->ping().", connected to backend redis server </h1>";


   $redis->set("username",$uname);