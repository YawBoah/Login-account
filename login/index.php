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
    <title>Login Page</title>
  </head>
  <body>
    <div class="content">
    <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["pwd"];
           $errors = array();
           $hasError = false;
           if(empty($password)){
              array_push($errors, "Enter your password");
              $hasError = true;
            }
            if(empty($email)){
              array_push($errors, "Enter your email");
              $hasError = true;
           }
           if(!$hasError){
            require_once "../database.php";
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($link, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            // var_dump($user);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                   array_push($errors, "Password does not match");
                  }
                }else{
                array_push($errors, "Email does not match");
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
        <div class="inner-content">
          <h1>Hello Again</h1>
          <p>Welcome back!</p>
  
          <form action="" method="post">
          <div class="one">
            <br />
            <i class="fa-regular fa-envelope"></i>
            <input type="text" name="email" placeholder="Email Address" />
          </div>
  
          <br />
          <div class="one">
            <br />
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="pwd" placeholder="Password" />
          </div>
          <br />
  
          <button name="login">Login</button>
          </form>
          <br />
          <br />
  
          <div class="link">
            <a href="..//forgot-password/">Forgot password</a>
            <p>New here? <a href="..//signup/">Sign Up</a></p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
