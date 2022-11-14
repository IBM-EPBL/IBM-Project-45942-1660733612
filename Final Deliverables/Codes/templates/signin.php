<?php
session_start();
$conn = mysqli_connect('localhost','root','','project');


if (isset($_POST['signin']))
{
   $Name             = $_POST['uname'];
   $Email            = $_POST['Email'];
   $Password         = $_POST['upassword'];
   $Confirm_Password = $_POST['Confirm_Password'];

 $conn = new mysqli($uname,$Email,$upassword,$Confirm_Password);

 if ($conn->connect_error){
   die("Connection failed: " . $conn->connect_error);
 }

  $duplicate = mysqli_query ($conn, "SELECT * FROM 'signin' WHERE 'Name' = '$uname' OR Email = '$Email'");

   if(mysqli_num_rows($duplicate) > 0){
       ?>
        <script> alert('Username or Email Has Already Taken')</script>
      <?php
     
   }
   else{
     if($upassword == $Confirm_Password){
      
       $query = "INSERT INTO signin (uname,Email,upassword,Confirm_Password) VALUES(?,?,?,?)";
       $result=mysqli_query($conn, $query);
       ?>
       <script> alert("Registration Successful");
                     window.location.replace("login.html");   
        </script>
       <?php
      
    }
    else{
      
      ?>
      <script> alert('Password Does Not Match'); </script> <?php
    }
  }
  $conn->close();
  $stmt->close();
}

?>