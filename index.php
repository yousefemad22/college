<?php 
session_start();
if(isset($_SESSION['name'])){
  $page_title = 'Students';
$css_file = 'home.css';
include_once("./includes/template/header.php");
include_once("./connectdb.php");

global $con;
$stmt = $con->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll();


?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">college</th>
      <th scope="col">GPA</th>
      <th scope="col">Department</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>


  <?php foreach($students as $student){ ?>
    <tr>
      <td><?php echo $student['id']?></td>
      <td><?php echo $student['name']?></td>
      <td><?php echo $student['college']?></td>
      <td><?php echo $student['gpa']?></td>
      <td><?php echo $student['department']?></td>
      <td><a class="btn btn-success" href="edit.php?stu_id=<?php echo $student['id']?>">Update</a></td>
      <td><a class="btn btn-danger" href="delete.php?stu_id=<?php echo $student['id']?>">Delete</a></td>
    </tr>
    <?php } ?>

  </tbody>
</table>


 

<div class="btn-group">
  <a href="add_student.php" class="btn btn-primary " aria-current="page">Add Student</a>
  <a href="register.php" class="btn btn-primary  ">Add Register</a>
  <a href="logout.php" class="btn ">logout</a>
</div>

<?php
}else{
  header("location:signin.php");
} 
include_once('./includes/template/footer.php');
?>