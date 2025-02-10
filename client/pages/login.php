<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$login=false;
$showError=false;
$showWrong=false;

if(isset($_POST['login'])){
    include './conn.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql= "Select * from `signup` where Email='$email'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num == 1) {
        while($row=mysqli_fetch_assoc($result)) {
            if(password_verify($password,$row['Password'])) {
                $login=true;
                $email = htmlentities($_POST['email']);

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
                $mail->setFrom('rajanandi.subrata3959@gmail.com', $name);
                $mail->addAddress($email);
                $mail->Subject = ("$email ('OTP')");
                $otp= rand(111111,999999);
                $mail->Body =  $otp;
                $mail->send();
                setcookie("otp",$otp,time()+3600*24);
                $_COOKIE['otp'];

                header("location: otp.php?email=" . urlencode($email));
            }
            else {
                $showError= "Wrong Password";
            }
        }
    }   
    else {
        $showWrong= "You are not Registered";
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>User Login</title>
    <link rel="stylesheet" href="./signup.css">
</head>
<body>

    <?php
    if($login) {
        echo '    
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are logged in.
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
    if($showWrong) {
        echo '    
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$showWrong.'.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
    }
    ?>
    <div class="box_1">
        <h1 id="reg">Login</h1>
        <form action="./login.php" method="post">
            <input type="email" placeholder="Email Address" name="email" required><br><br>
            <input type="password" placeholder="Password" name="password" required><br><br>
            <input type="submit" value="Login" name="login">
        </form>
        <hr>
        <p>New here? <a href="./signup.php">Create account</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 </body>
</html>