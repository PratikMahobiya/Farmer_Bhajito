 <?php 
session_start();

include 'db_con.php';

IF($_SERVER['REQUEST_METHOD']=='POST'){
	$username = $con->real_escape_string($_POST["uname"]);
	$password = $con->real_escape_string($_POST["password"]);
	
	$sql = "SELECT * FROM fregistration WHERE uname='$username' AND password='$password'";

	$q=mysqli_query($con,$sql);
	$r=mysqli_num_rows($q);
	$data=mysqli_fetch_array($q);

	mysqli_close($con);	

if($r>0)
	{
		$_SESSION["username"]=$username;
		$_SESSION["uname"]=$data['uname'];
		$_SESSION['loginstatus']="yes";
		$_SESSION['area']=$data['area'];
		$_SESSION['id']=$data['id'];

header("location:dashboard1/dashboard1/examples/dashboard.php");
	}
	else
	{
		echo "<script>alert('Invalid User Name Or Password');</script>";
	}
		
		}




// 	if($res=mysqli_query($con,$sql)){
// 			$r=mysqli_num_rows($res);
// 			if($row = mysqli_fetch_array($res))
// 			{
// 				$_SESSION['message']= "Successfully registered..!!";
//              $_SESSION['uname'] = $uname;
//              header("Location: sabjiwala/index.php");
// 			}
// 			else{
// 			echo "<script language=\"javascript\">alert(\"Invalid username or password\");document.location.href='invld.html';</script>";
// 	}
             

	
        
// }
// }	
?>