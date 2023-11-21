<?php
session_start();
$connect = include 'database_connection.php';


function generateRandomString($length = 8) {
    $randomBytes = random_bytes($length);
    return bin2hex($randomBytes);
}

// Usage example: generate a random alphanumeric string with a length of 10
$_SESSION['randomString'] = generateRandomString(10);



$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;
$subtotal = isset($_SESSION['subtotal']) ? $_SESSION['subtotal'] : "No value collected";


// Function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate number
function validateNumber($number) {
    return is_numeric($number);
}

// Function to validate name (first name and last name)
function validateName($name) {
    // Use a regular expression to allow only letters and spaces
    return preg_match("/^[a-zA-Z ]+$/", $name);
}

// Initialize error messages
$firstNameError = $lastNameError = $phoneNumberError = $emailError = "";

// usage:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $_SESSION["fname"] = $_POST["fname"];
    $_SESSION["lname"] = $_POST["lname"];
    $_SESSION["city"] = $_POST["city"];
    $_SESSION["number"] = $_POST["number"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["state"] = $_POST["state"];

	$firstName = $_SESSION["fname"];
    $lastName = $_SESSION["lname"];
    $city = $_SESSION["city"];
    $phoneNumber = $_SESSION["number"];
    $email = $_SESSION["email"];
    $state = $_SESSION["state"];

	if (isset($_POST["submit"])){

		// Validate first name
		if (empty($firstName)) {
			$firstNameError = "First name is required";
		} elseif (!validateName($firstName)) {
			$firstNameError = "Invalid first name format";
		}

		// Validate last name
		if (empty($lastName)) {
			$lastNameError = "Last name is required";
		} elseif (!validateName($lastName)) {
			$lastNameError = "Invalid last name format";
		}

		// Validate email
		if (empty($email)) {
			$emailError = "email is required";
		} elseif (!validateEmail($email)) {
			$emailError = "Invalid email format";
		}

		
		// Validate phoneNumber
		if (empty($phoneNumber)) {
			$phoneNumberError = "phoneNumber is required";
		} elseif (!validateNumber($phoneNumber)) {
			$phoneNumberError = "Invalid Phone Number format";
		}


		// Check if all validations passed
		if (empty($firstNameError) && empty($lastNameError) && empty($phoneNumberError) && empty($emailError)) {
			echo "Your Details are required!";
			// Perform further actions if needed
		}

		// $insert = "INSERT INTO footwear_info(product_name, product_category, price, size, color, front_image, back_image, style) VALUES('$product_name', '$product_category', '$price', '$size', '$color', '$front_image', '$back_image', '$style')";

    	// $insert_to_database = mysqli_query($connect, $insert) or die("Cannot insert to table".mysqli_connect_error($connect));

		header("Location: pay.php");
		exit();
	}
}


