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

  <center>
  <section id="bookings">
    <h3>All Customer Details</h3>
    <!-- PHP code will fetch bookings from database here -->
    
    <table border="2">
      <tr>
        <th>Name</th>
        <th>Email</th>
      </tr>
      <?php
          $conn = new mysqli('localhost', 'root', '', 'resturant');

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM signup";
          $result = $conn->query($sql);

          while($row = $result->fetch_assoc()) {

            echo "<tr>";
            echo "<td>".$row['Name']."</td>";
            echo "<td>".$row['Email']."</td>";
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