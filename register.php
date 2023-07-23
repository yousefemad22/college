<?php 
$page_title = "Register";
$css_file = 'register.css';
include_once("./includes/template/header.php");
include_once("./connectdb.php");

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email  = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password  = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

    $hased_password = password_hash($password,PASSWORD_DEFAULT);

    global $con;
    $stmt = $con->prepare("INSERT INTO users(name,email,password) value(?,?,?)");
    $stmt->execute(array($name,$email,$hased_password));

    echo "
    <script>
        toastr.success('Added successfull')
    </script>";
    header("Refresh:3;url=signin.php"); 
}
?>


<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<div class="container mt-5">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">email</label>
    <input type="email" name="email" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control">
  </div>

 
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>

<?php include_once("./includes/template/footer.php");
 ?>