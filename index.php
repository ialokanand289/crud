<?php
$insert = false;
$update=false;
$server = "localhost";
$username = "root";
$password = "";
$database = "notes";

// connect a connection
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
  //echo "success!";
  //}
  //else{
  die("error!" . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST["snoEdit"])){

    //print_r($_POST);
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];
    $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno`=$sno";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update= true;
    } else {
      echo " the record is not updated successfully";
    }
  }
  else{
      $title = $_POST["title"];
      $description = $_POST["description"];
      $sql = "INSERT INTO `notes` (`title`,`description`) VALUES ('$title','$description')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $insert = true;
      } else {
        echo " the record is not inserted successfully because of this error" . mysqli_error($conn);
      }
      }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" class="css">
  <title>iNotes - makes easy to search!</title>

</head>

<body>

  <!-- edit modal -->
  <!-- //<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
 Edit modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="editModalLabel  ">Edit This Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/crud/index.php" method="POST">
          <div class="modal-body">
          
            <input type="hidden" class="snoEdit" id="snoEdit" name="snoEdit">
            <div class="mb-3 my-4">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">

            </div>

            <div class="form-floating">
              <textarea class="form-control" name="descriptionEdit" placeholder="Leave a comment here" id="descriptionEdit"></textarea>
              <label for="desc">Note Description</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update Note</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>  
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">iNotes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Note is inserted Succussfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Note is UPDATED Succussfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>

  <div class="container my-4">
    <h2>
      Add a Notes
    </h2>
    <form action="/crud/index.php" method="POST">
      <div class="mb-3 my-4">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

      </div>

      <div class="form-floating">
        <textarea class="form-control" name="description" placeholder="Leave a comment here" id="description"></textarea>
        <label for="description">Note Description</label>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Add Notes</button>
    </form>
  </div>

  <div class="container" my-4>

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S no.</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo  "<tr>
      <th scope='row'>" . $sno . "</th>
      <td>" . $row['title'] . "</td>
      <td>" . $row['description'] . "</td>
      <td>  <button class='edit btn btn-sm btn-primary' id=" .$row['sno']. ">Edit</button><a href='/del'>Delete</a>  </td>
    </tr>";
        }

        ?>
      </tbody>

  </div>
  

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit", );
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    })
  </script>
</body>
</html>