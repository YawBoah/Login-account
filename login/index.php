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
           $password = $_POST["password"];
            require_once "../database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
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
          <input type="password" name="password " placeholder="Password" />
        </div>
        <br />

        <button name="submit">Login</button>
        </form>
        <br />
        <br />

        <div class="link">
          <a href="..//forgot-password/">Forgot password</a>
          <p>New here? <a href="..//signup/">Sign Up</a></p>
        </div>
      </div>
    </div>
  </body>
</html>
