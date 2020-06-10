<?php 
  if(!isset($_SESSION)) { session_start(); }
  	$custIDFromSession = $_SESSION['id'];
	include('../db_con.php');
	if(!isset($_GET['submit'])) echo "<h1>Please enter delivery details..</h1>";
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Farmers Forum</title>
	<!--/tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Grocery Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--//tags -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<!--pop-up-box-->
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<!--//pop-up-box-->
	<!-- price range -->
	<link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
	<!-- fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
</head>

<body>
	<?php
if($_SESSION['loginstatus']=="")
{
  header("location: product.php");
}
?>
    <?php include('../db_con.php'); ?>
<?php

	//$s="select * from c_fregistration where name='" . $_SESSION["name"] . "'";
      
  // $q=mysqli_query($con,$s);
  // $r=mysqli_num_rows($q);
  // $data=mysqli_fetch_array($q);
  // $name=$data[1];

	//echo $name;
	
	// foreach($_SESSION['checkoutIdsArray'] as $cids){
	// 	//Print out the product ID.
	// 	echo $cids, '<br>';
	// }
	// var_dump($_SESSION['checkoutIdsArray']);

	if(isset($_GET['submit'])) {
		$bcid = array();
		$bcid = $_GET['cid'];
		// $getCustIdRes = mysqli_query($con, "SELECT cust_id FROM before_checkout WHERE id='$bcid'");
		// if($getCustIdRow = mysqli_fetch_array($getCustIdRes)) {
		// 	$custIdFromBeforeCheckout = $getCustIdRow['cust_id'];
		// }
		$name = $_GET['name'];
		$number = $_GET['number'];
		$landmark = $_GET['landmark'];
		$city = $_GET['city'];
		$vendor_id = $_GET['vendor_id'];
		$created_at = date("Y-m-d h:i:s");
		$insert = mysqli_query($con, "INSERT INTO delivery (name, cust_id, cust_number, landmark, city, created_at) VALUES('$name', $custIDFromSession, '$number', '$landmark', '$city', '$created_at')");
		if(!$insert) header("Location: checkout.php");
		$delivery_id = mysqli_insert_id($con);
		// $_SESSION['delivery_id'] = $delivery_id;
		foreach ($bcid as $bid) {
			$insertToOrder = mysqli_query($con, "INSERT INTO order_table (delivery_id, bcid, created_at, vendor_id) VALUES ($delivery_id, $bid, '$created_at', $vendor_id)");
			$message = "New Order Confirmed: DELIVERY TO- " . $name . " ,NUMBER: " . $number . " ,Address: " . $landmark . ", " . $city;
			$insertNotification = mysqli_query($con, "INSERT INTO notification (message, vendor_id, bcid, created_at) VALUES ('$message', $vendor_id, $bid, '$created_at')");
			$updateCheckout = mysqli_query($con, "UPDATE before_checkout SET status=0 WHERE id='$bid'");
		}
	}
