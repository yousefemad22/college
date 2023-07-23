<?php 
session_start();
if(isset($_SESSION['name'])){
  
$page_title = "Edit students ";
$css_file = 'register.css';
include_once("./includes/template/header.php");
include_once("./connectdb.php");

if(isset($_GET['stu_id'])){
    $id=$_GET['stu_id'];
    $stmt = $con->prepare("SELECT * FROM students WHERE Id=?");
    $stmt->execute(array($_GET['stu_id']));
    $stu_data = $stmt->fetch();
   
}else{
    header('location:index.php');
}

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $college = filter_var($_POST['college'], FILTER_SANITIZE_STRING);
    $gpa = $_POST['gpa'];
    $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);

    $stmt = $con->prepare('UPDATE students SET name=?,college=?,GPA=?,department=? WHERE id=?');
    $stmt->execute(array($name,$college,$gpa,$department, $_GET['stu_id']));
    echo"
    <script>
        toastr.success('Updated successfull')
    </script>";
    header("Refresh:2,url=index.php");
  }

?>


<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<div class="container mt-5">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" value="<?php echo $stu_data['name'];?>" name="name" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">College</label>
    <input type="text" name="college" value="<?php echo $stu_data['college'];?>" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">GPA</label>
    <input type="text" name="gpa" value="<?php echo $stu_data['gpa'];?>" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Department</label>
    <input type="text" name="department" value=" <?php echo $stu_data['department'];?>" class="form-control">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>


<?php
}else{
  header("location:signin.php");
} 
include_once("./includes/template/footer.php");
 ?>