<?php 
	session_start();
	if(isset($_SESSION['id']))
    $vendor_id = $_SESSION['id'];
  else header("Location: ../../../../index.php");
	$title = "Add New Stock";
	include("header.php");
	if(isset($_POST['submit'])) {
		include("../../db_con.php");
		include("../classes/Stock.php");
		$stock = new Stock($con);
		$name = $_POST['name'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$vendor_id = $_SESSION['id'];

		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		$image = $_FILES["image"]["name"];

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			echo "<script>" . "alert( " . "Only Jpeg and png allowed!" . ")" . "</script>";
			header("Location: addStock.php");
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
		    echo "<script>" . "alert( " . "Only Jpeg and png allowed!" . ")" . "</script>";
			header("Location: addStock.php");
		}
	    else {
			$inserted = $stock->AddStock($name, $quantity, $price, $image, $vendor_id);
			if($inserted == 1) {
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			        header("Location: addStock.php");
			    } else {
			        echo "<script>" . "alert( " . "Not uploaded!" . ")" . "</script>";
			    }
			}
			header("Location: addStock.php?inv=true");
	   	}
	}
?>


<!-- logic -->

<div class="container">
	<h2>Add Stock Item</h2>

	<form method="post" action="addStock.php" enctype="multipart/form-data">
		<input type="text" name="name" class="form-control" placeholder="Enter stock item's name" required autofocus><br>
		<input type="number" name="quantity" class="form-control" placeholder="Enter Quantity (in KG)" required><br>
		<input type="text" name="price" class="form-control" placeholder="Enter price per kg" required><br>
		<input type="file" name="image" placeholder="Upload Image" class="form-control"><br>
		<input type="submit" name="submit" value="Add Item" class="btn btn-primary btn-lg" required>
	</form>
</div>