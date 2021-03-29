<?php
    include('../login/session.php');
    if(!isset($_SESSION['login_user'])){
        header("location: ../login/index.php"); 
    }
    require_once('../db.php');
    include('../sendemail.php');
$upload_dir = 'uploadtemplate/';


    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "select * from campaign where id=".$id;
        $result = mysqli_query($con,$sql);
        if (mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);
        }
        else
        {
            $errorMsg = 'Could not select a record';
        }
    }
    if(isset($_POST['btnSave']))
    {
        $subject = $_POST['subject'];
        $emailfrom = $_POST['emailfrom'];
        $fromname = "Heet Kalaria";
        $sql = "SELECT campaign.templateid, emailtemplate.filename from campaign INNER JOIN emailtemplate on campaign.templateid= emailtemplate.id where campaign.id=".$id;
        $result = mysqli_query($con,$sql);
        $rowcampaign = mysqli_fetch_assoc($result);
        $sqlgetemail = "SELECT campaignemail.customerid, customerlist.name, customerlist.emailid from campaignemail INNER JOIN customerlist on campaignemail.customerid=customerlist.id where campaignid=".$id;
        $resultgetemail = mysqli_query($con,$sqlgetemail);
        if(mysqli_num_rows($resultgetemail)){
            while($row = mysqli_fetch_assoc($resultgetemail)){
                sendEmail($subject,$row['emailid'],$emailfrom,$row['name'],$fromname,$rowcampaign['filename']);
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
            <h1 class="h3 mb-0 text-gray-800" >Run a Campaign</h1>
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
                            <label for="exampleInputEmail1">Enter email Subject</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter email Subject" name="subject">
                        </div>
                         
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Template</label>
                            <select name="emailfrom" id="templateid" class="form-control">
                                <?php 
                                    $sql = "select * from myemail";
                                    $result = mysqli_query($con, $sql);
                                    if(mysqli_num_rows($result)){
                                        while($row = mysqli_fetch_assoc($result)){
                                       
                                ?>
                                        <option value="<?php echo $row['emailid']?>"><?php echo $row['emailid']?></option>
                                <?php 
                                        }
                                    }
                                ?>
                                
                            </select>
                        </div>  
                        <button type="submit" class="btn btn-primary" name="btnSave">Submit</button>
                    </form>
                </div>
                    <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary" id="count">Email Reciepent List</h6>
                        
                    </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $counter=1;
                                    $sql = "SELECT campaignemail.customerid, customerlist.name, customerlist.emailid from campaignemail INNER JOIN customerlist on campaignemail.customerid=customerlist.id where campaignid=".$id;
                                    $result = mysqli_query($con, $sql);
                                    if(mysqli_num_rows($result)){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <tr>
                                        <td><?php echo $counter?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['emailid'];?></td>
                                        
                                    </tr>
                                <?php $counter++;
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                                
                        </div>
                        
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
  <script>
    window.updateCount = function() {
        var x = $(".z:checked").length;
        document.getElementById("count").innerHTML = x+' Selected';
    };

  </script>
</body>

</html>