<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location: ./login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Panel</title>
  <link rel="stylesheet" href="./signup.css">
</head>
<body>
    <div class="box_1">
        <h1 id="reg">Book a Table</h1>
        <form action="./book_table.php" method="post">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
            <!-- <label for="contact">Contact:</label>
            <input type="tel" id="contact" name="contact" required> -->
            <label for="date">Select Date</label>
            <input type="date" id="date" name="date" required>
            <label for="time">Select Time</label>
            <input type="time" id="time" name="time" required>
            <label for="people">Number of People</label>
            <input type="number" id="people" name="people" required><br><br>
            <input type="submit" value="Book Table" name="booked">
        </form>
    </div>
</body>
</html>