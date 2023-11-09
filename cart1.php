<?php
// session_start();

// $front_img = $_SESSION['front_image'];
// $product_name = $_SESSION['product_name'];
// $price = $_SESSION['price'];
// $_SESSION['i'] = 0;


// if (!isset($_SESSION['main_arr'])) {
//     $_SESSION['main_arr'] = [];
// }

// if (empty($_SESSION['product_name'])) {
//     header("Location: index.php");
//     exit;
// }

// $newProduct = [
//     'id' => count($_SESSION['main_arr']),
//     'front_image' => $_SESSION['front_image'],
//     'product_name' => $_SESSION['product_name'],
//     'price' => $_SESSION['price']
// ];

// $_SESSION['main_arr'][] = $newProduct;
// // print_r($_SESSION['main_arr']);
// // print "<br>________________<br>";


// if (!isset($_SESSION['img']) && !isset($_SESSION['name']) && !isset($_SESSION['amount']))
// {
// 	$_SESSION['num'] = [];
//     $_SESSION['img']= [];
// 	$_SESSION['name'] = [];
// 	$_SESSION['amount'] = [];
// }

// while ($_SESSION['i'] <= count($_SESSION['num'])) $_SESSION['i']++;

// $_SESSION['num'][]= $_SESSION['i'] - 1;
// $_SESSION['img'][] = $front_img;
// $_SESSION['name'][] = $product_name;
// $_SESSION['amount'][] = $price;

// // print_r($_SESSION['num']);
// // print "<br>________________<br>";
// // print_r($_SESSION['img']);
// // print "<br>________________<br>";
// // print_r($_SESSION['name']);
// // print "<br>________________<br>";
// // print_r($_SESSION['amount']);

// for ($i = 0; $i < count($_SESSION['num']); $i++)
// {
// 	// print '<input type="submit" name="delete_' . $i . '" id="delete_' . $i . '" class="form-control input-number text-center" value="delete_' . $i . '">';
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     foreach ($_POST as $key => $value) {
//         if (strpos($key, 'delete_') !== false) {
//             $index = (int)substr($key, strlen('delete_'));
//             if (isset($_SESSION['main_arr'][$index])) {
//                 unset($_SESSION['main_arr'][$index]);
//             }
//         }
//     }

//     // Re-index the session array
//     $_SESSION['main_arr'] = array_values($_SESSION['main_arr']);
// }

session_start();

// Check if there are existing main_arr and initialize it if not
if (!isset($_SESSION['main_arr'])) {
    $_SESSION['main_arr'] = [];
}

// If product details are empty, redirect to index.php
if (empty($_SESSION['product_name'])) {
    header("Location: index.php");
    exit;
}

// Create a new product object
$newProduct = [
    'id' => count($_SESSION['main_arr']),
    'front_image' => $_SESSION['front_image'],
    'product_name' => $_SESSION['product_name'],
    'price' => $_SESSION['price']
];

// Add the new product to the main_arr
$_SESSION['main_arr'][] = $newProduct;

// Check if the POST method is invoked
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'delete_') !== false) {
            $index = (int)substr($key, strlen('delete_'));
            if (isset($_SESSION['main_arr'][$index])) {
                unset($_SESSION['main_arr'][$index]);
            }
        }
    }

    // Re-index the session array
    $_SESSION['main_arr'] = array_values($_SESSION['main_arr']);
}

