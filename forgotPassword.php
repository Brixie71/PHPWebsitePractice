<?php

include_once "resources/php/Database.php";
include_once "resources/php/utility.php";

if (isset($_POST['submit'])) {

  $form_errors = array();

  if (empty($form_errors)) {

    $email = $_POST['email'];
    $npass = $_POST['new_password'];
    $cpass = $_POST['confirm_password'];

    if ($npass != $cpass) {

      $result = "<p style='padding: 20 px; border: 1px solid gray; color:red;'> New password and confirm password do not match! </p>";



    } else {

      try {

        $sqlQuery = "SELECT email FROM users WHERE email =:email";

        $statement = $conn->prepare($sqlQuery);

        $statement->execute(array(':email' => $email));

        if ($statement->rowCount() == 1) {

          //$hashed_password = password_hash($npass, PASSWORD_DEFAULT);

          $sqlUpdate = "UPDATE users SET password=:password WHERE email=:email";

          $statement = $conn->prepare($sqlUpdate);

          $statement->execute(array(':password' => $npass, ':email' => $email));

          $result = "<p style='padding:20px; border: 1px solid gray; color: green;'> Password Reset Successful!";



        } else {

          $result = "<p style='padding:20px; border: 1px solid gray; color: red;'> The Email address Provided does not exist in our database,
            Please try again!</p>";

        }



      } catch (PDOException $ex) {

        $result = "<p style='padding:20px; border: 1px solid gray; color: red;'> An error occured: " . $ex->getMessage() . "</p>";

      }

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

  <title>BTS | Forgot Password</title>

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

    .resetContainer {

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
  <h2 class="pageHeader"> BRION TACTICAL SYSTEMS </h2>
  <hr>
  <div>
    <div class="resetContainer">
      <h3>Password Reset Form<h3>

          <?php

          if (isset($result))
            echo $result;

          ?>
          <?php

          if (!empty($form_errors))
            echo show_errors($form_errors);

          ?>

          <form method="post" action="">

            <table>
              <tr>
                <td>Email : </td>
                <td><input type="text" value="" name="email"></td>
              </tr>

              <tr>
                <td>New Password : </td>
                <td><input type="text" value="" name="new_password"></td>
              </tr>
              <tr>
                <td>Confirm Password : </td>
                <td><input type="text" value="" name="confirm_password"></td>
              </tr>
              <tr>
                <td>
                  <p><a style="color: #ffd000;" href="login.php">Back</a> </p>
                </td>
                <td><input style="float: right" type="submit" value="Submit" name="submit"></td>
              </tr>

            </table>

          </form>


    </div>
  </div>


</body>

</html>