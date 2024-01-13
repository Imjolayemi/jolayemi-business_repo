<?php
session_start(); // Start the session

// session_unset(); // Clear all session variables
// session_destroy(); // Destroy the session
if (isset($_GET['reference'])){
    $resp = $_GET['reference'];

    $curl = curl_init(); 

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/$resp",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_ccb0fb736192651b97a6a8053668628d848ce076",
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);


        // echo $response;
        $response_data = json_decode($response, true);

        if (isset($response_data['data']['log']['history'])) {
            // Accessing the 'history' array inside 'log' object
            $history = $response_data['data']['log']['history'];
    
            // Looping through the 'history' array
            foreach ($history as $item) {
                // Checking if the 'type' is 'success'
                if ($item['type'] === 'success') {
                    // Displaying the message when type is 'success'
                    $message = $item['message'];
                    // $_SESSION['message'] = $message;
                }
            }
        } 
        $channel = $response_data['data']['channel'];
        // $_SESSION['channel'] = $channel;
        $transaction_date = $response_data['data']['transaction_date'];
        // $_SESSION['transaction_date'] = $transaction_date;


        $ref11 = $response_data['message'];
        // Missing assignment for $em variable in the line below
        $em = ""; // Assign a value or leave it empty depending on your requirements

        // echo $ref11;
        if ($ref11 == 'Verification successful') {
              
            // Database insertion code
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "footweardb";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("INSERT INTO billing_details (first_name, last_name, city, state, e_mail, phone_number, random_number, order_total) 
                VALUES (:fname, :lname, :cty, :province, :email_address, :num, :random_num, :odr_total)");
                $stmt->bindParam(':fname', $_SESSION['fname']);
                $stmt->bindParam(':lname', $_SESSION['lname']);
                $stmt->bindParam(':cty', $_SESSION['city']);
                $stmt->bindParam(':province', $_SESSION['state']);
                $stmt->bindParam(':email_address', $_SESSION['email']);
                $stmt->bindParam(':num', $_SESSION['number']);
                $stmt->bindParam(':random_num', $_SESSION['randomString']);
                $stmt->bindParam(':odr_total', $_SESSION['subtotal']);

                        $stmt->execute();

                // If the insertion is successful, you can redirect to the next page
                header('Location: receipt.php');

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // $conn = null;
        } else {
            echo "<script> alert ('Go back'); </script>";
            header('Location: checkout.php');
            exit();
        }
    
}
?>