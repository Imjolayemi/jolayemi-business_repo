<?php
// session_start();

// if (isset($_GET['delete'])) {
//     $delete_id = $_GET['delete'];

//     foreach ($_SESSION['main_arr'] as $key => $product) {
//         if ($product['id'] == $delete_id) {
//             // Remove the product with the matching ID
//             unset($_SESSION['main_arr'][$key]);
//         }
//     }
// }



/* if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    for ($a = 0; $a < count($_SESSION['num']); $a++) {
        if ($_SESSION['num'][$a] == $delete_id) {
            // Remove the product with the matching ID
            unset($_SESSION['num'][$a]);
        }
    }
} */

// header("Location: cart.php")



// <a href="delete_page.php?delete='. $id .'" class="delete-btn">Delete</a>
session_start();

if (isset($_GET['remove_id'])) {
    $removeID = $_GET['remove_id'];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        // Iterate through the cart to find the matching item and remove it
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['id'] == $removeID) {
                unset($_SESSION['cart'][$key]);
                // Update the cart count in the session
                $_SESSION["total"] = 0;
                foreach ($_SESSION['cart'] as $product) {
                    $_SESSION["total"] += $product['price'];
                }
                $_SESSION["arr_count"] = count($_SESSION['cart']);
                break; // Stop the loop after removing the item
            }
        }
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit;
?>

