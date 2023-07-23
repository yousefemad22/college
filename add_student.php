<?php
session_start();
$page_title = "Add Student";
$css_file = "register.css";
if(isset($_SESSION['name'])){
  
include_once("./includes/template/header.php");
require_once("./connectdb.php");

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $college = filter_var($_POST['college'], FILTER_SANITIZE_STRING);
    $GPA = $_POST['gpa'];
    $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);

    global $con;
    $stmt = $con->prepare("INSERT INTO students(name , college , gpa ,department) VALUE (?,?,?,?)");
    $stmt->execute(array($name, $college, $GPA, $department));
    echo "
    <script>
        toastr.success('Added successfull')
    </script>";
    header('Refresh:2;url=add_student.php');
}
?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<div class="container mt-5">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">College</label>
    <input type="text" name="college" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">GPA</label>
    <input type="number" min="0" max="4" step="0.1" name="gpa" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Department</label>
    <input type="text" name="department" class="form-control" required>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>

<?php
}else{
  header("location:siginin.php");
}
include_once("./includes/template/footer.php");
?>