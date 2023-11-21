<?php
session_start(); // Start the session

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Page</title>

</head>
<body>

<form action="pay.php" method="post" enctype="multipart/form-data" id="paymentForm">
<div class="form-group">
      <input type="email" name="email_address" value="njolayemi@gmail.com" hidden required />
    </div>

    <div class="form-group">
  <input type="number" name="amount" value="1000" hidden required />
</div>
    </form>
    <script src="https://js.paystack.co/v1/inline.js"></script>
<script>
  window.addEventListener("DOMContentLoaded", function () {
    payWithPaystack();
  }); 

  function payWithPaystack() {
    let handler = PaystackPop.setup({
      key: 'pk_test_75cd9803a8fa323bc847cb631c6a33676f9aa922', // Replace with your public key
      email: document.querySelector('input[name="email_address"]').value,
      amount: document.querySelector('input[name="amount"]').value * 100,
      ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

      onClose: function () {
        alert('Window closed.');
        window.location = "product_summary.php";
      },
      callback: function (response) {
        var ref = response.reference;
        window.location = "check.php?reference=" + ref;
      }
    });

    handler.openIframe();
  }
</script>
</body>
</html>
