<!DOCTYPE html>
<html>

<head lang="en">
  <meta charset="UTF-8">

  <title>Homepage</title>
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    form {

      margin: 15px;
      color: white;


    }

    button {
      padding: 15px;
      border-color: #ffd000;
      border-width: 3px;
      border-style: solid;
      border-radius: 10px;
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

    .IndexContainer {

      background-color: rgb(0, 0, 50);
      color: white;

      display: grid;
      margin: 15px 15px 15px 15px;

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
    <div class="IndexContainer">
      <p> You are currently not signed in.
      <form action="login.php">
        <button class="button">Login</button>
      </form>
      </p>
      <p> Not yet a memeber?
      <form action="signup.php">
        <button class="button">Sign up</button>
      </form>
      </p>


      <?php

      include_once 'resources/php/Database.php';

      ?>

    </div>
  </div>
</body>

</html>