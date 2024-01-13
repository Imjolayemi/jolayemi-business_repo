<?php
session_start();
include 'database_connection.php';
include 'search.php';

$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;

function query($retrieve, $connect)
{
	$qry = mysqli_query($connect, $retrieve) or die("Cannot insert to table".mysqli_connect_error());
	return $qry;
}

function display($retrieve, $detail, $connect)
{
	$query = query($retrieve, $connect);
	while($row = mysqli_fetch_array($query)){
		print '
		<div class="col-lg-4 mb-4 text-center">
			<div class="product-entry border">
				<a href="product-detail.php? id='.$row['ID'].'" class="prod-img">
                    <img src="upload/'. $row['front_image'] . '"class="img-fluid" id="image">
				</a>
				<div class="desc">
						<h2><a href="product-detail.php? id='.$row['ID'].'">'. $row['product_name'] .'</a></h2>
					<span class="price"> #'. $row['price'] .'</span>
				</div>
                <div class="desc">
						<h2><a href="product-detail.php? id='.$row['ID'].'">'. $detail .'</a></h2>
				</div>
			</div>
		</div>';}
}
?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>Women Page</title>
	<?php include 'link.html';?>

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

			<?php include 'navigation.php';?>

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
									$query = query($retrieve, $connect);
									
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
											$query = query($retrieve, $connect);
											
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
											$query = query($retrieve, $connect);
											
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
											$query = query($retrieve, $connect);
											
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
                            display($retrieve, $detail, $connect);
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
</html>

