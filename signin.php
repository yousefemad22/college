<?php 
$page_title = "Sign In";
$css_file = 'register.css';
include_once("./includes/template/header.php");
include_once("./connectdb.php");

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $email  = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password  = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    
    global $con;
    $stmt = $con->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute(array($email));
    $user_data = $stmt->fetch();
    $row_count = $stmt->rowCount();
    if($row_count > 0){
        // if(sha1($passwrd) == $user_data['password']){
        if(password_verify($password,$user_data['password'])){
            @session_start();
            $_SESSION['id']    = $user_data['id'];
            $_SESSION['name']  = $user_data['name'];
            $_SESSION['email']  = $user_data['email'];
            echo "
            <script>
                toastr.success('login successful')
            </script>";
            header("Refresh:1;url=index.php");
        }else{
            echo "
            <script>
                toastr.error('uncorrect password')
            </script>";
        }
    }else{
        echo "
            <script>
                toastr.error('uncorrect Email')
            </script>";
    }
  }

?>


<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<div class="container mt-5">

  <div class="mb-3">
    <label class="form-label">email</label>
    <input type="email" name="email" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>

 
  <button type="submit" class="btn btn-primary">Login</button>
</div>
</form>

<?php include_once("./includes/template/footer.php");
 ?>