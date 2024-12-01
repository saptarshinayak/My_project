<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="admincss.css">
    <title>Fixit.com/Admin/Change Password</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand custlogo" href="open.php">
        <img src="img/logo.jpg" alt="logo" width="60" height="60" class="d-inline-block align-text-top">
        FixIt.com
        </a>
        <a class="btn btn-primary" href="login.php" role="button">Log in</a>
    </div>
</nav>
<?php
include 'connection.php';
if(isset($_POST['submit'])){
$pass1=$_POST['newpass'];
$pass2=$_POST['confirmpass'];
$oldpass=$_POST['oldpass'];
if(preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,16}$/', $pass2)){
if ($pass1==$pass2){
    $sql = "SELECT * FROM `users` WHERE 1;";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0){
        while($row=mysqli_fetch_assoc($result)){
            if ($oldpass==$row['password']){
                $sqli="update users set password='$pass2'";
                mysqli_query($con, $sqli);
                session_start();
                $_SESSION['var_pass'] = true;
                header("location: login.php");
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Wrong password Entered!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        
        }
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Wrong password Entered!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    Password did not matched!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
}
else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    Please refer to the password creating rules.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
}
?>
    <form action="changepass.php" method="post" class="tracktext my-3">
        <div class="mb-3">
            <label for="exampleoldpass1" class="form-label">Please Enter your old password</label>
            <input type="password" class="form-control" name="oldpass" id="exampleoldpass1">
        </div>
        <div class="mb-3">
            <label for="examplenewpass1" class="form-label">Please Enter your new password</label>
            <input type="text" class="form-control" name="newpass" id="examplenewpass1" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onInput="check()"/>
        </div>
        <div class="collapse text-center" id="collapseExample">
        <div id="set" class="card card-head alert alert-light">
            <div id="count">Length : 0</div>
            <i id="see" onclick="see()"></i>
         </div>
         <ul id="passul" class="card card-body alert alert-secondary">
           <li id="check0">
                <span> Length more than 8.</span>
           </li>
           <li id="check1">
                <span> Length less than 16.</span>
           </li>
           <li id="check2">
                <span> Contains numerical character.</span>
           </li>
           <li id="check3">
                <span>Contains special character.</span>
           </li>
           <li id="check4">
                <span>Contais at least 1 Uppercase.</span>
           </li>
        </ul>
        </div>
        <div class="mb-3">
            <label for="examplenewpass2" class="form-label">Please Confirm your new password</label>
            <input type="password" class="form-control" name="confirmpass" id="examplenewpass2">
        </div>
        <button type="submit" name="submit" class="btn btn-outline-primary">Change Password</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
    var is_visible = false;

function see()
{
    var input = document.getElementById("examplenewpass1");
    var see = document.getElementById("see");
    
    if(is_visible)
    {
        input.type = 'password';
        is_visible = false; 
        see.style.color='gray';
    }
    else
    {
        input.type = 'text';
        is_visible = true; 
        see.style.color='#262626';
    }
    
}

function check()
{
    var input = document.getElementById("examplenewpass1").value;
    
    input=input.trim();
    document.getElementById("examplenewpass1").value=input;
    document.getElementById("count").innerText="Length : " + input.length;
    if(input.length>=8)
    {
        document.getElementById("check0").style.color="green";
    }
    else
    {
    document.getElementById("check0").style.color="red"; 
    }
    
    if(input.length<=16)
    {
        document.getElementById("check1").style.color="green";
    }
    else
    {
    document.getElementById("check1").style.color="red"; 
    }
    
    if(input.match(/[0-9]/i))
    {
        document.getElementById("check2").style.color="green";
    }
    else
    {
    document.getElementById("check2").style.color="red"; 
    }
    
    if(input.match(/[^A-Za-z0-9-' ']/i))
    {
        document.getElementById("check3").style.color="green";
    }
    else
    {
    document.getElementById("check3").style.color="red"; 
    }
    if(input.match(/[A-Z]/g))
    {
        document.getElementById("check4").style.color="green";
    }
    else
    {
    document.getElementById("check4").style.color="red"; 
    }
    
}
</script>
</body>
</html>