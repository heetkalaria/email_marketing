<?php
    include('../login/session.php');
    if(!isset($_SESSION['login_user']))
    {
        header("location: ../login/index.php"); 
    }
    require_once('../db.php');
    if(isset($_POST['btnSave']))
    {
        $name = $_POST['name'];
        $emailid = $_POST['emailid'];
        $mobile = $_POST['mobile'];
        $date = $_POST['date'];

        if(empty($emailid))
        {
           $errorMsg = 'Please input email id';
        }
        if(!isset($errorMsg))
        {
            $sqlgetdata = "select * from customerlist where emailid='".$emailid."'";
            $result = mysqli_query($con, $sqlgetdata);
            if(mysqli_num_rows($result) > 0)
            {
                $errorMsg = 'Email Already Exists';
            }
            else
            {
                $sql = "insert into customerlist(name,emailid,mobile,dob) values('".$name."','".$emailid."','".$mobile."','".$date."')";
                $result = mysqli_query($con, $sql);
                if($result)
                {
                    $successMsg = 'New record added successfully';
                    header('refresh:5;index.php');
                }else
                {
                    $errorMsg = 'Error '.mysqli_error($con);
                }
            }
            
        }
    }
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="../img/logo/logo.png" rel="icon">
  <title>Email Marketing | Heet Kalaria</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" >
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include '../layout.php';?>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Customer</h1>
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
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Email ID</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter Email ID" name="emailid">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Mobile Number</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter Mobile Number" name="mobile">
                        </div>
                        <div class="form-group" id="simple-date1">
                            <label for="simpleDataInput">Date Of Birth</label>
                            <div class="input-group date">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" name="date" class="form-control" value="YYYY-MM-DD" id="simpleDataInput">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="btnSave">Submit</button>
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
  <script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script>
        $(document).ready(function () {
            $('#simple-date1 .input-group.date').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,        
            });
        });
  </script>
</body>

</html>