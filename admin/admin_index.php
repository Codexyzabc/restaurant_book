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
    <title>Admin_Panel</title>
    <link rel="stylesheet" href="../client/pages/css/index.css">
    <style>
        .all_bookings {
            margin-top: 80px;
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
    <div class="container">
        <header>
            <nav>
                <ul>
                    <li style="float: left;"><a href="admin_index.php">Admin Panel</a></li>
                    <?php    
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            echo '<li><a href="./admin_logout.php">Logout</a></li>';
                        }
                        else {
                            echo '<li><a href="./admin_login.php">Log in</a></li>';
                        }
                    ?>
                    <li><a href="./add_table.php">Add Table</a></li>
                    <li><a href="./confirm_booking.php">Confirm Booking</a></li>
                    <li><a href="./user_details.php">User Details</a></li>
                </ul>
            </nav>
        </header>

        <section class="all_bookings">
            <center>
            <h3>All Bookings</h3>
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

                    $sql = "SELECT * FROM bookings";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()) {

                        echo "<tr>";
                        echo "<td>".$row['user_name']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['booking_date']."</td>";
                        echo "<td>".$row['booking_time']."</td>";
                        echo "<td>".$row['people']."</td>";
                        echo "<td>".$row['status']."</td>";
                        echo "</tr>";

                    }
                    $conn->close();
                ?>
            </table>

            <br>

            <h3>All Tables</h3>
            <table border="2">
                <tr>
                    <th>Table Number</th>
                    <th>Capacity</th>
                </tr>
                <?php
                    $conn = new mysqli('localhost', 'root', '', 'resturant');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM tables";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()) {

                        echo "<tr>";
                        echo "<td>".$row['table_number']."</td>";
                        echo "<td>".$row['capacity']."</td>";
                        echo "</tr>";

                    }
                    $conn->close();
                ?>
            </table>
            </center>
        </section>

        <section class="restu" id="restu">

        </section>

        <!-- <footer class="footer" id="footer">
            <div class="footer_bar">
                Copyright © 2024 Subrata Nandi. All rights reserved.
            </div>
        </footer> -->
        
    </div>
    
</body>
</html>