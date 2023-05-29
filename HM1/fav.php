<?php 
  require_once('control.php');
?>

<?php
  if(isset($_GET['stampa_fav'])){
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $query = "SELECT *FROM users_fav";
    $array_row = array();
    $res = mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($res)){ 
      $array_row[] = $row;
    }
    echo json_encode($array_row);
    exit;
  }
?>

<?php
  if(isset($_GET['id_carta'])){
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $id = mysqli_real_escape_string($conn,$_GET['id_carta']);
    $query = "DELETE FROM users_fav where id = $id";
    $array_row = array();
    $res = mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($res)){ 
      $array_row[] = $row;
    }
    echo json_encode($array_row);
    exit;
  }
?>

<!DOCTYPE html>
<html>

  <?php   
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']); 
    $query2 = "SELECT *FROM users_fav"; 
    $res_2 = mysqli_query($conn,$query2); 
  ?>

  <head>
    <script src="stampa_fav.js" defer="true"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    <link rel="stylesheet" href="home2.css">
  </head>

  <body>

    <header>
      <div id="logo">Pokemedia</div>

      <nav>
        <ul>
          <li><a href="home2.php">Home</a></li>
          <li><a href="messages.php">Messages</a></li>
          <div class="dropdown">
            <li><a>Settings</a></li>
            <div class="dropdown-options">
              <a href="">Favourite</a>
              <a href="login.php">Logout</a>
            </div>
          </div>
        </ul>
      </nav>
    </header>
    
    <article id="album-view"></article>
      
    <footer>
      <ul>
        <li><a href="https://giphy.com/gifs/foxhomeent-3oz8xZvvOZRmKay4xy/fullscreen">About</a></li>
        <li><a href="https://giphy.com/gifs/eePSFNBFv2W9owZ4Sh/fullscreen">Contact</a></li>
        <li><a href="https://giphy.com/gifs/confused-really-tom-hanks-h6FObJ8zJjBte/fullscreen">Privacy Policy</a></li>
      </ul>
    </footer>
  </body>
</html>