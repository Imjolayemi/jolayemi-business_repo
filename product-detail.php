<?php
session_start();

// Include the database connection
$connect = include 'database_connection.php';

if (isset($_GET["id"])) {
    $productId = intval($_GET["id"]);

    // Retrieve product information from the database
    $retrieve = "SELECT * FROM footwear_info WHERE ID = $productId";
    $qry = mysqli_query($connect, $retrieve) or die("Cannot connect to table" . mysqli_connect_error($connect));

    while ($row = mysqli_fetch_assoc($qry)) {
        $product_id = $row['ID'];
        $product_name = $row['product_name'];
        $product_category = $row['product_category'];
        $product_price = $row['price'];
        $product_size = $row['size'];
        $product_color = $row['color'];
        $product_front_image = $row['front_image'];
        $product_back_image = $row['back_image'];
        $product_style = $row['style'];
    }
}

$cart_count = isset($_SESSION["arr_count"]) ? $_SESSION["arr_count"] : 0;

// Function to check if a product already exists in the cart
function productExistsInCart($productId) {
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            if ($product['id'] == $productId) {
                return true; // Product exists in the cart
            }
        }
    }
    return false; // Product doesn't exist in the cart
}

if (isset($_POST['add_to_cart'])) {
    if (isset($_GET["id"])) {
        $productId = intval($_GET["id"]);

        if (productExistsInCart($productId)) {
            // Product already exists in the cart
            echo '<script>alert("This product is already in your cart.");</script>';
            // Redirect to the quantity input in the cart page
            echo '<script>window.location = "cart.php#quantity_' . $productId . '";</script>';
            exit;
        } else {
            // Product doesn't exist in the cart, add the product to the cart
            // Add your logic here to add the product to the cart session array
            $product = array(
                'id' => $product_id,
                'product_name' => $product_name,
                'product_category' => $product_category,
                'price' => $product_price,
                'size' => $product_size,
                'color' => $product_color,
                'front_image' => $product_front_image,
                'back_image' => $product_back_image,
                'style' => $product_style
            );

            // Check if the 'cart' session variable is set
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                // Append the new product to the existing cart array
                $_SESSION['cart'][] = $product;
            } else {
                // If the cart doesn't exist, create it and add the product
                $_SESSION['cart'] = array($product);
            }

            $_SESSION["total"] = 0;
            foreach ($_SESSION['cart'] as $product) {
                $_SESSION["total"] += $product['price'];
            }

            // Update the cart count
            $_SESSION["arr_count"] = count($_SESSION['cart']);

			echo '<script>window.location = "cart.php";</script>';
            exit;
        }
    } else {
        header("Location: index.php");
        exit();
    }
}
?>



