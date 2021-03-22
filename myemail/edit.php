<?php
include('../login/session.php');
if(!isset($_SESSION['login_user'])){
header("location: ../login/index.php"); 
}
    require_once('../db.php');

    if(isset($_POST['update']))
    {	
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $emailid = mysqli_real_escape_string($con, $_POST['emailid']);

        if(empty($emailid)) 
        {	
            echo "<font color='red'>Total field is empty.</font><br/>";
        } 
        else 
        {	
            $sql = "select * from myemail where emailid='".$emailid."'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0)
            {
                $errorMsg = 'Email Already Exists';
            }
            else
            {
                $result = mysqli_query($con, "UPDATE myemail SET emailid='$emailid' WHERE id=$id");
                header("Location: index.php");
            }    
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="../img/logo/logo.png" rel="icon">
  <title>Color Spectrophotometer and Colorimeter Instrument Manufacturer</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include '../layout.php';?>
    <?php
        $id = $_GET['id'];
        $result = mysqli_query($con, "SELECT * FROM myemail WHERE id=$id");
        while($res = mysqli_fetch_array($result))
        {
            $emailid = $res['emailid'];

        }
    ?>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Refernce</h1>
        </div>
        <div class="row">
            <?php
                if(isset($errorMsg)){		
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMsg; ?>
                </div>
            <?php
                }
            ?>
            <?php
            if(isset($successMsg)){		
            ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMsg; ?> - Redirecting In A Moment 
                </div>
            <?php
                }
            ?>
            <div class="col-lg-12">
                <div class="card-body">
                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Email ID</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter Name" name="emailid" value="<?php echo $emailid;?>">
                        </div>
                        
                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                        <button type="submit" class="btn btn-primary" name="update" value="update">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>  
</body>

</html>