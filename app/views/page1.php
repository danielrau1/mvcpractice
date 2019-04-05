<?php require 'C:\xampp\htdocs\mvcpractice\app\views\navbar.php';
session_start();
?>

<h1>Page1</h1>
<h3>Hi <?php echo $_SESSION['currentUser']?></h3>