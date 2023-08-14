<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require_once("connexion.php"); // include the authentication script
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Page de connexion</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>

  <h1>Page de connexion</h1>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" value="Se connecter">
  </form>

  <?php
  if (isset($_SESSION['message'])) {
    echo '<p>' . $_SESSION['message'] . '</p>';
    unset($_SESSION['message']);
  }
  ?>

</body>
</html>