?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>Jolayemi Footwear - checkout</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rokkitt:100,300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Ion Icon Fonts-->
	<link rel="stylesheet" href="css/ionicons.min.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<style>
		#total{
			width: fit-content;
			margin-left: 30px;
			flex-direction: center;
		}

		#word_total{
			width: fit-content;
		}

		.span{
			color: red;
		}
	</style>

	<script>
        // Retrieve the value from the URL parameter
        var urlParams = new URLSearchParams(window.location.search);
        var subtotalValue = urlParams.get('subtotal');

        // Display the value in the second page
        document.getElementById('subtotalValue').innerText = subtotalValue;
    </script>

	</head>
	<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
	<div class="colorlib-loader"></div>

	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-sm-7 col-md-9">
							<div id="colorlib-logo"><a href="index.php">Footwear</a></div>
						</div>
						<div class="col-sm-5 col-md-3">
			            <div class="search-wrap">
			               <div class="form-group">
			                  <input type="search" class="form-control search" placeholder="Search">
			                  <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
			               </div>
						</div>
			         </div>
		         </div>
					<div class="row">
						<div class="col-sm-12 text-left menu-1">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li class="has-dropdown">
									<a href="men.php">Men</a>
									<ul class="dropdown">
										<li><a href="product-detail.php">Product Detail</a></li>
										<li><a href="cart.php">Shopping Cart</a></li>
										<li><a href="checkout.php">Checkout</a></li>
										<li><a href="order-complete.php">Order Complete</a></li>
										<li><a href="add-to-wishlist.php">Wishlist</a></li>
									</ul>
								</li>
								<li><a href="women.php">Women</a></li>
								<li><a href="about.php">About</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li class="cart"><a href="cart.php"><i class="icon-shopping-cart"></i> Cart [<?= $cart_count; ?>]</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="sale">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 offset-sm-2 text-center">
							<div class="row">
								<div class="owl-carousel2">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Home</a></span> / <span>Checkout</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-sm-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center active">
								<p><span>02</span></p>
								<h3>Checkout</h3>
							</div>
							<div class="process text-center">
								<p><span>03</span></p>
								<h3>Order Complete</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<div class="colorlib-form">
							<h2>Billing Details</h2>
		              	<div class="row">

								<div class="col-md-6">
									<div class="form-group">
										<label for="fname">First Name</label>
										<input type="text" id="fname" name="fname" class="form-control" placeholder="Your firstname" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="lname">Last Name</label>
										<input type="text" id="lname" name="lname" class="form-control" placeholder="Your lastname" required>
									</div>
								</div>
			            
			               <div class="col-md-12">
									<div class="form-group">
										<label for="companyname">Town/City</label>
			                    	<input type="text" id="towncity" name="city" class="form-control" placeholder="Town or City" required>
			                  </div>
			               </div>
			            
								<div class="col-md-6">
									<div class="form-group">
										<label for="stateprovince">State/Province</label>
										<input type="text" id="fname" name="state" class="form-control" placeholder="State Province" required>
									</div>
								</div>
							
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">E-mail Address</label>
										<input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="Phone">Phone Number</label>
										<input type="text" id="zippostalcode" name="number" class="form-control" placeholder="Phone Number" required>
									</div>
								</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">
										<div class="cart-detail">
											<h2>Cart Total</h2>
											<ul>
												<li>
													<span id="word_total">Subtotal</span > <span id="total">NGN <?= $subtotal; ?></span>
												</li>
												<li><span id="word_total">Shipping</span> <span id="total">NGN 180.00</span></li>
												<li><span id="word_total">Order Total</span> <span id="total">NGN 0.00</span></li>
											</ul>
										</div>
										<div class="col-md-12 text-center">
											<p><input type="submit" class="btn btn-primary" name="submit" value="Place an order"></p>
										</div>
									</div>
						   		</div>

						   	</div>
								
						</div>
		               </div>
					</div>
					</div>
				</div>
			</div>
		</div>

		<footer id="colorlib-footer" role="contentinfo">
			<div class="container">
				<div class="row row-pb-md">
					<div class="col footer-col colorlib-widget">
						<h4>About Our Product</h4>
						<p>Elevate your style effortlessly with this must-have fashion essential. Find your signature look today</p>
						<p>
							<ul class="colorlib-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-linkedin"></i></a></li>
								<li><a href="#"><i class="icon-instagram"></i></a></li>
                                <li><a href="#"><i class="icon-whatsapp"></i></a></li>
							</ul>
						</p>
					</div>
					<div class="col footer-col colorlib-widget">
						<h4>Customer Care</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="#">Contact</a></li>
								<li><a href="#">Customer Services</a></li>
							</ul>
						</p>
					</div>
					<div class="col footer-col colorlib-widget">
						<h4>Information</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="#">About us</a></li>
								<li><a href="#">Delivery Information</a></li>
							</ul>
						</p>
					</div>

					<div class="col footer-col">
						<h4>Contact Information</h4>
						<ul class="colorlib-footer-links">
							<li>103 Akindeko hostel, <br> Federal University of Technology Akure(FUTA), <br> Ondo-State, <br> Nigeria.</li>
							<li><a href="#">+2348130906009</a></li>
							<li><a href="#">jolayemiempire@gmail.com</a></li>
							<li><a href="#">yoursite.com</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="copy">
				<div class="row">
					<div class="col-sm-12 text-center">
						<p>
							<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is design by Jolayemi</a>
						</p>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
   <!-- popper -->
   <script src="js/popper.min.js"></script>
   <!-- bootstrap 4.1 -->
   <script src="js/bootstrap.min.js"></script>
   <!-- jQuery easing -->
   <script src="js/jquery.easing.1.3.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Owl carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>
	</form>
	</body>
	<?php mysqli_close($connect); ?>
</html>

