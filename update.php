<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "create";

// connect a connection
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    //echo "success!";
    //}
    //else{
    die("error!" . mysqli_connect_error());
}
$sql = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql);

if (isset($_POST['update'])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $empId = $_POST["empId"];
    $addrs = $_POST["addrs"];
    $design = $_POST["design"];

    $sql = "UPDATE `employee` SET `f_name` = '$fname', `l_name` = '$lname', `emp_code` = '$empId', `addr` = '$addrs' , `desig` = '$design' WHERE  `id` = '$empId' ";
    $result = mysqli_query($conn, $sql);

    if ($result == true) {
        echo "Record Successfully Updated";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $empId = $_GET['id'];
    $sql = "SELECT * FROM `employee` WHERE `id`= '$empId' ";
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            //print_r($row);

            $fname = $row["f_name"];
            $lname = $row["l_name"];
            // $empId=$row["emp_code"];
            $addrs = $row["addr"];
            $design = $row["desig"];
?>
            <html>

            <body>

                <h2>User Update Form</h2>
                <form action="" method="post">
                    <fieldset>
                        <legend>Personal information</legend>
                        First Name: <br>
                        <input type="text" name="fname" value="<?php echo $fname; ?>"><br>

                        last Name: <br>
                        <input type="text" name="lname" value="<?php echo $lname; ?>"><br>

                        <input type="hidden" name="empId" value="<?php echo $empId; ?>">

                        Address: <br>
                        <input type="text" name="addrs" value="<?php echo $addrs; ?>"><br>
                        Designation: <br>
                        <input type="text" name="design" value="<?php echo $design; ?>"><br>

                        <br>
                        <input type="submit" value="update" name="update">
                    </fieldset>


                </form>

    <?php
        }
    }
}
    ?>
            </body>

            </html>

        