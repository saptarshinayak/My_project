<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Fixit.com/admin</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <link rel='stylesheet' href='//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css'>
    <link rel='stylesheet' href='admincss.css'>
</head>
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
}
include 'connection.php';
$sql = 'select * from smartphone where status != "Pending"';
$result=mysqli_query($con, $sql);
$countRow=mysqli_num_rows($result);
if(isset($_POST['Accept']))
{
	$sl=$_POST['sl'];
	$sql="update smartphone set status= 'Accepted' where sl=".$sl;
	mysqli_query($con,$sql);
	header("Refresh:0");
}
if(isset($_POST['Reject']))
{
	$sl=$_POST['sl'];
	$sql="update smartphone set status= 'Rejected' where sl=".$sl;
	mysqli_query($con,$sql);
	header("Refresh:0");
}
if(isset($_POST['Completed']))
{
	$sl=$_POST['sl'];
	$sql="update smartphone set status= 'Completed' where sl=".$sl;
	mysqli_query($con,$sql);
	header("Refresh:0");
}
?>
<body>
    <nav class='navbar navbar-light bg-light'>
    <div class='container-fluid'>
        <a class='navbar-brand custlogo' href='open.php'>
            <img src='img/logo.jpg' alt='logo' width='60' height='60' class='d-inline-block align-text-top'>
            FixIt.com
        </a>
        <ul class='nav nav-tabs'>
            <li class='nav-item'>
                <a class='nav-link' href='open.php'>Pending</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link active' aria-current='page' href='closed.php'>Closed</a>
            </li>
        </ul>
        <div class="btn btn-outline-danger">
            <a href="logout.php"><img src="img/logout.png" alt="" srcset=""></a>
        </div>
    </div>
    </nav>
    <div class='container my-4'>

        <table class='table table-hover' id='myTable'>
            <thead class='shadow-sm p-3 mb-5 bg-light rounded'>
                <tr>
                <th scope='col'>S.No</th>
                <th scope='col'>Name</th>
                <th scope='col'>Phone</th>
                <th scope='col'>Email</th>
                <th scope='col'>Status</th>
                <th scope='col'>Details</th>
                </tr>
            </thead>
            <tbody >
                    <?php
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno = $sno + 1;
                        if ($row['status']=='Accepted'){
                            $class='text-success';
                        }
                        elseif ($row['status']=='Rejected'){
                            $class='text-danger';
                        }
                        elseif ($row['status']=='Completed'){
                            $class='text-info';
                        }
                        echo '<tr>
                        <th scope="row">'. $sno . '</th>
                        <td>'. $row['custnm'] . '</td>
                        <td>'. $row['custph'] . '</td>
                        <td><a class="custlink" href="mailto:'.$row["custmail"].'">'. $row['custmail'] .'</a></td>
                        <td class='.$class.'> '. $row['status'] . '</td>
                        <td> <a name="view" class="btn btn-outline-primary" href="detailsclosed.php?sl='.$row['sl'].'" role="button">View</a> </td>
                    </tr>';
                    } 
                    ?>

            </tbody>
        </table>
    </div>
    <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js'
        integrity='sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n'
        crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'
        integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo'
        crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'
        integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6'
        crossorigin='anonymous'></script>
    <script src='//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
    <script>
        $(document).ready(function () {
        $('#myTable').DataTable();

        });
    </script>
</body>
</html>