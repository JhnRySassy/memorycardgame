<?php 
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password))
    {
      //read from database
       $query = "select * from tbl_gamers where user_name = '$user_name' limit 1";

       $result = mysqli_query($con, $query);

      if($result)
      {
        if($result && mysqli_num_rows($result) > 0 )
        {
            $user_data = mysqli_fetch_assoc($result);
            
            if($user_data["password"] === $password)
            {
              $_SESSION['user_id'] = $user_data['user_id'];
              header("Location: game.php");
              die;
            }else
          {
            echo "Wrong email or password";
          }
        }
      }
    }
}


?>





<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/login.css" />
    <script src="https://kit.fontawesome.com/780bb95a86.js" crossorigin="anonymous"></script>
    <title>Log In</title>
  </head>
  <body>
  <form method='post'>
    <div class="container">
      <div class="logo">
        <img src="assets/rickandmortylogo.png">
      </div>
      <div class="form-box">
        <h1 id="title">Log In</h1>
        <form>
          <div class="input-group">
            <div class="input-field">
              <i class="fa-solid fa-user"></i>
              <input id="username" type="username" placeholder="Username" name="username">
            </div>

            <div class="input-field">
              <i class="fa-solid fa-lock"></i>
              <input id="password "type="password" placeholder="Password" name="password">
            </div>
            <p><a href="Sign_up.php">Click Here to Sign Up</a></p>
          </div>
          <div class="submitbtn">
            <input class="btnsubmit" id="button" type="submit" value="Log In">
          </div>
          <div class="btn-field">
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
