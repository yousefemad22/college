<?php
session_start();
if(isset($_SESSION['name'])){
    require_once("./connectdb.php");

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['stu_id'])) {
        global $con;
        $stmt = $con->prepare('DELETE FROM students WHERE id=?');
        $stmt->execute(array($_GET['stu_id']));
        header("location:index.php");
    }
}
}
else{
    header("location:singin.php");
}
?>