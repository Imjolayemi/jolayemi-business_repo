<?php
session_start();
include 'database_connection.php';
include 'search.php';

$_SESSION['brand'] = $_GET['brand'];


print $_SESSION['brand'];
$searchTerm = $_SESSION['brand'];

$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;

$retrieve = "SELECT * FROM footwear_info WHERE LOWER(product_name) LIKE '%$searchTerm%'";
$qry = mysqli_query($connect, $retrieve) or die("Cannot process to table".mysqli_connect_error($connect));
?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>Jolayemi Footwear - Reciept page</title>

	<?php include 'link.html';?>

	<style>
        .receipt {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }

		.download-button {
            margin-top: 20px;
            text-align: center;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

		.order-id {
            text-align: right;
        }

        .contact-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .email, .phone {
            width: 48%; /* Adjust as needed */
        }

        #image{
            width: 100%; /* Set your desired width in pixels */
            height: 300px; /* Set your desired height in pixels */ 
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
						<p class="bread"><span><a href="index.php">Home</a></span> / <span>Reciept</span></p>
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
			</div>

				<!-- <div class="colorlib-product"> -->
					<div class="container">
						<div class="row">
							<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
								<h2>"<?= $_SESSION['brand']; ?> Products"</h2>
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
					</div>
				<!-- </div> -->
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

