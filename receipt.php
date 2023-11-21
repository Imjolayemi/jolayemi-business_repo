<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "walexdb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Assuming your database query logic here

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WALEX ELECTRONICS_Receipt</title>
    <style>
         @media (max-width: 768px) {
            /* Adjustments for mobile devices */

            body {
                width: auto;
                height: auto;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 100%;
                padding: 10px;
            }

            .header img {
                width: 100%;
            }

            .kinds, .goods, .adres, .Tel {
                position: relative;
                bottom: initial;
            }
            

           
            .cust_info {
                bottom: initial;
                right: initial;
                margin-right: 0;
                position: relative;
                left: 5px;
            }

            table {
                bottom: initial;
            }

            .total-section, .signature-section {
                bottom: initial;
                margin-top: 20px;
            }

            .print-button {
                bottom: initial;
                text-align: center;
                margin-top: 10px;
            }
        }
        @media print {
            body {
                width: 595px;
                height: 700px;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                padding: 20px;
            }

            .print-button {
                display: none;
            }
            .link{
                display: none;
        }
       
            .thanks-message {
                margin-top: 100px;
            }
            .Quick-response{
                display: none;
            }
        }
            
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            position: relative;
            bottom:29px;
            width: 50%;
            margin-bottom: 10px;
        }
        .kinds {
            position: relative;
            bottom: 35px;
            color: white;
            background-color: red;
            padding-left: 5px;
            padding-right: 5px;
        }
        .goods{
            font-size: 11px;
            position: relative;
            bottom: 45px;
            font-weight: bolder;
            color: blue;
        }
        .adres {
            font-size: 11px;
            position: relative;
            bottom: 55px;
            font-weight: bolder;
            color: blue;
        }
        .Tel{
            position: relative;
            bottom: 80px;
            font-size: 12px;
            color: blue;
        }
        .Tel a{
            text-decoration: none;
        }
        .invoice{
            text-align: center;
            position: relative;
            bottom: 80px;
            background-color: red;
            color: white;
            margin-left: 160px;
            margin-right: 160px;
        }
        .cust_info{
            position: relative;
            bottom: 110px;
            right: 50px;
            padding: 5px;
            margin-right: 100px;
        }
        table {
            position: relative;
            bottom:100px;
            width: 100%;
            
        }

        th,
        td {
            text-align: left;
            border-bottom: 1px solid #dddddd;
            padding: 0px 0;
            font-size: 14px;
        }

        th {
            background-color: #f5f5f5;
            color: #333333;
            font-weight: bold;
        }

        .total-row {
            font-weight: bold;
        }

        .thanks-message {
            position: relative;
            bottom: 180px;
            text-align: center;
            margin-top: 30px;
            font-weight: bold;
            font-size: 18px;
        }

        .total-section {
            position: relative;
            bottom: 150px;
            margin-top: 200px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .total-label {
            font-weight: bold;
            margin-right: 10px;
        }

        .total-amount {
            font-size: 18px;
            font-weight: bold;
        }

        .signature-section {
            position: relative;
            bottom: 160px;
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signature-line {
            width: 30%;
            border-top: 1px solid black;
            margin-top: 10px;
            padding-top: 10px;
        }

        .signature-label {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }
        .print-button {
            position: relative;
            bottom: 150px;
            text-align: center;
            margin-top: 20px;
        }
        .Qbtn a{
            color: white;
            text-decoration:none;
        }
        .Qbtn{
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .Quick-response{
            position: relative;
            bottom: 150px;
        }
        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }
        .idno{
            position: relative;
            bottom: 120px;
            left: 80%;
            float: left;
           
        }
        .date{
            position: relative;
            bottom: 100px;
            left: 60%;
            float: left;
        }
        .link{
            text-decoration:none;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }
        
        </style>
</head>
<body>
<a href="index.php" class="link">Back to Home</a>
<div class="container">
        <div class="header">
            <img src="themes/images/logo3.png" alt="WALEX ELECTRONICS"/>
        <div> <span class="kinds"><i>Dealer in all kinds of:</i></span>
        <p class="goods">PLASMA TV, REFRIGERATOR AND CHEST FREEZER, AIR CONDITIONER, HOME & OFFICE FURNITURES AND HOME & INDUSTRIAL ELECTRONICS APPLIANCES</p>
        <p class="adres"><span style="color: red;">Address: </span> 262 Station Road, Ajip Junction, Opp. First Bank. Ede, Osun State. <br> No 169 Station Road, Sanya Junction, Ede, Osun State.</p>
        </div>
        </div>
        <p class="Tel">Tel: 08167726259, 09014378426 <br>Email: <a href="mailto: walexelectronicstore@gmail.com"> walexelectronicstore@gmail.com</a></p>
         <div class="idno">No: <span style="text-decoration: solid 2px blue underline;"><?php echo $_SESSION['random_number'] ?></span> </div>
         <?php
         $transactionDateTime = new DateTime($_SESSION['transaction_date']);
         
         // Format date as 'Y/m/d' (2023/08/26)
         $formattedDate = $transactionDateTime->format('d-m-Y');
         
         // Format time as 'h:i A' (12:44 PM)
         $formattedTime = $transactionDateTime->format('h:i A');
         ?>
       
        <div class="date"> <?php echo $formattedDate; ?></div>
        <p class="invoice">CASH SALES INVOICE</p>
        <div class="cust_info">
      <p>Name:<b><?php echo $_SESSION['name'] ?></b></p>
      <p>Address: <b><?php echo $_SESSION['address'] ?></b></p>
      <p>Tel:<b><?php echo $_SESSION['number'] ?></b></p>
    </div>
       
    <table style="width: 100%; padding: 10px;">
    <thead>
        <tr>
            <th style="width: 5%;">S/N</th>
            <th style="width: 20%;">Product Name</th>
            <th style="width: 25%;">Model</th>
            <th style="width: 15%;">Price</th>
            <th style="width: 15%;">Quantity</th>
            <th style="width: 15%;">Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sn = 1; // Initialize serial number
        foreach ($_SESSION['cart'] as $item):
            $price = isset($item['price']) ? number_format($item['price'], 3, ',', '.') : '';
            $qty = isset($item['qtynew']) ? $item['qtynew'] : '';
            $total = isset($item['total']) ? number_format($item['total'], 3, '.', ',') : '';
        ?>
            <tr> 
                <td><?= $sn ?></td>
                <td><?= isset($item['category']) ? $item['category'] : '' ?></td>
                <td><?= isset($item['main_feature']) ? $item['main_feature'] : '' ?></td>
                <td><?= $price ?></td>
                <td><?= $qty ?></td>
                <td><?= $total ?></td>
            </tr>
        <?php
            $sn++; // Increment serial number for the next row
        endforeach;
        ?>
    </tbody>
</table>

        <div class="total-section">
        <div class="total-label">Total:</div>
        <div class="total-amount">₦ <?php echo number_format($_SESSION['grandTotal'], 3, '.', ','); ?></div>
        </div>

        <div class="signature-section">
            <div class="signature-line">
                <div class="signature-label">Customer's Signature</div>
            </div>
            <div class="signature-line">
                <div class="signature-label">Company's Signature</div>
            </div>
        </div>
        <?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])): ?>
            <div class="print-button">
                <button onclick="window.print()">Download</button>
            </div>
            <div class="thanks-message">
                Thanks for your patronage!
            </div>

            <div class="Quick-response">
               <p><b>For Quick response :
               <button class="Qbtn"><a href="https://wa.me/<08137990784>">Click Me!</a></button> 
               </b> </p>
            </div>
        <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?>
    </div>
</body>
</html>





