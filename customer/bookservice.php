<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIXIT</title>
    <link rel="stylesheet" href="bookservice.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header>
        <div>
            <img src="bg-img/logo.jpg" alt="logo">
            <a href="home.html" class="brand">FIXIT!</a>
        </div>
        
            <div class="navitems">
                <a href="home.html" target="_blank">Home</a>                       
                <a href="trackorder.php" target="_blank">Track order</a>
            </div>
    </header>
    <?php
    include 'connection.php';

    if(isset($_POST['submit']))
    {
        $custnm=$_POST['name'];
        $custmail=$_POST['email'];
        $custph=$_POST['phone'];
        $address=$_POST['address'];
        $landmark=$_POST['landmark'];
        $state=$_POST['state'];
        $city=$_POST['city'];
        $pin=$_POST['pin'];
        $brand=$_POST['brand'];
        $model=$_POST['model'];
        $issue=$_POST['issue'];
        $details=$_POST['desc'];
        $status=$_POST['status'];
        if(preg_match('/^[0-9]{10}+$/', $custph)) {
            $sql = "INSERT INTO smartphone (custnm, custmail, custph, `address`, landmark, `state`, city, pin, brand, model, issue, detail, `status`) VALUES ('$custnm','$custmail','$custph','$address','$landmark','$state','$city','$pin','$brand','$model','$issue','$details','$status');";
            mysqli_query($con,$sql) or die(mysqli_error($con));
            echo "<div class='alert alert-success position-absolute top-50 start-50 translate-middle' role='alert' style='width: '>Your entry was captured successfully</div>";
            exit;
            } else {
            echo "<div class='alert alert-danger' role='alert'>Invalid Phone Number </div>";
            }
    }
    ?>
    <form action="bookservice.php" method="post">
    <div class="total">
        <h1>Service Form</h1>
        <h2>User Details:</h2>
        <div class="ud">        
            <div class="box">
                <label for="name"> Name:</label><br>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="box">
                <label for="email"> Email:</label><br>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="box">
                <label for="phone"> Phone:</label><br>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="box">
                <label for="address"> Address:</label><br>
                <input type="text" id="address" name="address" required>
            </div>
        </div>
    
        <h2>Address Details:</h2>
        <div class="ud">
            <div class="box">
                <label for="state"> State:</label><br>
                <input type="text" id="state" name="state" required>
            </div>
            <div class="box">
                <label for="city"> City:</label><br>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="box">
                <label for="pin"> Pin:</label><br>
                <input type="number" id="pin" name="pin" required>
            </div>
            <div class="box">
                <label for="landmark"> Landmark:</label><br>
                <input type="text" id="landmark" name="landmark" required>
            </div>
        </div>
    
        <h2>Device Details:</h2>
        <div class="ud">
            <div class="box">
                <label for="Brand"> Brand:</label><br>
                <input type="text" id="brand" name="brand" required>
            </div>
            <div class="box">
                <label for="Model"> Model:</label><br>
                <input type="text" id="model" name="model" required>
            </div>
            <div class="box">
                <label for="landmark"> Issue:</label><br>
                <input type="text" id="issue" name="issue" required>
            </div>
        </div>
        <input type='hidden' name='status' value='Pending'>
        <h2>Description:</h2>
        <div class="box">
            <textarea id="desc" name="desc" required></textarea>
        </div>
        <div class="btnc">
            <input type="Submit" value="Submit" name="submit">
            <input type="Reset">
        </div>
    </div>
</form>
    <footer>
        <div class="c0">
            <h3>Why to choose us?</h3>
            <ul>
                <li>The best from our expertise</li>
                <li>Antagonistic prices</li>
                <li>Rapid turnaround</li>
                <li>Masterly service</li>
                <li>Repair your Products to the core</li>
            </ul>
        </div>
        <div class="c1">
            <h3>Help:</h3>
            <p>Toll Free: 830 6000 603</p><br>
            <h3>For Other Enquiries:</h3>
            <p>&copy; Contact: 7439904053</p><br>
        </div>
        <div class="c2">
            <h3>Follow Us:</h3>
            <ul>
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
            <p>E-mail: saptarshinayak3@gmail.com</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>