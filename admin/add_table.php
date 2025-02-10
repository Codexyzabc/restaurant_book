<?php
// Database connection

// $server="sql105.infinityfree.com";
// $username="if0_37217174";
// $password="HdIx6vv4JibHf";
// $database="if0_37217174_resturant";

// $conn=mysqli_connect($server, $username, $password, $database);
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location: ./admin_login.php");
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'resturant');
// $conn = new mysqli('sql105.infinityfree.com', 'if0_37217174', 'HdIx6vv4JibHf', 'if0_37217174_resturant');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table_number = $_POST['table_number'];
    $capacity = $_POST['capacity'];

    // Insert data into the `tables` table
    $sql = "INSERT INTO tables (table_number, capacity) VALUES ('$table_number', $capacity)";
    if ($conn->query($sql) === TRUE) {
        $message = "New table added successfully!";

        // URL to redirect after showing the alert
        $redirect_url = "add_table.php"; // Replace with your target page URL
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section id="add-table">
    <h3>Add New Table</h3>
    <form action="./add_table.php" method="post">
      <label for="table-number">Table Number:</label>
      <input type="text" id="table-number" name="table_number" required>
      <label for="capacity">Capacity:</label>
      <input type="number" id="capacity" name="capacity" required>
      <button type="submit">Add Table</button>
    </form>
  </section>
  <br>
  <a href="./admin_index.php">Click here to go to admin panel</a>
</body>
</html>