<?php
// $name = "confirm";
// $value = "check";

// if (isset($_POST[$name]))
// {
//     echo "<script>
//     alert ('You are Welcome'); </script>";

//     $name = "go";
//     $value = "go";

// }

// if (isset($_POST[$name]))
// {
//     echo "<script>
//     alert ('You are good to GO!'); </script>";
// }

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <h2>Change functionalities by printing out different thing</h2>
    <input type="submit" name="<?= $name; ?>" value="<?= $value; ?>">
    </form>
</body>
</html> -->



<?php
$type1 = '<a class="btn btn-primary" onclick="redirectToSecondPage()" id="nextButton">Check Out Order</a>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h2>Change functionalities by printing out different things</h2>
        <button class="btn btn-primary" onclick="displayValues()"  id="confirmationButton">Confirm Order</button>
   


    <script>
        function displayValues()
		{
			alert ("You are Welcome");

			document.getElementsById("confirmationButton").innerText = "come";

		}

		
		function redirectToSecondPage() {
					
					// window.location = 'confirm_checkout.php?subtotal=' + encodeURIComponent(totalValue);

                    window.Location("index.php");

		}
    </script>

</form>
</body>
</html>
