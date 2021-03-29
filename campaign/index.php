<?php
    include('../login/session.php');
    if(!isset($_SESSION['login_user']))
    {
        header("location: ../login/index.php"); 
    }

    require_once('../db.php');
    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $sql = "delete from campaign where id=".$id;
        if(mysqli_query($con, $sql))
        {
            header('location:index.php');
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
  <title>Email Marketing | Heet Kalaria</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include '../layout.php';?>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Campaign</h1>
                
            </div>
            <div class="row">
                <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Campaign</h6>
                  <a href="addnew.php" class="btn btn-sm btn-success">Add New</a>
                </div>
                <div class="table-responsive p-3">
                
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Index</th>
                        <th>Campaign Name</th>
                        <th>Campaign Description</th>
                        <th>Template</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        
                    <?php
                        $counter=1;
                        $sql = "select * from campaign";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result)){
                            while($row = mysqli_fetch_assoc($result)){
                    ?>
                      <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $row['campaignname'];?></td>
                        <td><?php echo $row['campaigndesc'];?></td>
                        
                        <td>
                          <input type="button" name="view" class="btn btn-sm btn-warning view_template" id="<?php echo $row['id'] ?>" value="View">
                        </td>
                        
                        
                        <td>
                          <a class="btn btn-sm btn-success" href="run.php?id=<?php echo $row['id']?>">
                            Run
                          </a>
                          <a class="btn btn-sm btn-info" href="edit.php?id=<?php echo $row['id']?>">
                            Edit
                          </a>
                          <a class="btn btn-sm btn-danger" href="index.php?delete=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure to delete this record?')">
                            Delete
                          </a>
                        </td>
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
        
          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                <h4 class="modal-title">Template View</h4> 
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                      
                </div>  
                <div class="modal-body" id="template_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 30px; background-color: #FE3F49; color: white">Close</button>  
                </div>  
           </div>  
      </div>  
 </div> 
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      
      <!-- Footer -->
    </div>
  </div>
   
  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>  

  
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable({
        "bPaginate": false,
        "ordering": false
      }); // ID From dataTable 
      
    });
  </script>
  <script>  
  $(document).ready(function(){  
    $('.view_template').click(function(){  
      var employee_id = $(this).attr("id");  
      $.ajax({  
        url:"select.php",  
        method:"post",  
        data:{employee_id:employee_id},  
          success:function(data){  
          $('#template_detail').html(data);  
          $('#dataModal').modal("show");  
        }  
      });  
    });  
 });  
 </script>
</body>

</html>