?>

		<!-- header-bot-->
	<div class="header-bot">
		<div class="header-bot_inner_wthreeinfo_header_mid">
			<!-- header-bot-->
			<div class="col-md-4 logo_agile">
				<h1>
					<a href="index.html">
						<span>Y</span>our
						<span>D</span>eal
						<img src="images/logo2.png" alt=" ">
					</a>
				</h1>
			</div>
			<!-- header-bot -->
			<div class="col-md-8 header">
				<!-- search -->
				<div class="agileits_search">
					<form action="#" method="post">
						<input name="Search" type="search" placeholder="How can we help you today?" required="">
						<button type="submit" class="btn btn-default" aria-label="Left Align">
							<span class="fa fa-search" aria-hidden="true"> </span>
						</button>
					</form>
				</div>
				<!-- //search -->
				<!-- cart details -->
				<div class="top_nav_right">
					<div class="wthreecartaits wthreecartaits2 cart cart box_1">
						<form action="checkout.php" method="post" class="last">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="display" value="1">
							<button class="w3view-cart" type="submit" name="submit" value="">
								<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
							</button>
						</form>
					</div>
				</div>
				<!-- //cart details -->
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- //header-bot -->
	<!-- navigation -->
	<div class="ban-top">
		<div class="container">
			<div class="top_nav_left">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
							    aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav menu__list">
								<li class="active">
									<a class="nav-stylehead" href="product.php">Home
										<span class="sr-only">(current)</span>
									</a>
								</li>
								<li>
									<a href="#" >
										<span class="fa fa-user-circle-o" aria-hidden="true"></span> <?php echo @$name; ?>  </a>
								</li>
								<li>
									<a href="logout.php">
										<span class="fa fa-unlock-alt" aria-hidden="true"></span> Logout </a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<!-- //navigation -->
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Home</a>
						<i>|</i>
					</li>
					<li>Payment</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<!-- payment page-->
	<div class="privacy">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Payment
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<!--Horizontal Tab-->
				<div id="parentHorizontalTab">
					<ul class="resp-tabs-list hor_1">
						<li>Your order is being processed.</li>
						
					</ul>
					<div class="resp-tabs-container hor_1">

						<div>
							<div class="vertical_post check_box_agile">
								<h5>COD</h5>
								<div class="checkbox">
									<div class="check_box_one cashon_delivery">
										<label class="anim">
											<span> We also accept Credit/Debit card on delivery. Please Check with the agent.</span>
										</label>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Plug-in Initialisation-->
			</div>
		</div>
		<hr>
		<!-- table -->
		<div class="checkout-right">
				<h4>Order Summary:
				<?php 
						$result = mysqli_query($con, "SELECT order_table.id AS otid, order_table.delivery_id AS did, before_checkout.stock_id AS sid, before_checkout.quantity AS quantity, before_checkout.cust_id AS cid FROM order_table INNER JOIN before_checkout ON (order_table.bcid=before_checkout.id) WHERE before_checkout.status=0 AND order_table.status=1");
					echo "<span>" . mysqli_num_rows($result) . " Products</span>";
					$count = 1;
				?>
				</h4>
				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>SL No.</th>
								<th>Product</th>
								<th>Order Quantity</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Vendor's Name</th>
							</tr>
						</thead>
						<tbody>
						<?php while($row = mysqli_fetch_array($result)) { 
									$stock_id = $row['sid'];
									$orderId = $row['otid'];
									if(isset($_GET['submit'])) {
										$updateOrderStatus = mysqli_query($con, "UPDATE order_table SET status=0 WHERE id='$orderId'");
									}
									$getStock = mysqli_query($con, "SELECT stock.name as sName, stock.vendor_id AS v_id, stock.image as sImage, fregistration.name as vendorName, stock.price as sPrice FROM stock INNER JOIN fregistration ON(stock.vendor_id = fregistration.id) WHERE stock.id=$stock_id");
									$stockRows = mysqli_fetch_array($getStock);
						?>
							<tr class="rem3">
								<td class="invert"><?php echo $count; ?></td>
								<td class="invert-image">
									<a href="single.html">
										<img src="../dashboard1/uploads/<?php echo $stockRows['sImage']; ?>" alt="" class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<div class="quantity">
										<div class="quantity-select">
											<!-- <div class="entry value-minus">&nbsp;</div> -->
											<div class="entry value">
												<span><?php echo $row['quantity']; ?></span>
											</div>
											<!-- <div class="entry value-plus active">&nbsp;</div> -->
										</div>
									</div>
								</td>
								<td class="invert"><?php echo $stockRows['sName']; ?></td>
								<td class="invert"><?php echo ($stockRows['sPrice'] * $row['quantity']); ?></td>
								<td class="invert">
									<?php echo $stockRows['vendorName']; ?>
								</td>
							</tr>
								<?php 
									$count++;
									} 
								?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- table -->
	</div>
	<!-- //payment page -->

	<!-- newsletter -->
	<div class="footer-top">
		<div class="container-fluid">
			<div class="col-xs-8 agile-leftmk">
				<h2>Get your Groceries delivered from local stores</h2>
				<p>Free Delivery on your first order!</p>
				<form action="#" method="post">
					<input type="email" placeholder="E-mail" name="email" required="">
					<input type="submit" value="Subscribe">
				</form>
				<div class="newsform-w3l">
					<span class="fa fa-envelope-o" aria-hidden="true"></span>
				</div>
			</div>
			<div class="col-xs-4 w3l-rightmk">
				<img src="images/tab3.png" alt=" ">
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- //newsletter -->
	<!-- footer -->
	<footer>
		<div class="container">
			
			<!-- footer second section -->
			<div class="w3l-grids-footer">
				<div class="col-xs-4 offer-footer">
					<div class="col-xs-4 icon-fot">
						<span class="fa fa-map-marker" aria-hidden="true"></span>
					</div>
					<div class="col-xs-8 text-form-footer">
						<h3>Track Your Order</h3>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="col-xs-4 offer-footer">
					<div class="col-xs-4 icon-fot">
						<span class="fa fa-refresh" aria-hidden="true"></span>
					</div>
					<div class="col-xs-8 text-form-footer">
						<h3>Free & Easy Returns</h3>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="col-xs-4 offer-footer">
					<div class="col-xs-4 icon-fot">
						<span class="fa fa-times" aria-hidden="true"></span>
					</div>
					<div class="col-xs-8 text-form-footer">
						<h3>Online cancellation </h3>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<!-- //footer second section -->
			<!--modal 1  -->
			<div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body modal-body-sub_agile">
								<div class="main-mailposi">
									<span class="fa fa-envelope-o" aria-hidden="true"></span>
								</div>
								<div class="modal_body_left modal_body_left1">
									<h3 class="agileinfo_sign">Sign In </h3>
									<p>
										Sign In now, Let's start your Grocery Shopping. Don't have an account?
										<a href="#" data-toggle="modal" data-target="#myModal2">
											Sign Up Now</a>
									</p>
									<form action="#" method="post">
										<div class="styled-input agile-styled-input-top">
											<input type="text" placeholder="User Name" name="Name" required="">
										</div>
										<div class="styled-input">
											<input type="password" placeholder="Password" name="password" required="">
										</div>
										<input type="submit" value="Sign In">
									</form>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
			<!-- //Modal content-->
					</div>
			</div>
			<!-- //Modal1 -->			
				<!-- payment -->
				<div class="sub-some child-momu">
					<h5>Payment Method</h5>
					<ul>
						<li>
							<img src="images/pay2.png" alt="">
						</li>
						<li>
							<img src="images/pay5.png" alt="">
						</li>
						<li>
							<img src="images/pay1.png" alt="">
						</li>
						<li>
							<img src="images/pay4.png" alt="">
						</li>
						<li>
							<img src="images/pay6.png" alt="">
						</li>
						<li>
							<img src="images/pay3.png" alt="">
						</li>
						<li>
							<img src="images/pay7.png" alt="">
						</li>
						<li>
							<img src="images/pay8.png" alt="">
						</li>
						<li>
							<img src="images/pay9.png" alt="">
						</li>
					</ul>
				</div>
				<!-- //payment -->
			</div>
			<!-- //footer fourth section (text) -->
		</div>
	</footer>
	<!-- //footer -->
	<!-- copyright -->
	<div class="copy-right">
		<div class="container">
			<p>HAPPY TO DEAL WITH YOU.
			</p>
		</div>
	</div>
	<!-- //copyright -->

	<!-- js-files -->
	<!-- jquery -->
	<script src="js/jquery-2.1.4.min.js"></script>
	<!-- //jquery -->

	<!-- popup modal (for signin & signup)-->
	<script src="js/jquery.magnific-popup.js"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!-- Large modal -->
	<!-- <script>
		$('#').modal('show');
	</script> -->
	<!-- //popup modal (for signin & signup)-->

	<!-- cart-js -->
	<script src="js/minicart.js"></script>
	<script>
		paypalm.minicartk.render(); //use only unique class names other than paypal1.minicart1.Also Replace same class name in css and minicart.min.js

		paypalm.minicartk.cart.on('checkout', function (evt) {
			var items = this.items(),
				len = items.length,
				total = 0,
				i;

			// Count the number of each item in the cart
			for (i = 0; i < len; i++) {
				total += items[i].get('quantity');
			}

			if (total < 3) {
				alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
				evt.preventDefault();
			}
		});
	</script>
	<!-- //cart-js -->

	<!-- easy-responsive-tabs -->
	<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
	<script src="js/easyResponsiveTabs.js"></script>

	<script>
		$(document).ready(function () {
			//Horizontal Tab
			$('#parentHorizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion
				width: 'auto', //auto or any width like 600px
				fit: true, // 100% fit in a container
				tabidentify: 'hor_1', // The tab groups identifier
				activate: function (event) { // Callback function if tab is switched
					var $tab = $(this);
					var $info = $('#nested-tabInfo');
					var $name = $('span', $info);
					$name.text($tab.text());
					$info.show();
				}
			});
		});
	</script>
	<!-- //easy-responsive-tabs -->

	<!-- credit-card -->
	<script src="js/creditly.js"></script>
	<link rel="stylesheet" href="css/creditly.css" type="text/css" media="all" />

	<script>
		$(function () {
			var creditly = Creditly.initialize(
				'.creditly-wrapper .expiration-month-and-year',
				'.creditly-wrapper .credit-card-number',
				'.creditly-wrapper .security-code',
				'.creditly-wrapper .card-type');

			$(".creditly-card-form .submit").click(function (e) {
				e.preventDefault();
				var output = creditly.validate();
				if (output) {
					// Your validated credit card output
					console.log(output);
				}
			});
		});
	</script>
	<!-- //credit-card -->

	<!-- password-script -->
	<script>
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}

		function validatePassword() {
			var pass2 = document.getElementById("password2").value;
			var pass1 = document.getElementById("password1").value;
			if (pass1 != pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');
			//empty string means no validation error
		}
	</script>
	<!-- //password-script -->

	<!-- smoothscroll -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- //end-smooth-scrolling -->

	<!-- smooth-scrolling-of-move-up -->
	<script>
		$(document).ready(function () {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->

	<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->

</body>

</html>