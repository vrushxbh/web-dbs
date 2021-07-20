<?php

session_start();
$server = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($server, $username, $password);

if (isset($_POST['f_name'])){
    $f_name = $_POST['f_name'];
    $description = $_POST['description'];
    $img_url = $_POST['img_url'];

    $sql = "INSERT INTO `Dbs`.`faculty` (`f_name`, `description`, `image_url`, `created_at`) VALUES ('$f_name', '$description', '$img_url', current_timestamp());";

}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $con->query("DELETE FROM `Dbs`.`faculty` WHERE f_id=$id") or die($con->error);
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    ob_start();
    header("Location: add_faculty.php");
    ob_end_flush();
    die();

}

if (isset($_GET['edit'])){
    $id = $_GET['f_id'];
    $result = $con->query("SELECT * FROM `Dbs`.`faculty` WHERE f_id=$id") or die($con->error);
    if($result){
        $row = $result->fetch_array();
        $f_name = $row['f_name'];
        $description = $row['description'];
        $img_url = $row['img_url'];
    }
}

?>