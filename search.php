<?php
// Function to convert input to lowercase
function convertToLowerCase($input) {
    return strtolower($input);
}

// Process user input
if (isset($_POST['srch_btn'])) {
    $searchTerm = convertToLowerCase($_POST['search']);
    
    // Query to search for the product in the database
    $sql = "SELECT * FROM footwear_info WHERE LOWER(product_name) LIKE '%$searchTerm%'";
    $result = mysqli_query($connect, $sql) or die("Cannot insert to table".mysqli_connect_error());

    // Check if any matching products are found
    if (mysqli_num_rows($result) > 0) {
        // Display the matching products
        while ($row = mysqli_fetch_assoc($result)) {
            // echo "Product Name: " . $row['product_name'] . "<br>";
             header("Location: favorite.php?brand=".urlencode($searchTerm));
            // You can display other product details here
        }
    } else {
        // Display a message if no matching products are found
        echo "Product with the name '$searchTerm' is unavailable.";
    }
}

// // Close the database connection
// mysql_close($conn);
?>