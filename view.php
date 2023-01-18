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
$sql= "SELECT * FROM employee";
$result= mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Employee Details</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>f_name</th>
                    <th>l_name</th>
                    <th>emp_code</th>
                    <th>desig</th>
                    <th>addr</th>
                
            
                </tr>
            </thead>
            <tbody>
                
                <?php
                //print_r($result);
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        
                        //print_r($row);
                ?>
                <tr>
                    <td><?php echo $row['id']; ?> </td>
                    <td><?php echo $row['f_name']; ?> </td>
                    <td><?php echo $row['l_name']; ?> </td>
                    <td><?php echo $row['emp_code']; ?> </td>
                    <td><?php echo $row['desig']; ?> </td>
                    <td><?php echo $row['addr']; ?> </td>
                    <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">EDIT</a>&nbsp;
                <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">DELETE </a></td>
                </tr>
                <?php    }
                }

                ?>
            </tbody>
        </table>
    </div>

    
</body>
</html>

