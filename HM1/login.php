<?php
  // Verifica che l'utente sia già loggato
  require_once('control.php');
  if (!$id = checkAuth()) {
    header("Location: login.php");
    exit;
  }


  if (!empty($_POST["Username"]) && !empty($_POST["password"])) {
    //Verifica dell invio di Username e password
    // Connessione al DB
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    // ID e Username per sessione, password per controllo
    $query = "SELECT * FROM users_db WHERE Username = '" . $Username . "'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;

    if (mysqli_num_rows($res) > 0) {
      //Ritorna una riga (un solo utente loggato)
      $entry = mysqli_fetch_assoc($res);
      if (password_verify($_POST['password'], $entry['password'])) {

        // Imposto sessione dell'utente
        $_SESSION["Username"] = $entry['Username'];
        $_SESSION["User_id"] = $entry['id'];
        header("Location: home2.php");
        mysqli_free_result($res);
        mysqli_close($conn);
        exit;
      }
    }
    //Errori per pass e username
    $error = "Wrong Username or password.";
  } else if (isset($_POST["Username"]) || isset($_POST["password"])) {
    // Se solo uno dei due è impostato
    $error = "Missing username or password.";
  }
?>

<!DOCTYPE html>
<html>

<head>
  
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="login.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

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
        <h1>Login</h1>
        <div class="form-group">
          <label for="Username">Username</label>
          <input type="text" id="Username" name="Username" <?php if(isset($_POST["Username"])){echo "value=".$_POST["Username"];} ?>>
        </div>
        <div class="form-group">
          <label for="password">Password (at least 8 character long)</label>
          <input type="password" id="password" name="password" minlength="8" maxlength="16" required />
        </div>
        <button type="submit">Login</button><br>
        <br>
        or if you haven't an account yet
        <a href="signup.php">Create it!</a>
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