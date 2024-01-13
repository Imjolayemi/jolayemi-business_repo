<?php
include "../database_connection.php";
if (isset($_POST["go"])){

    $fname = (isset($_POST["fname"])) ? $_POST["fname"] : "";
    $mname = (isset($_POST["mname"])) ? $_POST["mname"] : "";
    $lname = (isset($_POST["lname"])) ? $_POST["lname"] : "";
    $mail = (isset($_POST["mail"])) ? $_POST["mail"] : "";
    $dob = (isset($_POST["dob"])) ? $_POST["dob"] : "";
    $addr = (isset($_POST["addr"])) ? $_POST["addr"] : "";
    $city = (isset($_POST["city"])) ? $_POST["city"] : "";
    $state = (isset($_POST["state"])) ? $_POST["state"] : "";
    $origin = (isset($_POST["origin"])) ? $_POST["origin"] : "";
    $occupation = (isset($_POST["occupation"])) ? $_POST["occupation"] : "";
    $gsm = (isset($_POST["gsm"])) ? $_POST["gsm"] : "";
    $relation = (isset($_POST["relation"])) ? $_POST["relation"] : "";
    $no_of_student = (isset($_POST["no_of_student"])) ? $_POST["no_of_student"] : "";
    $passwd = (isset($_POST["passwd"])) ? $_POST["passwd"] : "";
    $cpasswd = (isset($_POST["cpasswd"])) ? $_POST["cpasswd"] : "";

    $img = $_FILES["img"]["name"];
    $img_size = $_FILES["img"]["size"];
    $front_tmp_name = $_FILES["img"]["tmp_name"];
    move_uploaded_file($front_tmp_name, "parent_pic/".$img);

    $insert = "INSERT INTO parent_info (first_name, middle_name, last_name, mail, dob, address, city, state, state_of_origin, occupation, phone_number, relation, no_of_child, passwd, confirm_passwd, image) VALUES('$fname', '$mname', '$lname', '$mail', '$dob', '$addr', '$city', '$state', '$origin', '$occupation', '$gsm', '$relation', '$no_of_student', '$passwd', '$cpasswd', '$img')";

    $insert_to_database = mysqli_query($connect, $insert) or die("Cannot insert to table".mysqli_connect_error());

    if ($insert_to_database) {
        echo '<script>alert ("Successfuliy added to database");</script>';
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

if (isset($_POST['set_class_btn']))
{
    $set_class = (isset($_POST["set_class"])) ? $_POST["set_class"] : "";
    $year = (isset($_POST["year"])) ? $_POST["year"] : "";

    $insert = "INSERT INTO classes (class, year) VALUES('$set_class', '$year')";

    $insert_to_database = mysqli_query($connect, $insert) or die("Cannot insert to table".mysqli_connect_error());

    if ($insert_to_database) {
        echo '<script>alert ("Class Successfully added to database");</script>';
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}


// function saveTextbooksToDatabase($class_id, $textbooks) {
//     global $connect;

//     foreach ($textbooks as $textbook) {
//         // Use prepared statements to prevent SQL injection
//         $stmt = mysqli_query($connect, "INSERT INTO textbooks (class, textbook_name) VALUES ('$class_id', '$textbook')");

//         // mysqli_stmt_bind_param($stmt, "is", $class_id, $textbook);
//         // mysqli_stmt_execute($stmt);
//         // mysqli_stmt_close($stmt);
//     }

//     echo '<script>alert("Successfully added to database '. $class_id .'");</script>';
// }
//     if (isset($_POST["submit"])) {
//         // Handle saving textbooks to the database
//         $class_id = $_POST["class_name"];
//         $textbooks = $_POST["textbook"];

//         if ($connect) {
//             saveTextbooksToDatabase($class_id, $textbooks);
//             mysqli_close($connect);
//         } else {
//             echo "Error: " . mysqli_error($connect);
//         }
//     }

if (isset($_POST["sign_out"])) {
    header("Location: index.php");
}elseif (isset($_POST["textbook_btn"])) {
    header("Location: textbook.php");
}
elseif (isset($_POST["set_school_fee"])) {
    header("Location: set_school_fee.php");
}
elseif (isset($_POST["set_textbook_fee"])) {
    header("Location: set_textbook_fee.php");
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<section>
    <aside>
        <button type="submit" name="dash_btn" id="dash_btn" class="nav-link" >Dashboard</button>
        <ul class="nav flex-column">
            <li class="nav-item">
                <button type="submit" name="student_btn" id="student_btn" class="nav-link" >Students</button>
            </li>

            <li class="nav-item">
                <span class="nav-link" data-toggle="collapse" data-target="#feeSubmenu">
                    Payments/Fees<span>&#9662;</span>  
                </span>
                <ul class="collapse" id="feeSubmenu">
                    <li class="nav-item">
                        <button type="submit"  name="fee_btn" id="fee_btn" class="nav-link">School Fee</button>
                    </li>
                    <li class="nav-item">
                        <button type="submit"  name="fee_btn" id="fee_btn" class="nav-link">Text-book Fee</button>
                    </li>
                    <li class="nav-item">
                        <button type="submit"  name="fee_btn" id="fee_btn" class="nav-link">Registration Fee</button>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <span type="submit"  name="fee_btn" id="fee_btn" class="nav-link" data-toggle="collapse" data-target="#parentSubmenu">
                    Parent/Guardian<span>&#9662;</span>
                </span>
                <ul class="collapse" id="parentSubmenu">
                    <li class="nav-item">
                        <button type="submit"  name="new_parent" id="new_parent" class="nav-link">New Parent/Guardian</button>
                    </li>
                    <li class="nav-item">
                        <button type="submit"  name="existing_parent" id="existing_parent" class="nav-link">Existing Parent/Guardian</button>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <span type="submit"  name="fee_btn" id="fee_btn" class="nav-link" data-toggle="collapse" data-target="#paymentDetailsSubmenu">
                    Payment Details<span>&#9662;</span>
                </span>
                <ul class="collapse" id="paymentDetailsSubmenu">
                    <li class="nav-item">
                        <button type="submit"  name="fee_btn" id="fee_btn" class="nav-link">Debtors</button>
                    </li>
                    <li class="nav-item">
                        <button type="submit"  name="fee_btn" id="fee_btn" class="nav-link">Completed Payments</button>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <span class="nav-link" data-toggle="collapse" data-target="#setFeeSubmenu">
                    Set Fee for Payments<span>&#9662;</span>
                </span>
                <ul class="collapse" id="setFeeSubmenu">
                    <li class="nav-item">
                        <button type="submit"  name="set_school_fee" id="set_school_fee" class="nav-link">School Fee</button>
                    </li>
                    <li class="nav-item">
                        <button type="submit"  name="set_textbook_fee" id="set_textbook_fee"class="nav-link">Text-Books Fee</button>
                    </li>
                    <li class="nav-item">
                        <button type="submit"  name="fee_btn" id="fee_btn" class="nav-link">Regristration Fee</button>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <button type="submit" name="class_btn" id="class_btn" class="nav-link" >Set classes and Year</button>
            </li>

            <li class="nav-item">
                <button type="submit" name="textbook_btn" id="textbook_btn" class="nav-link" >Set Text-books for each class</button>
            </li>

            <li class="nav-item">
                <button type="submit" name="sign_out" id="sign_out" class="nav-link">Sign Out</button>
            </li>
        </ul>
    </aside>

    <main>
       <?php include "dashboard.php"; ?>
    </main>
</section>
</form>