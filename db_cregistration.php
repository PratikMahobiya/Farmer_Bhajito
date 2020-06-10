<?php

echo "Coming";
session_start();
$_SESSION['message']='';

$mysqli = new mysqli('localhost','root','','farmer');
if($_SERVER['REQUEST_METHOD']=='POST'){
     if($_POST['password']==$_POST['cpassword']){
         $name = $mysqli->real_escape_string($_POST['name']);
         $email = $mysqli->real_escape_string($_POST['email']);
         $area = $mysqli->real_escape_string($_POST['area']);
         $password = $mysqli->real_escape_string($_POST['password']);
         
         
         
         $sql = " INSERT INTO c_fregistration (name,email,area,password)" . " VALUES ('$name','$email','$area','$password')";
         
         if($mysqli->query($sql) == true){
             $_SESSION['message']= "Successfully registered..!!";
             $_SESSION['name'] = $name;
             header("Location: index.php");
         }
         else{
             $_SESSION['message']= "not Added..!!";
             
         }
     }
     else{
         $_SESSION['message']= "not MAtched";
     }
     
}

/*include 'db_con.php';





$qry=" insert into fregistration (name,email,password,cpassword) values('".$_POST["name"]."','".$_POST["email"]."'.'".$_POST["password"]."','".$_POST["cpassword"]."')" ;

mysqli_query($con,$qry);
mysqli_close($con);
header('Location: index.html');
*/
?>
