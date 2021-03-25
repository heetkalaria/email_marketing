<?php
    include('../login/session.php');
    if(!isset($_SESSION['login_user']))
    {
        header("location: ../login/index.php"); 
    }
    $upload_dir = 'uploadtemplate/';
    require_once('../db.php');
    if(isset($_POST['btnSave']))
    {

		$imgName = $_FILES['myfile']['name'];
		$imgTmp = $_FILES['myfile']['tmp_name'];
		$imgSize = $_FILES['myfile']['size'];
        $name = $_POST['name'];
        $status = 1;
        if(empty($imgName))
        {
			$errorMsg = 'Please select photo 1';
        }
        else
        {
			//get file extension
			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			//allow extenstion
			$allowExt  = array('html', 'htm');

			//random new name for file
			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			//check a valid file
            if(in_array($imgExt, $allowExt))
            {
				//check file size less than 5MB
                if(($imgSize < 50000000))
                {
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);

                }
                else
                {
					$errorMsg = 'PDF too large';
				}
            }
            else
            {
				$errorMsg = 'Please select a valid Document';
			}
        }

        if(!isset($errorMsg)){
			$sql = "insert into emailtemplate(filename,name,status)
					values('".$userPic."','".$name."','".$status."')";
			$result = mysqli_query($con, $sql);
			if($result){
				$successMsg = 'New record added successfully';
				header('refresh:5;index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($con);
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
  <title>Color Spectrophotometer and Colorimeter Instrument Manufacturer</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include '../layout.php';?>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Email Template</h1>
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
                            <label for="exampleInputEmail1">PDF</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" name="myfile" id="customFile">
                                
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
</body>

</html>