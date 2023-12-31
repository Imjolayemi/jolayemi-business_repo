<?php
session_start();

$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;

function query($retrieve)
{
	$connect = include 'database_connection.php';
	$qry = mysqli_query($connect, $retrieve) or die("Cannot insert to table".mysqli_connect_error());
	return $qry;
}

function display($retrieve, $detail)
{
	$query = query($retrieve);
	while($row = mysqli_fetch_array($query)){
		print '
		<div class="col-lg-4 mb-4 text-center">
			<div class="product-entry border">
				<a href="#" class="prod-img">
                    <img src="upload/'. $row['front_image'] . '"class="img-fluid" id="image">
				</a>
				<div class="desc">
						<h2><a href="#">'. $row['product_name'] .'</a></h2>
					<span class="price"> #'. $row['price'] .'</span>
				</div>
                <div class="desc">
						<h2><a href="#">'. $detail .'</a></h2>
				</div>
			</div>
		</div>';}
}
?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>Women Page</title>
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
        .button
		{
			border: none;
			background-color: transparent;
		}
		.button:hover
		{
			cursor:pointer;
		}
    </style>

	</head>
	<body>
    <form action="" method="post" enctype="multipart/form-data">
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
										<li><a href="product-detail.html">Product Detail</a></li>
										<li><a href="cart.html">Shopping Cart</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="order-complete.html">Order Complete</a></li>
										<li><a href="add-to-wishlist.html">Wishlist</a></li>
									</ul>
								</li>

								<li class="has-dropdown active">
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

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Home</a></span> / <span>Women</span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="breadcrumbs-two">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs-img" style="background-image: url(images/women.jpg);">
							<h2>Women's</h2>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-xl-3">
						<div class="row">
							<div class="col-sm-12">
								<div class="side border mb-1">
									<h3>Brand</h3>
									<ul>
									<?php
									$retrieve = "SELECT DISTINCT product_name FROM footwear_info WHERE product_category = 'women' ORDER BY product_name";
									$query = query($retrieve);
									
                            		while($row  = mysqli_fetch_array($query)){
										$product = $row['product_name'];
                        			?>
										<li><button name="brand" class="button" value="<?= $product;?>"><?= $product; ?></button></li>
									<?php } ?>
									</ul>
									
								</div>
							</div>
							<div class="col-sm-12">
								<div class="side border mb-1">
									<h3>Size/Width</h3>
									<div class="block-26 mb-2">
										<h4>Size</h4>
										<ul>
										<?php
											$retrieve = "SELECT DISTINCT size FROM footwear_info WHERE product_category = 'women' ORDER BY size";
											$query = query($retrieve);
											
											while($row  = mysqli_fetch_array($query)){
												$size = $row['size'];
											?>
											<li><button name="size" class="button" value="<?= $size;?>"><?= $size; ?></button></li>
											<?php } ?>
										</ul>
					            	</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="side border mb-1">
									<h3>Style</h3>
									<ul>
										<?php
											$retrieve = "SELECT DISTINCT style FROM footwear_info WHERE product_category = 'women' ORDER BY style";
											$query = query($retrieve);
											
											while($row  = mysqli_fetch_array($query)){
												$style = $row['style'];
											?>
											<li><button name="style" class="button" value="<?= $style;?>"><?= $style; ?></button></li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="side border mb-1">
									<h3>Colors</h3>
									<ul>
									<?php
											$retrieve = "SELECT DISTINCT color FROM footwear_info WHERE product_category = 'women' ORDER BY color";
											$query = query($retrieve);
											
											while($row  = mysqli_fetch_array($query)){
												$color = $row['color'];
											?>
											<li><button name="color" class="button" value="<?= $color;?>"><?= $color; ?></button></li>
											<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-xl-9">
						<div class="row row-pb-md">
                            <?php
                            $brand = isset($_POST['brand']) ? $_POST['brand'] : "";
                            $size = isset($_POST['size']) ? $_POST['size'] : "";
                            $style = isset($_POST['style']) ? $_POST['style'] : "";
                            $color = isset($_POST['color']) ? $_POST['color'] : "";

                            $retrieve = "SELECT * FROM footwear_info WHERE product_category = 'women'";
                            $detail = "";

                            if ($brand) {
                                $detail .= $brand." Product";
                                $retrieve .= " AND product_name = '$brand'";
                            } elseif ($size) {
                                $detail .= "Size " .$size;
                                $retrieve .= " AND size = '$size'";
                            } elseif ($style) {
                                $detail .= $style." Style";
                                $retrieve .= " AND style = '$style'";
                            } elseif ($color) {
                                $detail .= $color." Color";
                                $retrieve .= " AND color = '$color'";
                            }
                            display($retrieve, $detail);
						?>
						</div>
                        
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="block-27">
				               <ul>
					               <li><a href="#"><i class="ion-ios-arrow-back"></i></a></li>
				                  <li class="active"><span>1</span></li>
				                  <li><a href="#">2</a></li>
				                  <li><a href="#">3</a></li>
				                  <li><a href="#"><i class="ion-ios-arrow-forward"></i></a></li>
				               </ul>
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
								<!-- <li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Support</a></li>
								<li><a href="#">Order Tracking</a></li> -->
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made by Jolayemi</a>
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

