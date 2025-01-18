<?php

include_once "resources/php/Database.php";
include_once "resources/php/utility.php";


if (isset($_POST['submit'])) {

  $form_errors = array();

  $required_fields = array('email', 'username', 'password');

  foreach ($required_fields as $name_of_field) {

    if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {

      $form_errors[] = $name_of_field . " is a required field";

    }
  }

  if (empty($form_errors)) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {

      $sqlInsert = "INSERT INTO users (username, email, password, join_date) VALUES (:username, :email, :password, now())";

      $statement = $conn->prepare($sqlInsert);

      $statement->execute(array(':username' => $username, ':email' => $email, ':password' => /*$password*/$password));

      if ($statement->rowCount() == 1) {
        $result = "<p style='padding:20px; color : green;'> Registration Success! </p>";
      }

    } catch (PDOException $ex) {
      $result = "<p> Registration Failed. <br> Error Details : " . $ex->getMessage() . "</p>";
    }


  } else {

    if (count($form_errors) == 1) {

      $result = "<p style='color : red;' > There was 1 error in the form <br>";

      $result .= "<ul style='color : red;'>";

      foreach ($form_errors as $error) {

        $result .= "<li> {$error} </li>";

      }

      $result .= "</ul></p>";

    } else {

      $result = "<p style='color: red';> There were " . count($form_errors) . " errors in the form <br>";

      $result .= "<ul style='color : red;'>";

      foreach ($form_errors as $error) {

        $result .= "<li> {$error} </li>";

      }

      $result .= "</ul></p>";

    }

  }

}

?>

<!DOCTYPE html>
<html>

<head lang="en">
  <meta charset="UTF-8">

  <title>BTS | Registration</title>
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

    input {
      padding: 15px;
      border-color: #ffd000;
      border-width: 3px;
      border-style: solid;
      border-radius: 10px;
    }

    div {

      padding: 150px;
      margin: 20px, 25px, 20px, 25px;


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

    .registerContainer {

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
  <h2 class="pageHeader"> User Authentication System </h2>
  <hr>
  <div>
    <div class="registerContainer">
      <h3>Registration Form<h3>

          <?php

          if (isset($result))
            echo $result;

          ?>

          <form method="post" action="">

            <table>
              <tr>
                <td>Email : </td>
                <td><input type="text" value="" name="email"></td>
              </tr>

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
                  <p><a style="color: #ffd000;" href="index.php">Back</a> </p>
                </td>
                <td><input style="float: right" type="submit" value="Register" name="submit"></td>
              </tr>

            </table>

          </form>


    </div>
  </div>

</body>

</html>