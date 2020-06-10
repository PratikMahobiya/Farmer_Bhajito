<?php 

	include("../../db_con.php");

	if (isset($_GET['quantity'])) {
		$id = $_GET['id'];
		$q = $_GET['quantity'];
		$quantity = (int)$q;
		$p = $_GET['price'];
		$price = (double)$p;
		// UPDATE users SET firstName='$fname', lastName='$lname', username='$uname' WHERE id='$id'"
		$update = mysqli_query($con, "UPDATE stock SET quantity = '$quantity', price = '$price' WHERE id = '$id'");
		if ($update) {
			// echo $id;
			header("Location: ../dashboard1/examples/tables.php");
		} else {
			echo "Could not update" . $mysqli_error;
		}
	} else {
		// header("Location: ../dashboard1/examples/tables.php");
		echo "No request";
	}
?>