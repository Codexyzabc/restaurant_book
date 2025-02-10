<?php
if(isset($_POST['entered']))
{
  $opt1=$_POST['subotp'];

  if($opt1== $_COOKIE['otp'])
  {
    session_start();
    $_SESSION['loggedin'] = true;
    // $_SESSION['sname'] = $sname;
    $_SESSION['email'] = isset($_GET['email']) ? $_GET['email'] : null;
    // echo $_SESSION['email'];
    header("location: ../index.php");
  }
  else
  {
    echo '    
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Wrong OTP!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
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
    <script defer src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script defer src="https://kit.fontawesome.com/1e8d61f212.js"></script>    
    <title>Otp</title>
    <link rel="stylesheet" href="./signup.css">
</head>
<body>
    <div class="box_1">
        <h1 id="reg">OTP Verification</h1>
        <form method="post">
            <h5 style="color: #464040;">Check your email for the OTP</h5><br>
            <input type="text" placeholder="Enter the OTP" name="subotp" required><br><br>
            <input type="submit" value="Submit" name="entered">
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/rizalcss@1.5.0/js/rizal.min.js" integrity="sha256-HBuvk3PCFCXtzy/G/393UvcosSWVy6WHf5sRnZdzmio=" crossorigin="anonymous"></script>
</body>
</html>