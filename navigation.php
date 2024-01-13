<?php
// // Database connection
// // include 'database_connection.php';

// // Check connection
// if (!$connect) {
//     die("Connection failed: " . mysql_error());
// }

// // Function to convert input to lowercase
// function convertToLowerCase($input) {
//     return strtolower($input);
// }

// // Process user input
// if (isset($_POST['srch_btn'])) {
//     $searchTerm = convertToLowerCase($_POST['search']);
    
//     // Query to search for the product in the database
//     $sql = "SELECT * FROM footwear_info WHERE product_name = '$searchTerm'";
//     $result = mysql_query($sql);

//     // Check if any matching products are found
//     if (mysql_num_rows($result) > 0) {
//         // Display the matching products
//         while ($row = mysql_fetch_assoc($result)) {
//             echo "Product Name: " . $row['product_name'] . "<br>";
//             // You can display other product details here
//         }
//     } else {
//         // Display a message if no matching products are found
//         echo "Product with the name '$searchTerm' is unavailable.";
//     }
// }

// // Close the database connection
// mysql_close($conn);
?>

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
                      <input type="search" class="form-control search" placeholder="Search" name="search">
                      <button class="btn btn-primary submit-search text-center" type="submit" name="srch_btn"><i class="icon-search"></i></button>
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
                        <li class="has-dropdown">
                            <a href="wrist_watch.php">Wrist-Watch</a>
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
