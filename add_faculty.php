<?php
$insert = false;
if (isset($_POST['f_name'])) {

  $server = "localhost";
  $username = "root";
  $password = "";

  $con = mysqli_connect($server, $username, $password);

  if (!$con) {
    die("Connection to this database failed due to" . mysqli_connect_error());
  }
  //echo "Success connecting to the db";
  $f_name = $_POST['f_name'];
  $description = $_POST['description'];
  $img_url = $_POST['img_url'];

  $sql = "INSERT INTO `Dbs`.`faculty` (`f_name`, `description`, `image_url`, `created_at`) VALUES ('$f_name', '$description', '$img_url', current_timestamp());";
  //echo $sql;

  if ($con->query($sql) == true) {
    //echo "Successfully inserted";
    $insert = true;
  } else {
    echo "ERROR: $sql <br> $con->error";
  }

  $con->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet" />
  <title>Department of Biological Sciences</title>
</head>

<body>

  <body>
    <div class="top"></div>
    <div class="main">
      <div class="header mt-3">
        <div class="row justify-content-around">
          <div class="col-8">
            <a href="#">
              <h2 class="text-dark" style="font-size: 2.3em; font-weight: 900; letter-spacing: -1px">
                Department
                <span class="bs" style="
                    font-size: 0.95em;
                    font-family: 'Roboto Condensed';
                    font-weight: 400;
                  ">of Biological Sciences</span>
              </h2>
            </a>
            <a href="https://www.tifr.res.in/" target="_blank">
              <h3 class="fw-normal">Tata Institute of Fundamental Research</h3>
            </a>
            <hr />
          </div>
          <div class="col-4 logo">
            <img src="https://www.tifr.res.in/~dbs/img/tifr.png" alt="tifr" />
            <h4 class="mt-2">हिंदी रूपंतर</h4>
          </div>
        </div>
        <div class="navbar-header mt-4">
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="faculty.php">Faculty</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="students.html">Academics</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="conferences.html">Conferences</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="positions.html">Positions Open</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
      <div class="mt-5 p-4">
        <?php require_once 'database.php'; ?>
        <?php
        $server = "localhost";
        $username = "root";
        $password = "";

        $con = mysqli_connect($server, $username, $password);

        if (!$con) {
          die("Connection to this database failed due to" . mysqli_connect_error());
        }
        $result = $con->query("SELECT * FROM `Dbs`.`faculty`") or die($con->error);
        ?>
        <div class="row justify-content-center">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Created at</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) : ?>
              <tr>
                <td><?php echo $row['f_id']; ?></td>
                <td><?php echo $row['f_name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><img src="<?php echo $row['image_url']; ?>" style="width: 100%;"></td>
                <td><?php echo $row['created_at']; ?></td>
                <td colspan="2">
                  <a href="add_faculty.php?edit=<?php echo $row['f_id']; ?>" 
                  class="btn btn-warning">Edit</a>
                  <a href="database.php?delete=<?php echo $row['f_id']; ?>" 
                  class="btn btn-danger">Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </table>
        </div>
        <div class="row faculty_form mt-5">
          <h3 class="text-secondary text-center">Add Faculty</h3>
          <form action="add_faculty.php" method="post">
            <label for="f_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="f_name" name="f_name">
            <label for="description" class="form-label mt-3">Description</label>
            <input type="text" class="form-control" id="description" name="description">
            <label for="img_url" class="form-label mt-3">Image URL</label>
            <input type="text" class="form-control" id="img_url" name="img_url">
            <div class="form-btns">
              <button type="reset" class="btn btn-secondary mt-3">Reset</button>
              <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
          </form>
          <?php
          if ($insert == true) {
            echo "<h5 class='text-success text-center mt-3'>Faculty member added successfully!</h5>";
          }
          ?>
        </div>
      </div>
    </div>
    <!--Add Faculty Form-->

    <div class="footer">
      &copy; Webmaster, Department of Biological Sciences, TIFR, Mumbai<br />
      Last updated on 6 March, 2019
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</body>

</html>