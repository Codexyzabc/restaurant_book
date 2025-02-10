<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'resturant');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for POST request and required fields
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    if ($action === 'confirm') {
        // Update the booking status to 'Confirmed'
        $sql = "UPDATE bookings SET status='Confirmed' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            // echo "Booking updated successfully.";
            $user_sql = "SELECT email FROM bookings WHERE id=$id";
            $user_result = $conn->query($user_sql);
            if ($user_result->num_rows > 0) {
                $user_row = $user_result->fetch_assoc();
                $user_email = $user_row['email'];

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'rajanandi.subrata3959@gmail.com';
                //$mail->Password = 'hjxkujjkvbcjxlrz';
                $mail->Password = 'zewsfckdkofienkr';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->isHTML(true);
                // $mail->setFrom('rajanandi.subrata3959@gmail.com', $name);
                $mail->setFrom('easydiner@gmail.com', $name);
                $mail->addAddress($user_email);
                // $mail->Subject = ("$email ('OTP')");
                $mail->Subject = ("Table Booking Confirmation");
                $mail->Body =  "Dear Customer,\n\nYour table booking has been confirmed.\n\nThank you for choosing us!";
                $mail->send();
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === 'delete') {
        
        $user_sql = "SELECT email FROM bookings WHERE id=$id";
        $user_result = $conn->query($user_sql);
        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $user_email = $user_row['email'];
            
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rajanandi.subrata3959@gmail.com';
            //$mail->Password = 'hjxkujjkvbcjxlrz';
            $mail->Password = 'zewsfckdkofienkr';
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->isHTML(true);
            // $mail->setFrom('rajanandi.subrata3959@gmail.com', $name);
            $mail->setFrom('easydiner@gmail.com', $name);
            $mail->addAddress($user_email);
            // $mail->Subject = ("$email ('OTP')");
            $mail->Subject = ("Table Booking Confirmation");
            $mail->Body =  "Dear Customer, we are sorry, but no seats are available at the moment. 
            Please try again after 1 hour.";
            $mail->send();
        }
        
        // Delete the booking
        $sql = "DELETE FROM bookings WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            // echo "Booking updated successfully.";    
        } else {
            echo "Error: " . $conn->error;
        }
    }
    
} else {
    echo "Invalid request.";
}

$conn->close();

// Redirect back to the confirm_booking page
header("Location: confirm_booking.php");
exit();
?>

