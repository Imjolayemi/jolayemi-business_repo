<?php
session_start();

$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;


$connect = include 'database_connection.php';
$retrieve = "SELECT * FROM footwear_info";
$qry = mysqli_query($connect, $retrieve) or die("Cannot insert to table".mysqli_connect_error());
?>


<!-- HTML   PAGE -->
<!DOCTYPE HTML>
<html>
	<head>
	<title>Jolayemi Footwear</title>
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
        #image{
            width: 100%; /* Set your desired width in pixels */
            height: 300px; /* Set your desired height in pixels */ 
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
							<div id="colorlib-logo"><a href="index.php">Jolayemi Footwear</a></div>
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
								<li class="active"><a href="index.php">Home</a></li>
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
								<li class="has-dropdown">
									<a href="Women.php">Women</a>
								</li>
								<li class="has-dropdown">
									<a href="kid.php">Kids</a>
								</li>
								<li><a href="about.php">About</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li class="cart"><a href="cart.php"><i class="icon-shopping-cart"></i> Cart [<?= $cart_count; ?>]</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

		</nav>
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">

					<li style="background-image: url(images/img_bg_1.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-6 offset-sm-3 text-center slider-text">
									<div class="slider-text-inner">
										<div class="desc">
											<h1 class="head-1">Men's</h1>
											<h2 class="head-2">Shoes</h2>
											<h2 class="head-3">Collection</h2>
											<p class="category"><span>Men's New trending shoes</span></p>
											<p><a href="men.php" class="btn btn-primary">Shop Collection</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>

					<li style="background-image: url(images/img_bg_2.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-6 offset-sm-3 text-center slider-text">
									<div class="slider-text-inner">
										<div class="desc">
											<h1 class="head-1">Women's</h1>
											<h2 class="head-2">Shoes</h2>
											<h2 class="head-3">Collection</h2>
											<p class="category"><span>Women's New trending shoes</span></p>
											<p><a href="women.php" class="btn btn-primary">Shop Collection</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					
					<li style="background-image: url(images/item-1.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-6 offset-sm-3 text-center slider-text">
									<div class="slider-text-inner">
										<div class="desc">
											<h1 class="head-1">Kid's</h1>
											<h2 class="head-2">Shoes</h2>
											<h2 class="head-3">Collection</h2>
											<p class="category"><span>Kid's New trending shoes</span></p>
											<p><a href="kid.php" class="btn btn-primary">Shop Collection</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>

					<li style="background-image: url(images/wrist-watch0.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-6 offset-sm-3 text-center slider-text">
									<div class="slider-text-inner">
										<div class="desc">
											<h1 class="head-1">New</h1>
											<h2 class="head-2">Arrival</h2>
											<h2 class="head-3">up to <strong class="font-weight-bold">30%</strong> off</h2>
											<p class="category"><span>New stylish wrist-watch for all</span></p>
											<p><a href="wrist_watch.php" class="btn btn-primary">Shop Collection</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>

			  	</ul>
		  	</div>
		</aside>
		
		<div class="colorlib-product">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6 text-center">
						<div class="featured">
							<a href="men.php" class="featured-img" style="background-image: url(images/men.jpg);"></a>
							<div class="desc">
								<h2><a href="men.php">Shop Men's Collection</a></h2>
							</div>
						</div>
					</div>

					<div class="col-sm-6 text-center">
						<div class="featured">
							<a href="women.php" class="featured-img" style="background-image: url(images/women.jpg);"></a>
							<div class="desc">
								<h2><a href="women.php">Shop Women's Collection</a></h2>
							</div>
						</div>
					</div>

					<div class="col-sm-6 text-center">
						<div class="featured">
							<a href="kid.php" class="featured-img" style="background-image: url(images/item-3.jpg);"></a>
							<div class="desc">
								<h2><a href="kid.php">Shop Kid's Collection</a></h2>
							</div>
						</div>
					</div>

					<div class="col-sm-6 text-center">
						<div class="featured">
							<a href="#" class="featured-img" style="background-image: url(images/Wrist-watch0.jpg);"></a>
							<div class="desc">
								<h2><a href="#">Shop Wrist-watch Collection</a></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
						<h2>Best Sellers</h2>
					</div>
				</div>
				<div class="row row-pb-md">
                    <?php 
                        while($row  = mysqli_fetch_array($qry)){
                    ?>
                        <div class="col-lg-3 mb-4 text-center">
                            <div class="product-entry border">
                                <a href="product-detail.php? id=<?= $row['ID']; ?>" class="prod-img">
                                    <?php echo '
                                    <img src="upload/'.$row['front_image'].'" class="img-fluid" id="image">';?>
                                </a>
                                <div class="desc">
                                    <h2><a href="product-detail.php"><?php echo $row['product_name'];?></a></h2>
                                    <span class="price"><?php echo '#'. $row['price'];?></span>
                                </div>
                            </div>
                        
                        </div>
                    <?php } ?>
					
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<p><a href="#" class="btn btn-primary btn-lg">Shop All Products</a></p>
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
								<li><a href="contact.php">Contact</a></li>
								<li><a href="#">Customer Services</a></li>
							</ul>
						</p>
					</div>
					<div class="col footer-col colorlib-widget">
						<h4>Information</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="about.php">About us</a></li>
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

	</body>
</html>