<!DOCTYPE HTML>
<html>
	<head>
	<title>Product Details</title>
	
	<?php include 'link.html';?>

	<style>
        #image{
            width: 100%; /* Set your desired width in pixels */
            height: 600px; /* Set your desired height in pixels */ 
        }
    </style>

	</head>
	<body>
		<form action="" method="post">
	<div class="colorlib-loader"></div>
	<div id="page">

	<?php include 'navigation.php';?>

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Home</a></span> / <span>Product Details</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg product-detail-wrap">
					<div class="col-sm-8">
						<div class="owl-carousel">
							<div class="item">
								<div class="product-entry border">
									<a href="#" class="prod-img">
									<img src="upload/<?= $product_front_image; ?>" class="img-fluid" id="image">
									</a>
								</div>
							</div>
							<div class="item">
								<div class="product-entry border">
									<a href="#" class="prod-img">
									<img src="upload/<?= $product_back_image; ?>" class="img-fluid" id="image">
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-desc">
							<h3><?= $product_name; ?></h3>
							<p class="price">
								<span><?= "#".$product_price; ?></span>
								<span class="rate">
									<i class="icon-star-full"></i>
									<i class="icon-star-full"></i>
									<i class="icon-star-full"></i>
									<i class="icon-star-full"></i>
									<i class="icon-star-half"></i>
									(74 Rating)
								</span>
							</p>
							<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
							<div class="size-wrap">
								<div class="block-26 mb-2">
											<h4>Size</h4>
									<ul>
										<li> <?= $product_size; ?> </li>
									</ul>
								</div>
							</div>
				        </div>
						<div class="row">
	                  	<div class="col-sm-12 text-center">
							<p class="addtocart"><button type="submit" class="btn btn-primary btn-addtocart icon-shopping-cart"  name="add_to_cart" >Add to Cart</button></p> 
							
							<!-- <i class="icon-shopping-cart">Add to Cart</i> -->
						</div>
					</div>
					</div>
				</div>


				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-md-12 pills">
								<div class="bd-example bd-example-tabs">
								  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

								    <li class="nav-item">
								      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Description</a>
								    </li>
								    <li class="nav-item">
								      <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Manufacturer</a>
								    </li>
								    <li class="nav-item">
								      <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-expanded="true">Review</a>
								    </li>
								  </ul>

								  <div class="tab-content" id="pills-tabContent">
								    <div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
								      <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
										<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
										<ul>
											<li>The Big Oxmox advised her not to do so</li>
											<li>Because there were thousands of bad Commas</li>
											<li>Wild Question Marks and devious Semikoli</li>
											<li>She packed her seven versalia</li>
											<li>tial into the belt and made herself on the way.</li>
										</ul>
								    </div>

								    <div class="tab-pane border fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
								      <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
										<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
								    </div>

								    <div class="tab-pane border fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
								      <div class="row">
								   		<div class="col-md-8">
								   			<h3 class="head">23 Reviews</h3>
								   			<div class="review">
										   		<div class="user-img" style="background-image: url(images/person1.jpg)"></div>
										   		<div class="desc">
										   			<h4>
										   				<span class="text-left">Jacob Webb</span>
										   				<span class="text-right">14 March 2018</span>
										   			</h4>
										   			<p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-half"></i>
										   					<i class="icon-star-empty"></i>
									   					</span>
									   					<span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
										   			</p>
										   			<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
										   		</div>
										   	</div>
										   	<div class="review">
										   		<div class="user-img" style="background-image: url(images/person2.jpg)"></div>
										   		<div class="desc">
										   			<h4>
										   				<span class="text-left">Jacob Webb</span>
										   				<span class="text-right">14 March 2018</span>
										   			</h4>
										   			<p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-half"></i>
										   					<i class="icon-star-empty"></i>
									   					</span>
									   					<span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
										   			</p>
										   			<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
										   		</div>
										   	</div>
										   	<div class="review">
										   		<div class="user-img" style="background-image: url(images/person3.jpg)"></div>
										   		<div class="desc">
										   			<h4>
										   				<span class="text-left">Jacob Webb</span>
										   				<span class="text-right">14 March 2018</span>
										   			</h4>
										   			<p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-half"></i>
										   					<i class="icon-star-empty"></i>
									   					</span>
									   					<span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
										   			</p>
										   			<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
										   		</div>
										   	</div>
								   		</div>
								   		<div class="col-md-4">
								   			<div class="rating-wrap">
									   			<h3 class="head">Give a Review</h3>
									   			<div class="wrap">
										   			<p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					(98%)
									   					</span>
									   					<span>20 Reviews</span>
										   			</p>
										   			<p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-empty"></i>
										   					(85%)
									   					</span>
									   					<span>10 Reviews</span>
										   			</p>
										   			<p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-empty"></i>
										   					<i class="icon-star-empty"></i>
										   					(70%)
									   					</span>
									   					<span>5 Reviews</span>
										   			</p>
										   			<p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-empty"></i>
										   					<i class="icon-star-empty"></i>
										   					<i class="icon-star-empty"></i>
										   					(10%)
									   					</span>
									   					<span>0 Reviews</span>
										   			</p>
										   			<p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-empty"></i>
										   					<i class="icon-star-empty"></i>
										   					<i class="icon-star-empty"></i>
										   					<i class="icon-star-empty"></i>
										   					(0%)
									   					</span>
									   					<span>0 Reviews</span>
										   			</p>
										   		</div>
									   		</div>
								   		</div>
								   	</div>
								    </div>
								  </div>
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

	<!-- <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		}); 
	</script> -->
	</form>
	<?php mysqli_close($connect); ?>
	</body>
</html>

