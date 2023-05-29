<?php
  require_once('control.php');
  if (!$id = checkAuth()) {
    header("Location: login.php");
    exit;
  }

  //Verifica l'esistenza di dati
  if (!empty($_POST["Username"]) && !empty($_POST["email"]) && !empty($_POST["password"])){

    $error = array();
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    // Controlla che l'Username sia conforme 
    if (!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['Username'])) {
      $error[] = "Invalid username";
    } else {
      $Username = mysqli_real_escape_string($conn, $_POST['Username']);
      // Cerco se l'Username esiste già
      $query = "SELECT Username FROM users_db WHERE Username = '$Username'";
      $res = mysqli_query($conn, $query);
      if (mysqli_num_rows($res) > 0) {
        $error[] = "Username already exists";
      }
    }
    #Verifica PASSWORD
    if (strlen($_POST["password"]) < 8) {
      $error[] = "Insufficient character on password";
    }

    #Verifica EMAIL
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $error[] = "Invalid email";
    } else {
      $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
      $res = mysqli_query($conn, "SELECT email FROM users_db WHERE email = '$email'");
      if (mysqli_num_rows($res) > 0) {
        $error[] = "Email already used";
      }
    }

    if (count($error) == 0) {

      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $password = password_hash($password, PASSWORD_BCRYPT);

      $query = "INSERT INTO users_db (Username, email, password) VALUES('$Username', '$email', '$password')";

      if (mysqli_query($conn, $query)) {
        $_SESSION["Username"] = $_POST["Username"];
        $_SESSION["User_id"] = mysqli_insert_id($conn);
        mysqli_close($conn);
        header("Location: home2.php");
        exit;
      } else {
        $error[] = "Database Error : connection failed";
      }
    }

    mysqli_close($conn);
  } else if (isset($_POST["Username"])) {
    $error = ("Fill all required fields");
  }

?>


<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="register.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration</title>
</head>

<body>

  <main>

    <?php
      if (isset($error)) {
          echo "<p class='error'>$error</p>";
      }            
    ?>

    <div class="container">
      <form autocomplete="off" method="POST">
        <h1>Sign in</h1>
        <div class="form-group">
          <label for="Username">Username</label>
          <input type="text" id="Username" name="Username" <?php if(isset($_POST["Username"])){echo "value=".$_POST["Username"];} ?>>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
          <label for="password">Password (at least 8 character long)</label>
          <input type="password" id="password" name="password" minlength="8" maxlength="16" required />
        </div>
        <button type="submit">Sign-in</button><br>
        <br>
        <p>Already have an account?<a href="login.php">Login</a>
      </form>
    </div>
  </main>

  <footer>
    <ul>
      <li><a href="https://giphy.com/gifs/foxhomeent-3oz8xZvvOZRmKay4xy/fullscreen">About</a></li>
      <li><a href="https://giphy.com/gifs/eePSFNBFv2W9owZ4Sh/fullscreen">Contact</a></li>
      <li><a href="https://giphy.com/gifs/confused-really-tom-hanks-h6FObJ8zJjBte/fullscreen">Privacy Policy</a></li>
    </ul>
  </footer>
</body>

</html>