?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>Jolayemi Footwear - Cart Page</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <script src="cart.js"></script>

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
			            <form action="#" class="search-wrap">
			               <div class="form-group">
			                  <input type="search" class="form-control search" placeholder="Search">
			                  <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
			               </div>
			            </form>
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
								<li class="cart"><a href="cart.php" class="icon-shopping-cart">Cart [<?= count($_SESSION['main_arr']); ?>]</a></li>
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
								<span>Total</span>
							</div>
							<div class="one-eight text-center px-4">
								<span>Remove</span>
							</div>
						</div>
						
						<?php
							if (!empty($_SESSION['main_arr'])) {
								foreach ($_SESSION['main_arr'] as $key => $product) {
									echo create_product_html($product['id'], $product['front_image'], $product['product_name'], $product['price']);
								}
							}

							/* if (!empty($_SESSION['num']))
							{
								for ($a = 0; $a < count($_SESSION['num']); $a++) {
									echo create_product_html($a."M", $_SESSION['img'][$a], $_SESSION['name'][$a], $_SESSION['amount'][$a]);
								}
							}
 */
						function create_product_html($id, $front_image, $product_name, $price)
						{
							
							return '<form method="POST">
							<div class="product-cart d-flex" id="product_' . $id . '">
									<div class="one-forth">
									<div class="product-img" style="background-image: url(upload/' . $front_image . ')">
									</div>
									<div class="display-tc">
										<h3>' .$id . $product_name . '</h3>
									</div>
								</div>
								<div class="one-eight text-center">
									<div class="display-tc">
										<input type="text" name="price_' . $id . '" id="price_' . $id . '" class="form-control input-number text-center" value="' . $price . '" readonly>
									</div>
								</div>
								<div class="one-eight text-center">
									<div class="display-tc">
										<input type="text" id="quantity_' . $id . '" name="quantity_' . $id . '" class="form-control input-number text-center" oninput="amountValue(' . $id . ')">
									</div>
								</div>
								<div class="one-eight text-center">
									<div class="display-tc">
										<input type="text" name="total_' . $id . '" id="total_' . $id . '" class="form-control input-number text-center" placeholder="Total" readonly>
									</div>
								</div>
								<div class="one-eight text-center">
									<div class="display-tc">
									<button type="submit" name="delete_' . $id . '">Delete</button>
									
									</div>
								</div>
								</div>
								</form>';
						}
						?>
		
					</div>
				</div>
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="total-wrap">
							<div class="row">
								<div class="col-sm-8">
									<form action="#">
										<div class="row form-group">
											<div class="col-sm-3">
											<a href="index.php" class="btn btn-primary">Continue Shopping</a>
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-4 text-center">
									<div class="total">
										<div class="sub">
											<p><span>Subtotal:</span> <span>$200.00</span></p>
											<p><span>Delivery:</span> <span>$0.00</span></p>
											<p><span>Discount:</span> <span>$45.00</span></p>
										</div>
										<div class="grand-total">
											<p><span><strong>Total:</strong></span> <span>$450.00</span></p>
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
						<h4>About Footwear</h4>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
						<p>
							<ul class="colorlib-social-icons">
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-linkedin"></i></a></li>
								<li><a href="#"><i class="icon-dribbble"></i></a></li>
							</ul>
						</p>
					</div>
					<div class="col footer-col colorlib-widget">
						<h4>Customer Care</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="#">Contact</a></li>
								<li><a href="#">Returns/Exchange</a></li>
								<li><a href="#">Gift Voucher</a></li>
								<li><a href="#">Wishlist</a></li>
								<li><a href="#">Special</a></li>
								<li><a href="#">Customer Services</a></li>
								<li><a href="#">Site maps</a></li>
							</ul>
						</p>
					</div>
					<div class="col footer-col colorlib-widget">
						<h4>Information</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="#">About us</a></li>
								<li><a href="#">Delivery Information</a></li>
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Support</a></li>
								<li><a href="#">Order Tracking</a></li>
							</ul>
						</p>
					</div>

					<div class="col footer-col">
						<h4>News</h4>
						<ul class="colorlib-footer-links">
							<li><a href="blog.html">Blog</a></li>
							<li><a href="#">Press</a></li>
							<li><a href="#">Exhibitions</a></li>
						</ul>
					</div>

					<div class="col footer-col">
						<h4>Contact Information</h4>
						<ul class="colorlib-footer-links">
							<li>291 South 21th Street, <br> Suite 721 New York NY 10016</li>
							<li><a href="tel://1234567920">+ 1235 2355 98</a></li>
							<li><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span> 
							<span class="block">Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a> , <a href="http://pexels.com/" target="_blank">Pexels.com</a></span>
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

	
	</body>
</html>