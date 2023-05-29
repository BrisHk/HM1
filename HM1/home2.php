<?php 
  require_once('control.php');
?>

<?php
  $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
  if(isset($_POST['src'])){
    $src = mysqli_real_escape_string($conn, $_POST['src']);
    $Username = mysqli_real_escape_string($conn, $_SESSION['Username']);
    $query = "INSERT INTO users_fav (src, Username) VALUES ('$src', '$Username')";
    $res = mysqli_query($conn, $query);
  }
?>


<?php
if(isset($_GET['post'])){

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $Username = mysqli_real_escape_string($conn, $_SESSION['Username']);
    $post = mysqli_real_escape_string($conn, $_GET['post']);
    $query = "INSERT INTO users_post (Username, post, post_time) VALUES (\"$Username\",\"$post\",CURRENT_TIMESTAMP())";
    $res = mysqli_query($conn,$query);
    if($res) echo json_encode("Post created successfully");
    mysqli_close($conn);
    exit;
    }
?>

<?php
  if(isset($_GET['stampa'])){

    $array_row = array();
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $query = "SELECT *FROM users_post";
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
    $query2 = "SELECT * FROM users_post"; 
    $res_2 = mysqli_query($conn,$query2); 
  ?>

  <head>
    <script src="api_app.js" defer="true"></script>
    <script src="post_home.js" defer="true"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    <link rel="stylesheet" href="home2.css">
  </head>

  <body>

    <header>
      <div id="logo">Pokemedia
        <form class="nosubmit">
          <input id="search" type="search" placeholder="Search...">
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
    
    <div class="publish">
      <div class="user-info">
        <h2>Post something</h2>
        <input type="text" class="postusr" placeholder="Write something to publish..">
        <button type="submit">Publish</button>
      </div>
    </div>

    <article id="album-view"></article>

    <div id='main'>
      <div class="post_side">
        <div class="user-info">
        </div>
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