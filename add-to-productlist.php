<?php
$connect = include 'database_connection.php';

if (isset($_POST["submit"]))
{
    $product_name = (isset($_POST["product_name"])) ? $_POST["product_name"] : "";
    $product_category = (isset($_POST["product_category"])) ? $_POST["product_category"] : "";
    $price = (isset($_POST["price"])) ? $_POST["price"] : "";
    $size = (isset($_POST["size"])) ? $_POST["size"] : "";
    $color = (isset($_POST["color"])) ? $_POST["color"] : "";

    $front_image = $_FILES["front_image"]["name"];
    $size = $_FILES["front_image"]["size"];
    $tmp_name = $_FILES["front_image"]["tmp_name"];
    move_uploaded_file($front_image, "upload/".$front_image);

    $insert = "INSERT INTO footwear_info(product_name, product_category, price, size, color, front_image/* , back_image */) VALUE('$product_name', '$product_category', '$price', '$size', '$color', '$front_image'/* , '$back_image' */)";

    $insert_to_database = mysqli_query($connect, $insert) or die("Cannot insert to table".mysqli_connect_error());

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="add-to-productlist.css">
</head>
<body>
    <form action="" method="post">
        <div class="product_main_body">
            <div>
                <label for="product_name">
                    <p>
                        Product-Name:
                    </p>
                </label>
                <input type="text" name="product_name" id="">
            </div>
            <div>
                <label for="product_category">
                    <p>
                        Product-Category:
                    </p>
                </label>
                <input type="text" name="product_category" id="">
            </div>
            <div>
                <label for="price">
                    <p>
                        Price:
                    </p>
                </label>
                <input type="text" name="price" id="">
            </div>
            <div>
                <label for="size">
                    <p>
                        Size:
                    </p>
                </label>
                <input type="text" name="size" id="">
            </div>
            <div>
                <label for="color">
                    <p>
                        Color:
                    </p>
                </label>
                <input type="text" name="color" id="">
            </div>
            <div>
                <label for="front_image">
                    <p>
                        Front-Image:
                    </p>
                </label>
                <input type="file" name="front_image" id="front_image">
            </div>
            <div>
                <label for="back_image">
                    <p>
                        Back-Image:
                    </p>
                </label>
                <input type="file" name="back_image" id="back_image">
            </div>
            <div>
                <input type="submit" value="ADD TO PRODUCT LIST" name="submit">
            </div>
        </div>
    </form>
</body>
</html>