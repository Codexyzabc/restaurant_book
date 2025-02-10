<?php 
$showAlert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include './conn.php';
    $sname = $_POST["sname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Check whether this email exist
    $existSql = "Select * from `signup` where Email='$email'";
    $result = mysqli_query($conn,$existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows == true) {
        //$exists = true;
        $showError = "Email already exists";
    }
    else {
        if($password == $cpassword) {
            $hash=password_hash($password, PASSWORD_DEFAULT);
            $sql= "INSERT INTO `signup` (`Name`, `Email`, `Password`) VALUES ('$sname', '$email', '$hash')";
            $result = mysqli_query($conn,$sql);
            if($result) {
                $showAlert=true;
            }
        }
        else {
            $showError= "Passwords do not match.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./signup.css">
</head>
<body>
    <?php
    if($showAlert) {
        echo '    
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your account is now created and you can <a href="./login.php">login.</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
    }
    if($showError) {
        echo '    
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$showError.'.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
    }
    ?>
    <div class="box_1">
        <h1 id="reg">Sign up</h1>
        <form action="./signup.php" method="post">
            <input type="text" placeholder="Enter Name" name="sname" maxlength="40" required><br><br>            
            <input type="email" placeholder="Enter Email" name="email" maxlength="50" required><br><br>
            <input type="password" placeholder="Enter Password" name="password" maxlength="25" required><br><br>
            <input type="password" placeholder="Confirm Password" name="cpassword" required><br><br>
            <input type="submit" value="Register" name="register">
        </form>
        <hr>
        <p>Already have an account?<a href="./login.php"> Log in</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>