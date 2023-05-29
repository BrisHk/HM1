<?php 
  require_once('control.php');
?>

<?php
if(isset($_GET['msg'])){

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $Username = mysqli_real_escape_string($conn, $_SESSION['Username']);
    $msg = mysqli_real_escape_string($conn, $_GET['msg']);
    $query = "INSERT INTO users_msg(Username, msg, time_msg) VALUES (\"$Username\",\"$msg\",CURRENT_TIMESTAMP())"; 
    $res = mysqli_query($conn,$query);
    if($res) echo json_encode("inserimento avvenuto con successo!");
    mysqli_close($conn);
    exit;
    }
?>

<!DOCTYPE html>
<html>

  <?php 
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']); 
    $query2 = "SELECT * FROM users_msg"; 
    $res_2 = mysqli_query($conn,$query2); 
  ?>

  <head>
    <script src="send_msg.js" defer="true"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messages</title>
    <link rel="stylesheet" type="text/css" href="msgstyle.css">
  </head>
  <body>
    <header>
      <div id="logo">Pokemedia
        <form class="nosubmit">
          <input class="nosubmit" type="search" placeholder="Search..."> 
        </form>
      </div>
      <nav>
        <ul>
          <li><a href="home2.php">Home</a></li>
          <li><a href="messages.php">Messages</a></li>
          <div class="dropdown">
            <li><a>Settings</a></li>
            <div class="dropdown-options">
              <a href="fav.php">Favourite</a>
              <a href="login.php">Logout</a>
            </div>
          </div>
        </ul>
      </nav>
    </header>

    <div id="container">
      <div class="chat-container">
        <?php
          if(mysqli_num_rows($res_2)>0){
              while($commenti = mysqli_fetch_assoc($res_2)){
              echo "<div>";
                echo "<p> User: " .$Username = $commenti["Username"]."</p>";
                echo "<p>" .$msg = $commenti["msg"]. "----" .$time_msg = $commenti["time_msg"]."</p>";
              echo "</div>";
            }
          }
        ?>
      </div>
    
      <div class="form-container">
        <form action="javascript:void(0);" autocomplete="off" >
          <label for="message">Message:</label>
          <input type="text" id="message" name="message">
          <button type="submit">Send</button>
        </form>
      </div>
    </div>

    <footer>
      <ul>
        <li><a href="https://giphy.com/gifs/foxhomeent-3oz8xZvvOZRmKay4xy/fullscreen">About</a></li>
        <li><a href="https://giphy.com/gifs/eePSFNBFv2W9owZ4Sh/fullscreen">Contact</a></li>
        <li><a href="https://giphy.com/gifs/confused-really-tom-hanks-h6FObJ8zJjBte/fullscreen">Privacy Policy</a></li>
      </ul>
    </footer>
  </body>
</html>
