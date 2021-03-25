<body>
<?php  
 require_once('../db.php');
 if(isset($_POST["employee_id"]))  
 {  
    $output = '';
    $query = "SELECT filename FROM emailtemplate WHERE id = '".$_POST["employee_id"]."'"; 
    $result = mysqli_query($con, $query);  
        while($row = mysqli_fetch_array($result))  
        {
            //echo "<iframe src='uploadtemplate/".$row['filename']."' width='200' height='200'></iframe>";
            $output .= "<iframe src='uploadtemplate/".$row['filename']."' width='100%' height='300'></iframe>";
        }
        echo $output; 
 }
?>
</body>
</html>