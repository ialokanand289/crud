<?php
$server="localhost";
$username="root";
$password="";
$database="create";

// connect a connection 
$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
    //echo "success!";
//}
//else{
    die("error!".mysqli_connect_error());

}



        if($_SERVER["REQUEST_METHOD"]=="POST"){

            $fname=$_POST["fname"];
            $lname=$_POST["lname"];
            $empId=$_POST["empId"];
            $addrs=$_POST["addrs"];
            $design=$_POST["design"];
            

            $sql="INSERT INTO `employee` (`f_name`, `l_name`, `emp_code`, `desig`, `addr`) VALUES ('$fname', '$lname','$empId', '$addrs','$design')";
            $result= mysqli_query($conn,$sql);
          
            echo "Submit Sucessfully";
        
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>create</title>
</head>
<body>
    <h2>Insert the Input</h2>
    <div class="container">
    <form class="row g-3" method="POST" action="#">
  <div class="col-md-4">
    <label for="validationDefault01" class="form-label">First name</label>
    <input type="text"  name="fname" class="form-control" id="validationDefault01"  required>
  </div>
  <div class="col-md-4">
    <label for="validationDefault02" class="form-label">Last name</label>
    <input type="text"  name="lname" class="form-control" id="validationDefault02"  required>
  </div>

  <div class="col-md-4">
    <label for="validationDefault02" class="form-label">Employee Id</label>
    <input type="text"  name="empId" class="form-control" id="validationDefault02"  required>
  </div>

  <div class="col-md-4">
    <label for="validationDefault02" class="form-label">Address </label>
    <input type="text"  name="addrs" class="form-control" id="validationDefault02"  required>
  </div>

  <div class="col-md-4">
    <label for="validationDefault02" class="form-label">Designation</label>
    <input type="text" name="design" class="form-control" id="validationDefault02"  required>
  </div>

  <div class="col-12">
    <button class="btn btn-primary" name="submit" type="submit">Submit form</button>
  </div>
</form>
</div>
    
</body>
</html>