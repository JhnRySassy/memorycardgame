<?php 
session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $user_name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            //save from database
            $user_id = random_num(20);
           $query = "insert into tbl_gamers (user_id,user_name,email,password) values ('$user_id','$user_name','$email','$password')" ;

           mysqli_query($con, $query);

           header("Location: Log_in.php");
           die;
        }else
        {
            echo "Please enter valid information!";
        }
    }

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/signup.css" />
    <script src="https://kit.fontawesome.com/780bb95a86.js" crossorigin="anonymous"></script>
    <title>Sign Up</title>
  </head>
  <body>
    <form method='post'>
    <div class="container">
      <div class="logo">
        <img src="assets/rickandmortylogo.png">
      </div>
      <div class="form-box">
        <h1 id="title">Sign Up</h1>
        <form>
          <div class="input-group">
            <div class="input-field" id="namefield">
              <i class="fa-solid fa-user"></i>
              <input id="text" placeholder="Name" name="name">
            </div>

            <div class="input-field">
              <i class="fa-solid fa-envelope"></i>
              <input id="email" placeholder="Email" name="email">
            </div>

            <div class="input-field">
              <i class="fa-solid fa-lock"></i>
              <input id="password" type="password" placeholder="Password" name="password">
            </div>
            <p>Already have an account? <a href="Log_in.php">Log In</a></p>
          </div>
          <div class="submitbtn">
            <input class="btnsubmit" id="button" type="submit" value="Sign Up">
          </div>
          <div class="btn-field">
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
