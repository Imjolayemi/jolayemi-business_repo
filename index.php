<?php
session_start();

$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;


include 'database_connection.php';
$retrieve = "SELECT * FROM footwear_info";
$qry = mysqli_query($connect, $retrieve) or die("Cannot process to table".mysqli_connect_error($connect));

include 'search.php';
?>


<!-- HTML   PAGE -->
<!DOCTYPE HTML>
<html>
	<head>
	<title>Jolayemi Footwear</title>
	<?php include 'link.html';?>

    <style>
        #image{
            width: 100%; /* Set your desired width in pixels */
            height: 300px; /* Set your desired height in pixels */ 
        }
    </style>

	</head>
	<body>
	<form action="" method="post" enctype="multipart/form-data">
	<div class="colorlib-loader"></div>

	<div id="page">
	<?php include 'navigation.php';?>
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
								<h2><a href="wrist_watch.php">Shop Wrist-watch Collection</a></h2>
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
                                    <h2><a href="product-detail.php? id=<?= $row['ID']; ?>"><?php echo $row['product_name'];?></a></h2>
                                    <span class="price"><?php echo 'NGN '. $row['price'];?></span>
                                </div>
                            </div>
                        
                        </div>
                    <?php } mysqli_close($connect); ?>
					
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<p><a href="#" class="btn btn-primary btn-lg">Shop All Products</a></p>
					</div>
				</div>
			</div>
		</div>

		<?php include 'footer.html'; ?>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	</form>
	
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

