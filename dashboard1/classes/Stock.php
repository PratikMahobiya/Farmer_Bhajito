<?php

	class Stock {
		private $con;
		public function __construct($con) {
			$this->con = $con;
		}

		public function AddStock($name, $quantity, $price, $image=null, $vendor_id) {
			$this->checkPara($name, $quantity, $price, $vendor_id);
			$created_at = date('Y-m-d h:i:s');
			$query = mysqli_query($this->con, "INSERT INTO stock(name, quantity, price, image, vendor_id, created_at) VALUES('$name', '$quantity', '$price', '$image', '$vendor_id', '$created_at')");
			if($query) {
				$stockId = mysqli_insert_id($con);
				$ref = $stockId;
				$update = mysqli_query($con, "UPDATE stock SET ref='$ref' WHERE id='$stockId'");
				return 1;
				// header("Location: ../dashboard1/examples/dashboard.php");
			} else {
				echo "<script>alert(" . "Could not insert)" . "</script>";
				header("Location: ../dashboard1/examples/dashboard.php?inv=true");
			}
		}

		private function checkPara($n, $q, $p, $v) {
			if (!preg_match("/[^a-zA-Z]/", $n)) header("Location: ../dashboard1/examples/dashboard.php?inv=true");
			if (!preg_match(["/[^0-9]/"], $q) || !preg_match(["/[^0-9]/"], $p)) header("Location: ../dashboard1/examples/dashboard.php?inv=true");
			// if ($vendor_id == 0) header("Location: ../dashboard1/examples/dashboard.php?inv=true");
		}

	}

?>