<?php
session_start();
include 'database_connection.php';
include 'search.php';

$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;

?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>About Us Page</title>
	<?php include 'link.html';?>

	<style>
		.remv-marg
		{
			margin: -5rem 0px -7rem 0px;
		}

		.remv-marg1
		{
			margin: -15rem 0px -7rem 0px;
		}

		h2
		{
			text-align: center;
		}
		
	</style>

	</head>
	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">
		<?php include 'navigation.php';?>

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.html">Home</a></span> / <span>About</span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-about remv-marg">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-sm-6 mb-3">
						<div class="video colorlib-video" style="background-image: url(images/about.jpg);">
							<a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-play3"></i></a>
							<div class="overlay"></div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="about-wrap">
								<h2>About Jolayemi Footwear Empire</h2>

								<p>Welcome to Jolayemi Footwear Empire, where every step is a statement! We're not just a shoe store; we're a destination for fashion enthusiasts and footwear aficionados. Our journey began with a passion for footwear and a dream to provide people with the perfect pair for every occasion.</p>

								<h2>Our Mission</h2>

								<p> At Jolayemi Footwear Empire, our mission is clear: to help you put your best foot forward. We believe that the right pair of shoes can transform an outfit, boost your confidence, and tell a unique story about your style. Our goal is to curate an extensive collection of high-quality footwear that complements your individuality.</p>
						</div>
					</div>
					<div class="col-sm-6">
						<h2>What Sets Us Apart</h2>

						<p> What makes Jolayemi Footwear Empire stand out is our commitment to delivering a diverse range of footwear that suits every taste, need, and budget. From trendy sneakers to elegant formal shoes and everything in between, we take pride in offering a selection that caters to various styles and preferences.</p>

						<h2>Our Team</h2>

						<p> Behind every pair of shoes we offer is a team of dedicated individuals who are passionate about footwear and customer satisfaction. Our team is driven by a shared belief in the power of exceptional footwear to elevate your everyday experiences.</p>
					</div>
					<div class="col-sm-6">
						<div class="about-wrap">

							<h2>Quality and Craftsmanship </h2>

							<p> We understand the importance of quality, comfort, and style. That's why we partner with some of the best manufacturers to ensure that each shoe we sell is a testament to fine craftsmanship and exceptional materials. You can trust that every shoe you find at Jolayemi Footwear Empire is designed to make you look and feel your best.</p>

							<h2>Our Commitment to You</h2>

							<p>Jolayemi Footwear Empire is more than a shoe store; it's a reflection of our commitment to providing you with a seamless shopping experience. Whether you're looking for the perfect pair for a special occasion or everyday wear, we're here to assist you every step of the way.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-about remv-marg1">
			<div class="container">
				<h2>Join Us on Our Journey</h2>

				<p>We invite you to join us on this exciting journey through the world of footwear. Whether you're a seasoned shoe collector, a fashion enthusiast, or someone in search of the ideal pair, we welcome you to explore our collection, find the perfect fit, and be a part of the Jolayemi Footwear Empire family.</p> 

				<p>Thank you for choosing Jolayemi Footwear Empire. Your style, your journey, your footwear – it all begins here.</p>
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

	</body>
</html>

