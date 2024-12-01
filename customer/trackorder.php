<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIXIT</title>
    <link rel="stylesheet" href="trackorder.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>.tracktext{
    width: 550px;
    margin: auto auto;
}</style>
<body>
    <!-- header -->
    <header>
        <div>
            <img src="bg-img/logo.jpg" alt="logo">
            <a href="home.html" class="brand">FIXIT!</a>
        </div>
        
            <div class="navitems">
                <a href="home.html" target="_blank">Home</a>                       
            </div>
    </header>
    <?php
    include 'connection.php';
    if(isset($_POST['submit']))
    {
        $custph=$_POST['phone'];
        $sql='select * from smartphone where custph='.$custph;
        $result=mysqli_query($con, $sql);
        $countRow=mysqli_num_rows($result);
        if($countRow>0){	
                while($r=mysqli_fetch_assoc($result)){
                    $status=$r['status'];
                    $brand=$r['brand'];
                    $model=$r['model'];
                    if ($status=='Accepted'){
                        $class='alert alert-success';
                        $msg='Congratulations!';
                    }
                    elseif ($status=='Rejected'){
                        $class='alert alert-danger';
                        $msg='We are sorry!';
                    }
                    elseif ($status=='Completed'){
                        $class='alert alert-info';
                        $msg='Hi!';
                    }
                    elseif($status=='Pending'){
                        $class='alert alert-warning';
                        $msg='Hello!';
                    }
                    echo "<div class='my-3'><div class='tracktext ".$class."'>".$msg." ".$r['custnm']." your order for ".$brand." ".$model." is <strong>".$status."</strong><br>for further details please check your Email.</div><div>";
                }
            }
            else
            {
                echo "<div class='my-3'><div class='tracktext alert-danger'>Sorry! Your Phone Number ".$custph." is not registered. Please check your phone number</div><div>";
            }
            exit;
    }
    ?>
    <!-- body -->
        <div class="content">
            <h1>Order Details</h1>
            <form action="trackorder.php" method="post">
            <div class="numtrack">
                <label for="number">Enter your phone number:</label>
                <input type="number" name="phone">
            <div class="btnc">
                <button name="submit">Submit</button>
            </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>