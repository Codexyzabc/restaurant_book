<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location: ./login.php");
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'resturant');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    // $contact = $_POST['contact'];
    $email = $_SESSION['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];

    $sql = "INSERT INTO bookings (user_name, email, booking_date, booking_time, people)
            VALUES ('$name', '$email', '$date', '$time', '$people')";
    if ($conn->query($sql) === TRUE) {
        // echo "Booking request sent!";
        // echo '<script language="javascript">';
        // echo 'alert("Booking request sent! Press Ok")';
        // echo '</script>';
        // header("location: ../index.php");
        $message = "Your booking request has been sent! Redirecting to the homepage...";

        // URL to redirect after showing the alert
        $redirect_url = "../index.php"; // Replace with your target page URL

        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Redirecting...</title>
            <script>
                // Show alert message
                alert('$message');
                
                // Redirect after 5 seconds
                setTimeout(function() {
                    window.location.href = '$redirect_url';
                }, 1000);
            </script>
        </head>
        <body>
        </body>
        </html>
        ";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>