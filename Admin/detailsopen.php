<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Fixit.com/admin</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <link rel='stylesheet' href='admincss.css'>
</head>
<?php
include 'connection.php';
$sl=$_GET['sl'];
$sql='select * from smartphone where sl='.$sl;
$result=mysqli_query($con, $sql);
$countRow=mysqli_num_rows($result);
?>
<body>
<nav class='navbar navbar-light bg-light'>
    <div class='container-fluid'>
        <a class='navbar-brand custlogo' href='open.php'>
            <img src='img/logo.jpg' alt='logo' width='60' height='60' class='d-inline-block align-text-top'>
            FixIt.com
        </a>
        <ul class='nav nav-tabs'>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="open.php">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="closed.php">Closed</a>
            </li>
        </ul>
        <div class="btn btn-outline-danger">
            <a href="logout.php"><img src="img/logout.png" alt="" srcset=""></a>
        </div>
    </div>
</nav>
<div class='container my-4'>

        <table class='table table-hover'>
            <thead class='shadow-sm p-3 mb-5 bg-light rounded'>
                <tr>
                <th scope='col'>Name</th>
                <th scope='col'>Phone</th>
                <th scope='col'>Email</th>
                <th scope='col'>Address</th>
                <th scope='col'>Query</th>
                <th scope='col'>Status</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno = $sno + 1;
                        $link='https://www.google.com/search?q='.$row['brand'].'+'.$row['model'];
                        echo '<tr>
                        <td>'. $row['custnm'] . '</td>
                        <td>'. $row['custph'] . '</td>
                        <td>'. $row['custmail'] . '</td>
                        
                        <td>
                        <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Address</button>
                        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Address</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body small">
                        <table class="table table-hover">
                            <thead class="shadow-sm p-3 mb-5 bg-light rounded">
                                <tr>
                                    <th scope="col">Locality</th>
                                    <th scope="col">State</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Pin</th>
                                    <th scope="col">Landmark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$row['address'].'</td>
                                    <td>'.$row['state'].'</td>
                                    <td>'.$row['city'].'</td>
                                    <td>'.$row['pin'].'</td>
                                    <td>'.$row['landmark'].'</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Device info</h5>
                        </div>
                        <table class="table table-hover">
                            <thead class="shadow-sm p-3 mb-5 bg-light rounded">
                                <tr>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Model Name</th>
                                    <th scope="col">Issue</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$row['brand'].'</td>
                                    <td><a class="custlink" target="_blank" href='.$link.'>'.$row['model'].'</a></td>
                                    <td>'.$row['issue'].'</td>
                                    <td>'.$row['detail'].'</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>
                        </td>
                        <td>
                        
                        <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Device Info</button>
                        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                        </div>
                        </td>
                        <td class="text-warning"> '. $row['status'] . '</td>
                        </tr>';
                    } 
                    ?>
            </tbody>
        </table>
        <div class="center">
        <form action="closed.php" method=post class="btn btn-outline-light">
            <input type="hidden" value="<?php echo $sl;?>" name="sl">
            <input type="submit" name="Accept" value="Accept" class="btn btn-outline-success">
        </form>
        <form action="closed.php" method=post class="btn btn-outline-light">
            <input type="hidden" value="<?php echo $sl;?>" name="sl">
            <input type="submit" name="Reject" value="Reject" class="btn btn-outline-danger">
        </form>
        </div>
</div>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM' crossorigin='anonymous'></script>   
</body>
</html>