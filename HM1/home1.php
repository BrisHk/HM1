<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    <link rel="stylesheet" href="home1.css">
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
          <li><a href="home1.php">Home</a></li>
          <li><a href="home1.php">Messages</a></li>
          <div class="dropdown">
            <li><a>Settings</a></li>
            <div class="dropdown-options">
              <a href="login.php">Login</a>
            </div>
          </div>
        </ul>
      </nav>
    </header>

    <main>
      <div class="post_side">
        <div class="user-info">
          <h2>Post something</h2>
          <input type="text" class="postusr" placeholder="Write something to publish..">
          <button type="submit">Publish</button>
        </div>
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