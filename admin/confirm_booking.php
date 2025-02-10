<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location: ./admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <style>
		h3 {
			text-align: center;
		}
    table, th, td {
      border-collapse: collapse;
    }
		th,td {
			padding: 15px;
      text-align: center;
		}
    tr:nth-child(odd) {
      background-color: #D6EEEE;
    }

	</style>
</head>
<body>
  <!-- <header>
    <h2>Waiting Customers</h2>
  </header> -->
  <center>
  <section id="bookings">
    <h3>New Bookings</h3>
    <!-- PHP code will fetch bookings from database here -->
    
    <table border="2">
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Booking Date</th>
        <th>Booking Time</th>
        <th>People</th>
        <th>Status</th>
      </tr>
      <?php
          $conn = new mysqli('localhost', 'root', '', 'resturant');

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM bookings WHERE status = 'Pending'";
          $result = $conn->query($sql);

          while($row = $result->fetch_assoc()) {
              // echo "<div class='booking'>";
              // echo "<p>Name: " . $row['user_name'] . "</p>";
              // echo "<p>Contact: " . $row['contact'] . "</p>";
              // echo "<form action='confirm_booking.php' method='post'>";
              // echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
              // echo "<button type='submit' name='action' value='confirm'>Confirm</button>";
              // echo "<button type='submit' name='action' value='delete'>Delete</button>";
              // echo "</form>";
              // echo "</div>";

            echo "<tr>";
            echo "<td>".$row['user_name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['booking_date']."</td>";
            echo "<td>".$row['booking_time']."</td>";
            echo "<td>".$row['people']."</td>";
            echo "<td>
              <form action='table_confirmed.php' method='post'>
              <input type='hidden' name='id' value='" . $row['id'] . "'>
              <button type='submit' name='action' value='confirm'>Confirm</button>
              <button type='submit' name='action' value='delete'>Delete</button>
              </form>
            </td>";
            echo "</tr>";

          }
          $conn->close();
      ?>
    </table>
  </section>
  <br><br>
  <a href="./admin_index.php">Click here to go to admin panel</a>
  </center>

</body>
</html>