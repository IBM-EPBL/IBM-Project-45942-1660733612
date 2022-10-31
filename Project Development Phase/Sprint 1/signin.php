<?php
   include('config.php');
   echo "Host: ".$host." Database: ".$database;

if (isset($_POST['signin']))

{
 $Name         = $_POST['Name'];
 $Email            = $_POST['Email'];
 $Password         = $_POST['Password'];
 $Confirm_Password = $_POST['Confirm Password'];

$conn = new mysqli($Name,$Email,$Password,$Confirm_Password);

if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}

 $duplicate = mysqli_query ($conn, "SELECT * FROM 'signin' WHERE Name = '$Name' OR Email = '$Email'");

  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  else{
    if($Password == $confirmPassword){
      
       $query = "INSERT Into 'signin'(Name,Email,Password,Confirm_Password)VALUES(?,?,?,?)";
       $result=mysqli_query($conn, $query);
       echo
       ?>
       <script> alert("Registration Successful");
                     window.location.replace("login.html");   
        </script>;
        <?php
    }
    else{
      echo
      ?>
      "<script> alert('Password Does Not Match'); </script>"; <?php
    }
  }
  $conn->close();
}

?>