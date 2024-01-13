<?php
// Start the session to access session variables
session_start();
include 'database_connection.php';
include 'search.php';

$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;

$_SESSION['total_copy'] = "";


// var_dump($_SESSION);
// print "<br>________________<br>";


$retrieve = "SELECT * FROM footwear_info";
$qry = mysqli_query($connect, $retrieve) or die("Cannot insert to table".mysqli_connect_error($connect));


// echo '
// <script>
// var products = ' . json_encode($_SESSION['receipt']) . ';

    
//     for (var productId in products) {
//         if (products.hasOwnProperty(productId)) {
//             var product = products[productId];
// 			if ( product.quantity == null){
// 				continue
// 			}
// 			else{
//             alert("Product Name: " + product.product_name +
//                   "\\nQuantity: " + product.quantity +
//                   "\\nPrice: " + product.price +
//                   "\\nTotal: " + product.total);
// 			}
//         }
//     } </script>';

?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>Jolayemi Footwear - Cart Page</title>

	<?php include 'link.html';?>

	<style>
        #image{
            width: 100%; /* Set your desired width in pixels */
            height: 300px; /* Set your desired height in pixels */ 
        }
		#total_1{
			background: none;
			border: none;
		}

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

		.qty_box0{
			display: flex;
			justify-content: center;
			align-items: center;
			padding-top: 2em;
		}

		.qty_box1{
			display: flex;
			flex-wrap: wrap;
			flex-direction: row;
			/* align-items: center; */
			/* background-color: grey; */
		}
		.qty_box1 button{
			display: flex;
			flex-wrap: wrap;
			margin: 0;
			border: none;
			margin-left: 0; 
		}
    </style>

	</head>
	<body>
	<form action="cart.php" method="post" enctype="multipart/form-data">
	<div class="colorlib-loader"></div>
	<div id="page">

	<?php include 'navigation.php';?>

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

							if (empty($_SESSION['cart'])) {
								echo '<p>No product details found in the session.</p>';
							}else{
								foreach ($_SESSION['cart'] as $product) {
									$productId = $product['id'];

									 
									
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
									<div class="one-eight text-center qty_box0">
										<div class="display qty_box1">
											<input type="text" id="quantity_' . $productId . '" name="quantity_' . $productId . '" class="form-control input-number text-center" oninput="amountValue(' . $productId . ')" >
											<button href="#" class="">SET</button>
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

									// $_SESSION['receipt'][$productId]['product_name'] = $product['product_name'];
									// $_SESSION['receipt'][$productId]['quantity'] = $_POST['quantity_' . $productId];
									// $_SESSION['receipt'][$productId]['price'] = $product['price'];
									// $_SESSION['receipt'][$productId]['total'] = $_POST['total_' . $productId];

									// Retrieve values from local storage
									$quantityKey = 'quantity_' . $productId;
									$totalKey = 'total_' . $productId;
						
									// Set default values to zero if not found
									$quantity = isset($_POST[$quantityKey]) ? $_POST[$quantityKey] : (isset($_SESSION['receipt'][$productId]['quantity']) ? $_SESSION['receipt'][$productId]['quantity'] : 1);
									$total = isset($_POST[$totalKey]) ? $_POST[$totalKey] : (isset($_SESSION['receipt'][$productId]['total']) ? $_SESSION['receipt'][$productId]['total'] : 1);
						
									// Assign values to session variables
									$_SESSION['receipt'][$productId]['product_name'] = $product['product_name'];
									$_SESSION['receipt'][$productId]['quantity'] = $quantity;
									$_SESSION['receipt'][$productId]['price'] = $product['price'];
									$_SESSION['receipt'][$productId]['total'] = $total;
								}
								
							}
							
						}else {
							echo '<p>No product details found in the session.</p>';
						}


// 						echo '
// <script>
// var products = ' . json_encode($_SESSION['receipt']) . ';

    
//     for (var productId in products) {
//         if (products.hasOwnProperty(productId)) {
//             var product = products[productId];
// 			if ( product.quantity == null){
// 				continue
// 			}
// 			else{
//             alert("Product Name: " + product.product_name +
//                   "\\nQuantity: " + product.quantity +
//                   "\\nPrice: " + product.price +
//                   "\\nTotal: " + product.total);
// 			}
//         }
//     }

// </script>
// ';
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
											<p><span><strong>Total:</strong></span><span id=""><input type="text" name="total_1" id="total_1" readonly></span></p>
											<input type="hidden" name="total_copy" id="total_copy" readonly>

										</div>
										<div class="sub"></div>
										<div class="col-sm-8">
										<div class="row form-group" style="margin: Auto 50px;">
											<div class="col-sm-3">

												<a href="#" class="btn btn-primary" onclick="redirectToSecondPage()" id="nextButton">Check Out Order</a>

											</div>

											<div class="col-sm-3">
												<!-- <button class="btn btn-primary" onclick="redirectToSecondPage()" id="nextButton">Check Out Order </button> -->

												<!-- <button class="btn btn-primary" onclick="displayValues()">Confirm Order</button> -->
											</div>

											
										</div>
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
				
					<?php
						
                        while($row  = mysqli_fetch_array($qry)){
                    ?>
                        <div class="col-md-3 col-lg-3 mb-4 text-center">
                            <div class="product-entry border">
                                <a href="product-detail.php? id=<?= $row['ID']; ?>" class="prod-img">
                                    <?php echo '
                                    <img src="upload/'.$row['front_image'].'" class="img-fluid" id="image">';?>
                                </a>
                                <div class="desc">
                                    <h2><a href="product-detail.php"><?php echo $row['product_name'];?></a></h2>
                                    <span class="price"><?php echo 'NGN '. $row['price'];?></span>
                                </div>
                            </div>
                        
                        </div>
                    <?php if (mysqli_fetch_row($qry) == 4)  break; } ?>
					
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

	<script>

function displayValues() {
    alert("You are Welcome");

    // Hide the confirmation button
    document.getElementById('confirmationButton').style.display = 'none';

    // Show the checkout button
    document.getElementById('nextButton').style.display = 'inline-block';
}

function redirectToSecondPage() {
    var totalValue = +document.getElementById('total_copy').value;

    if (totalValue > 0) {

        // Reload the current page
		window.location.href = 'confirm_checkout.php?subtotal=' + encodeURIComponent(totalValue);
    } else {
        alert("Zero Product Added To Your Cart!");
    }
	
}




		
		
// 		function redirectToSecondPage() {
//     var totalValue = +document.getElementById('total_copy').value;

//     if (totalValue > 0) {
//         // console.log("Display Values function is called");
//         alert("You are Welcome");

//         // // Hide the confirmation button
//         // document.getElementById('confirmationButton').style.display = 'none';

//         // // Show the checkout button
//         // document.getElementById('nextButton').style.display = 'inline-block';

//         // // Perform any additional logic for checkout
//         // console.log("Performing Checkout");

//         // Reload the current page or redirect to the checkout page
//         // You can customize this based on your requirements
// 		window.location = 'checkout.php?subtotal=' + encodeURIComponent(totalValue);
//     } else {
//         alert("Zero Product Added To Your Cart!");
//     }
// }

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
			document.getElementById('total_1').value = 'NGN ' + total.toFixed(2); // Update total
			document.getElementById('total_copy').value = total.toFixed(2);
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
		}
	</script>
	</form>
	<?php mysqli_close($connect); ?>
	</body>
</html>

