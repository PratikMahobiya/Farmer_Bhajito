<?php 

	include("../../db_con.php");

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$delete = mysqli_query($con, "DELETE FROM stock WHERE id='$id'");
		if ($delete) {
			header("Location: ../dashboard1/examples/tables.php");
		} else echo "Could not delete";
	} else echo "no request";

?>