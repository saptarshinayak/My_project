<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="admincss.css">
    <title>Fixit.com/Admin/login</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand custlogo" href="open.php">
        <img src="img/logo.jpg" alt="logo" width="60" height="60" class="d-inline-block align-text-top">
        FixIt.com
        </a>
    </div>
</nav>
<?php
session_start();
if(isset($_SESSION['var_pass'])){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            Password changed successfully! Please proceed to log in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
session_unset();
session_destroy();
?>
<?php
include 'connection.php';
$login = false;
$showError = false;
if(isset($_POST['reset'])){
    $sql='update users set password="a26TMP8#jn@"';
    mysqli_query($con, $sql);
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Password reset successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if(isset($_POST['login'])){
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    $sql = "Select * from users where username='$username'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0){
        while($row=mysqli_fetch_assoc($result)){
            if ($password==$row['password']){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: open.php");
            } 
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Invalid Credentials!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        
    } 
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Invalid Credentials!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>
<form action="login.php" method="post" class="tracktext my-3">
<div class="mb-3">
    <label for="exampleusername1" class="form-label">Username</label>
    <input type="text" class="form-control" name="username" id="exampleusername1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" name="login" class="btn btn-outline-primary">Log in</button>
</form>
<div class="tracktext button2">
<form action="login.php" method="post">
    <button class="btn btn-outline-danger" name="reset" aria-describedby="resetHelp">Reset Password</button>
    <div id="resetHelp" class="form-text">Reset your password to default.</div>
</form>
<a href="changepass.php"><button class="btn btn-outline-warning">Change Password</button></a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>
</html>