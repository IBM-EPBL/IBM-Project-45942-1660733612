<?php

 $Name  = $_POST['uname'];
 $Email    = $_POST['Email '];
 $Password  = $_POST['upassword'];
 $Confirm_Password   = $_POST['Confirm_Password'];
 


if (!empty($Name )
    ||!empty($Email )||!empty($Password)||!empty($Confirm_Password) )


$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{

  $SELECT = "SELECT Email From signin Where Email = ? Limit 1";
  $INSERT = "INSERT Into signin (uname, Email ,upassword ,Confirm_Password  )values(?,?,?,?)";

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $Email);
     $stmt->execute();
     $stmt->bind_result($Email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

    
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss",$uname,$Email ,$upassword ,$Confirm_Password );
      $stmt->execute();
       ?> 
            <script>alert("registration sucessfully");
                   window.location.replace("login.html");
            </script>
       <?php     
     } else {
       ?> 
            <script>alert("some one already using this email");
                   window.location.replace("index.html");
            </script>
       <?php 
     }
     $stmt->close();
     $conn->close();
} 
   die();  
?>