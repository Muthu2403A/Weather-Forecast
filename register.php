<?php
$name=$_POST['name'];
$username = $_POST['username'];
$phno  = $_POST['phno'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];




if (!empty($name)||!empty($username) || !empty($phno) || !empty($password) || !empty($cpassword) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "weatherdb";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT * From loginuser Where username = ? ";
  $INSERT = "INSERT Into loginuser ( 'name' , 'username' , 'phno' , 'password', 'cpassword' )values(?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $stmt->bind_result($username);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssss", $name,$username1,$phno,$password,$cpassword);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>