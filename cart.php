<?php
// Start the session to access session variables
session_start();
$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;
var_dump($_SESSION);
print "<br>________________<br>";
print $_SESSION['total'];

if (isset($_GET['remove_id'])) {
    $removeID = $_GET['remove_id'];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        // Iterate through the cart to find the matching item and remove it
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['id'] == $removeID) {
                unset($_SESSION['cart'][$key]);
                // Update the cart count in the session
                $_SESSION["arr_count"] = count($_SESSION['cart']);
                break; // Stop the loop after removing the item
            }
        }
    }
}

// // Calculate subtotal based on items in the cart
// $_SESSION['subtotal'] = 0;

// // Check if the necessary session variables are set
// if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
//     foreach ($_SESSION['cart'] as $product) {
//         $productId = $product['id'];
//         $quantity = isset($_POST['quantity_' . $productId]) ? $_POST['quantity_' . $productId] : 0;
//         $price = $product['price'];

//         // Calculate the total for each item and accumulate the subtotal
//         $_SESSION['subtotal'] += $price * $quantity;
//     }
// }
?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>Jolayemi Footwear - Cart Page</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- <script src="cart.js"></script> -->

   <!-- Inside the JavaScript section -->
	<script>
		// Function to calculate and update the subtotal and total amount
		function updateTotals() {
			var subtotal = 0;

			// Loop through each item in the cart
			<?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) : ?>
				<?php foreach ($_SESSION['cart'] as $product) : ?>
					var productId = <?php echo $product['id']; ?>;
					var price = <?php echo $product['price']; ?>;
					var quantity = +document.getElementById('quantity_' + productId).value;

					// Calculate total for each product and accumulate subtotal
					var total = price * quantity;
					subtotal += total;
				<?php endforeach; ?>
			<?php endif; ?>

			// Display subtotal and update total after deducting any discounts
			var discount = 45; // Assuming a fixed discount for the demonstration
			var total = subtotal - discount;

			// Update the displayed subtotal and total on the page
			document.getElementById('subtotal').innerText = 'NGN ' + subtotal.toFixed(2); // Update subtotal
			document.getElementById('total').innerText = 'NGN ' + total.toFixed(2); // Update total
		}

		// Call the function on quantity change to recalculate totals
		// It seems the `amountValue` function handles quantity changes
		// Call the updateTotals function inside amountValue function
		function amountValue(productId) {
			// Your existing logic to update quantity and total
			var price = +document.getElementById("price_" + productId).value;
			var quantityInput = document.getElementById('quantity_' + productId);
			var totalInput = document.getElementById('total_' + productId);

			// Update the total based on the quantity, assuming some calculation logic
			var quantityValue = parseInt(quantityInput.value);
			var calculatedTotal = quantityValue * price /* Your item price or calculation logic */;

			totalInput.value = calculatedTotal ? calculatedTotal : "Amount";

			// Store the values in local storage
			localStorage.setItem('quantity_' + productId, quantityInput.value);
			localStorage.setItem('total_' + productId, calculatedTotal);

			// After updating the quantity or total, call the function to update the totals
			updateTotals();
		}

		// Call the updateTotals function on page load
		window.onload = function() {
			 // Loop through the input elements to retrieve and set the stored values
			 var inputs = document.querySelectorAll('input[id^="quantity_"]');
			inputs.forEach(function(input) {
				var productId = input.id.split('_')[1];
				var quantity = localStorage.getItem('quantity_' + productId);
				var total = localStorage.getItem('total_' + productId);

				// Set the input values if stored values exist
				if (quantity !== null) {
					input.value = quantity;
				}

				// Set the total value if stored value exists
				var totalInput = document.getElementById('total_' + productId);
				if (total !== null) {
					totalInput.value = total;
				}
			});

			updateTotals();
		};
	</script>


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
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

	</head>
	<body>
	<form action="cart.php" method="post" enctype="multipart/form-data">
	<div class="colorlib-loader"></div>
	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-sm-7 col-md-9">
							<div id="colorlib-logo"><a href="index.html">Jolayemi Footwear</a></div>
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
								<li><a href="kid.php">Kids</a></li>
								<li><a href="about.php">About</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li class="cart"><a href="cart.html"><i class="icon-shopping-cart"></i> Cart [<?= $cart_count; ?>]</a></li>
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
						<p class="bread"><span><a href="index.php">Home</a></span> / <span>Shopping Cart</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-md-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center">
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
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="product-name d-flex">
							<div class="one-forth text-left px-4">
								<span>Product Details</span>
							</div>
							<div class="one-eight text-center">
								<span>Price</span>
							</div>
							<div class="one-eight text-center">
								<span>Quantity</span>
							</div>
							<div class="one-eight text-center">
								<span>Amount</span>
							</div>
							<div class="one-eight text-center px-4">
								<span>Remove</span>
							</div>
						</div>
						
						<?php
						// Check if the necessary session variables are set
						if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
							foreach ($_SESSION['cart'] as $product) {
								$productId = $product['id'];
								// $quantity = isset($_POST['quantity_' . $productId]) ? $_POST['quantity_' . $productId] : '';
    							// $total = isset($_POST['total_' . $productId]) ? $_POST['total_' . $productId] : '';


								// $_SESSION["quantity"] = $_POST["quantity_".$productId];
								// $_SESSION["amount"] = $_POST["total_".$productId];

								// $quantity = isset($_SESSION["quantity"]) ? $_SESSION["quantity"] : "";
								// $amount = isset($_SESSION["amount"]) ? $_SESSION["amount"] : "";

								// print $quantity. " / " . $amount;

								
							// Display the product details using the session variables
							echo '
								<div class="product-cart d-flex">
								<div class="one-forth">
									<div class="product-img" style="background-image: url(upload/' . $product['front_image'] . ');"></div>
									<div class="display-tc">
									<h3>' . $product['product_name'] . '</h3>
									</div>
								</div>
								<div class="one-eight text-center">
									<div class="display-tc">
										<input type="text" name="price_' . $productId . '" id="price_' . $productId . '" class="form-control input-number text-center" value="' . $product['price'] . '" readonly>
									</div>
								</div>
								<div class="one-eight text-center">
									<div class="display-tc">
										<input type="text" id="quantity_' . $productId . '" name="quantity_' . $productId . '" class="form-control input-number text-center" oninput="amountValue(' . $productId . ')" >
									</div>
								</div>
								<div class="one-eight text-center">
									<div class="display-tc">
										<input type="text" name="total_' . $productId . '" id="total_' . $productId . '" class="form-control input-number text-center" placeholder="Amount" readonly>
									</div>
								</div>
								<div class="one-eight text-center">
									<div class="display-tc">
									<a href="delete_page.php?remove_id=' . $productId . '" class="closed"></a>
									</div>
								</div>
								</div>
								';
							}
						} else {
							echo '<p>No product details found in the session.</p>';
						}
						?>

				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="total-wrap">
							<div class="row">
								<div class="col-sm-8">
										<div class="row form-group">
											<div class="col-sm-3">
												<a href="index.php" class="btn btn-primary">Continue Shopping</a>
											</div>
										</div>
								</div>
								<div class="col-sm-4 text-center">
									<div class="total">
										<!-- Update the HTML section where subtotal and total are displayed -->
										<div class="sub">
											<p><span>Subtotal:</span> <span id="subtotal"></span></p>
											<p><span>Delivery:</span> <span>NGN 0.00</span></p>
											<p><span>Discount:</span> <span>NGN 45.00</span></p>
										</div>
										<div class="grand-total">
											<p><span><strong>Total:</strong></span> <span id="total"></span></p>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
						<h2>Related Products</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="#" class="prod-img">
								<img src="images/item-1.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
							</a>
							<div class="desc">
								<h2><a href="#">Women's Boots Shoes Maca</a></h2>
								<span class="price">$139.00</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="#" class="prod-img">
								<img src="images/item-2.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
							</a>
							<div class="desc">
								<h2><a href="#">Women's Minam Meaghan</a></h2>
								<span class="price">$139.00</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="#" class="prod-img">
								<img src="images/item-3.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
							</a>
							<div class="desc">
								<h2><a href="#">Men's Taja Commissioner</a></h2>
								<span class="price">$139.00</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="#" class="prod-img">
								<img src="images/item-4.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
							</a>
							<div class="desc">
								<h2><a href="#">Russ Men's Sneakers</a></h2>
								<span class="price">$139.00</span>
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
</html>

