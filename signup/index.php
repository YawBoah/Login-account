<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/base.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>SignUp Page</title>
  </head>
  <body>
    <div class="content">

    <?php 
if (isset($_POST["submit"])) {
  $fullname = $_POST["fullname"];
  $email = $_POST["email"];
  $password = $_POST["password"];  

  $passwordHash = password_hash($password, PASSWORD_DEFAULT);

  $errors = array();
  if (empty($fullname) OR empty($email) OR empty($password)){
    array_push($errors, "All fields are required"); 
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, "Email is not valid");
  }
  if(strlen($password) < 8){
    array_push($errors, "Password must be at least 8 characters long");
  }

  if (count($errors) > 0) {
    foreach ($errors as $error) {
      echo "<div class='alert alert-danger'>" . $error . "</div>";
    }
  } else {
    require_once "../signup/database.php";
    $sql = "INSERT INTO user (full_name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($link);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
    if ($prepareStmt) {
      mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordHash);
      mysqli_stmt_execute($stmt);
      echo "<div class='alert alert-success'>You are registered successfully.</div>";
    } else {
      die("Something went wrong");
    }
  }
} 
?>

      <div class="left-content">
        <div class="main">
          <h1>GoFinance</h1>
          <p>The most popular peer to peer lending at SEA</p>
          <button>Read More</button>
        </div>
      </div>

      <div class="right-content">
        <h1>Hello!</h1>
        <p>Sign Up to Get Started</p>

        <form action="" method="post">
          <div class="one">
            <br />
            <i class="fa-solid fa-user"></i>
            <input type="text" name="fullname" placeholder="Full Name" />
          </div>
          <br />
  
          <div class="one">
            <br />
            <i class="fa-regular fa-envelope"></i>
            <input type="text" name="email" placeholder="Email Address" />
          </div>
   
          <br />
          <div class="one">
            <br />
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password" />
          </div>
          <br />
  
          <button name="submit" >Register</button>
          <br />
          <br />

        </form>

        <div class="link">
          <!-- <a href="/forgot-password/">Forgot password</a> -->
          <p>Already have an account? <a href="../login/">Login</a></p>
        </div>
      </div>
    </div>
  </body>
</html>
