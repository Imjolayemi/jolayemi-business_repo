<?php
session_start();
include 'database_connection.php';
include 'search.php';

$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;

if (isset($_SESSION["fname"])){
	$firstName = $_SESSION["fname"];
	$lastName = $_SESSION["lname"];
	$city = $_SESSION["city"];
	$phoneNumber = $_SESSION["number"];
	$email = $_SESSION["email"];
	$state = $_SESSION["state"];
	$order_ID = $_SESSION['randomString'];
    $total = $_SESSION['subtotal'];
}else{
	echo "<script> alert ('No Information Collected!'); </script>";
            header('Location: checkout.php');
            exit();
}


$retrieve = "SELECT * FROM footwear_info";
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


				<div class="row">
					<div class="col-lg-8">
						<div class="receipt" id="receipt">
							<h2>Receipt</h2>

							<h3><center>JOLAYEMI FOOTWEAR</center></h3>
							<p>Name of Customer: <?= $firstName." ".$lastName; ?></p>
							
							<div class="contact-info">
								<div class="email">
									<p>Date and Time: <?php echo date('Y-m-d H:i:s'); ?></p>
								</div>
								<div class="phone">
									<p>Order ID: <?= $order_ID; ?></p>
								</div>
							</div>
							
							<div class="contact-info">
								<div class="email">
									<p>E-mail: <?= $email; ?></p>
								</div>
								<div class="phone">
									<p>phone number: <?= $phoneNumber; ?></p>
								</div>
							</div>
							<table>
								<thead>
									<tr>
										<th>Product Name</th>
										<th>Quantity</th>
										<th>Price</th>
										<th>Total Price</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// // Example products, replace this with your actual data
									// $products = [
									// 	['Product 1', 2, 10.00],
									// 	['Product 2', 1, 15.00],
									// ];

									// $totalPrice = 0;

									// foreach ($products as $product) {
									// 	$productName = $product[0];
									// 	$quantity = $product[1];
									// 	$price = $product[2];
									// 	$totalProductPrice = $quantity * $price;


									// 	echo "<tr>
									// 			<td>$productName</td>
									// 			<td>$quantity</td>
									// 			<td>$price</td>
									// 			<td>$totalProductPrice</td>
									// 		</tr>";
									// }

									foreach ($_SESSION['receipt'] as $productId => $product) {
										echo "<tr>
												<td>{$product['product_name']}</td>
												<td>{$product['quantity']}</td>
												<td>{$product['price']}</td>
												<td>{$product['total']}</td>
											  </tr>";
									}
									?>
								</tbody>
							</table>

							<div class="total">
								<p>Total Price: NGN <?= $total; ?></p>
							</div>

							<h3><center>Thanks For Shopping With Us!</center></h3>

							<div class="download-button">
								<button onclick="downloadReceipt()">Download Receipt</button>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>

				<!-- <div class="colorlib-product"> -->
					<div class="container">
						<div class="row">
							<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
								<h2>Shop More</h2>
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

	<script>
        function downloadReceipt() {
            // var element = document.getElementById('receipt');
            // html2pdf(element);
			window.location.href = "order-complete.php";
        }
    </script>

	</body>
</html>

