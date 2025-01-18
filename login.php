<?php

include_once 'resources/php/Database.php';
include_once 'resources/php/utility.php';

if (!isset($_POST['login'])) {

  $form_errors = array();

  $required_fields = array('username', 'password');
  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

  if (empty($form_errors)) {

    $user = $_POST['username'];
    $password = $_POST['password'];

    $sqlQuery = "SELECT * FROM users WHERE username = :username";

    $statement = $conn->prepare($sqlQuery);

    $statement->execute(array(':username' => $user));

    while ($row = $statement->fetch()) {

      $id = $row['id'];
      $hashed_password = $row['password'];
      $username = $row['username'];

      if (password_verify($password, $hashed_password)) {

        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        header("Location:login.php");


      } else {

        $result = "<p style='padding: 20px; color:red; border: 1px solid gray;' > Invalid Username or Password! </p>";


      }

    }

  } else {
    if (count($form_errors) == 1) {

      $result = "<p style='color: red;'> There was one error in the form </p>";

    } else {

      $result = "<p styles'color:red;'> There were " . count($form_errors) . " error in the form</p>";

    }

  }


}

?>

<!DOCTYPE html>
<html>

<head lang="en">
  <meta charset="UTF-8">

  <title>BTS | Login Page</title>
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    body {

      background-image: url('resources/Images/prmsbackground.gif');
      background-repeat: repeat;
      background-size: cover;

    }

    div {

      padding: 150px;
      margin: 20px, 25px, 20px, 25px;


    }

    button {
      padding: 15px;
      border-color: #ffd000;
      border-width: 3px;
      border-style: solid;
      border-radius: 10px;
    }

    input {
      padding: 15px;
      border-color: #ffd000;
      border-width: 3px;
      border-style: solid;
      border-radius: 10px;
    }


    .pageHeader {

      padding: 20px;
      margin: 10px 15px 10px 15px;
      background-color: rgb(0, 0, 50);

      color: #ffd000;

      border-color: #ffd000;
      border-width: 3px;
      border-style: solid;
      border-radius: 50px;

      justify-content: center;
      justify-items: center;

      align-items: center;
      text-align: center;
    }

    .loginContainer {

      background-color: rgb(0, 0, 50);
      color: white;

      display: grid;
      margin: 10px 15px 10px 15px;

      padding: 30px;
      justify-content: center;
      justify-items: center;

      align-items: center;
      text-align: center;
      border-color: #ffd000;
      border-width: 3px;
      border-style: solid;
      border-radius: 50px;

    }
  </style>
</head>

<body>
  <h2 class="pageHeader"> BRION TACTICAL SYSTEMS</h2>
  <hr>
  <div>
    <audio id="audio" src="resources/music/music.mp3" autoplay></audio>
    <div class="loginContainer">
      <h3>Login Form<h3>

          <?php
          if (isset($result))
            echo $result;
          ?>

          <?php if (!empty($form_errors))
            echo show_errors($form_errors); ?>

          <form method="post" action="">

            <table>
              <tr>
                <td>Username : </td>
                <td><input type="text" value="" name="username"></td>
              </tr>
              <tr>
                <td>Password : </td>
                <td><input type="text" value="" name="password"></td>
              </tr>
              <tr>
                <td>
                  <p><a style="color: #ffd000;" href="forgotPassword.php">Forgot Password?</a> </p>
                </td>

                <td><input style="float: right" type="submit" name="login" value="Login"></td>
              </tr>

            </table>

          </form>

          <form action="index.php">
            <button class="button">Back</button>
          </form>
    </div>
  </div>
  <script>
    var audio = document.getElementById("audio");
    audio.volume = 0.1;

  </script>
  <?php

  include_once 'resources/php/Database.php';

  ?>



</body>

</html>