<?php
session_start();
include 'database_connection.php';
include 'search.php';

// echo $_SESSION['order_total'];

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

	<?php include 'link.html';?>

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

	<?php include 'navigation.php';?>

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

		<?php include 'footer.html'; ?>
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

