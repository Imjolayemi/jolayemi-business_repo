<?php
$connect = include '../database_connection.php';

if (isset($_POST["add"]))
{
    $product_name = (isset($_POST["product_name"])) ? strtolower($_POST["product_name"]) : "";
    $product_category = (isset($_POST["product_category"])) ? strtolower($_POST["product_category"]) : "";
    $price = (isset($_POST["price"])) ? $_POST["price"] : "";
    $size = (isset($_POST["size"])) ? $_POST["size"] : "";
    $color = (isset($_POST["color"])) ? strtolower($_POST["color"]) : "";
    $style = (isset($_POST["style"])) ? strtolower($_POST["style"]) : "";

    $front_image = $_FILES["front_image"]["name"];
    $front_image_size = $_FILES["front_image"]["size"];
    $front_tmp_name = $_FILES["front_image"]["tmp_name"];
    move_uploaded_file($front_tmp_name, "../upload/".$front_image);

    $back_image = $_FILES["back_image"]["name"];
    $back_image_size = $_FILES["back_image"]["size"];
    $back_tmp_name = $_FILES["back_image"]["tmp_name"];
    move_uploaded_file($back_tmp_name, "../upload/".$back_image);

    $insert = "INSERT INTO footwear_info(product_name, product_category, price, size, color, front_image, back_image, style) VALUES('$product_name', '$product_category', '$price', '$size', '$color', '$front_image', '$back_image', '$style')";

    $insert_to_database = mysqli_query($connect, $insert) or die("Cannot insert to table".mysqli_connect_error());
}

function retrieve_table()
{
   include '../database_connection.php';
    $retrieve = "SELECT * FROM footwear_info";

    $retrieve_from_database = mysqli_query($connect, $retrieve) or die("Cannot insert to table".mysqli_connect_error());

    if (isset($_POST["retrieve"])) {
        echo '<h2>Product List</h2>';
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Product Name</th><th>Category</th><th>Price</th><th>Size</th><th>Color</th><th>Style</th><th>Front Image</th><th>Back Image</th></tr>';
        while ($row = mysqli_fetch_assoc($retrieve_from_database)) {
            echo '<tr>';
            echo '<td>' . $row['ID'] . '</td>';
            echo '<td>' . $row['product_name'] . '</td>';
            echo '<td>' . $row['product_category'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '<td>' . $row['size'] . '</td>';
            echo '<td>' . $row['color'] . '</td>';
            echo '<td>' . $row['style'] . '</td>';
            echo '<td><img src="../upload/' . $row['front_image'] . '" width="150px" height="150px"></td>';
            echo '<td><img src="../upload/' . $row['back_image'] . '" width="150px" height="150px"></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}

mysqli_close($connect);
?>

<!-- HTML  of the page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="entire_page">
            <div class="div">
            <div class="product_main_body">
                <div>
                    <label for="product_name">
                        <p>
                            Product-Name:
                        </p>
                    </label>
                    <input type="text" name="product_name" id="" required>
                </div>

                <div class="div">
                    <div>
                        <label for="price">
                            <p>
                                Price:
                            </p>
                        </label>
                        <input type="number" name="price" id="" required>
                    </div>
                    <div>
                        <label for="size">
                            <p>
                                Size:
                            </p>
                        </label>
                        <input type="number" name="size" id="" required>
                    </div>
                    
                </div>

                <div class="div">
                    <div>
                        <label for="color">
                            <p>
                                Color:
                            </p>
                        </label>
                        <input type="text" name="color" id="" required>
                    </div>
                    <div>
                        <label for="style">
                            <p>
                                Style:
                            </p>
                        </label>
                        <input type="text" name="style" id="" required>
                    </div>
                </div>
                
                
                <div>
                    <label for="product_category">
                        <p>
                            Product-Category:
                        </p>
                    </label>
                    <select name="product_category" id="" required>
                        <option value="">Select the product category</option>
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                        <option value="kid">Kid</option>
                    </select>
                </div>

                <div class="div">
                    <div>
                        <label for="front_image">
                            <p>
                                Front-Image:
                            </p>
                        </label>
                        <input type="file" name="front_image" id="front_image" required>
                    </div>
                    <div>
                        <label for="back_image">
                            <p>
                                Back-Image:
                            </p>
                        </label>
                        <input type="file" name="back_image" id="back_image" required>
                    </div>
                </div>

                <div class="div">
                    <div>
                        <input type="submit" value="ADD TO PRODUCT LIST" name="add">
                    </div>
                    <div>
                        <input type="submit" value="PRINT OUT EXISTING PRODUCT" name="retrieve">
                    </div>
                </div>

                
            </div>

            <div class="retrieve_table">
                <?= retrieve_table(); ?>
            </div>
            </div>
        </div>
    </form>
</body>
</html>