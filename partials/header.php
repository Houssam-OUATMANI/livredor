<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
/>
    <title>Document</title>
</head>
<body>
<nav class="container">
  <ul>
    <li><a href="/">LIVRE DOR</a></li>
  </ul>
  <ul>
    <?php if(isset($_SESSION["is_connected"]) &&  $_SESSION["is_connected"] === true) :?>
            <?php if(isset($_SESSION["user"])) :?>
              <h3>Bonjour <?= $_SESSION["user"]["name"] ?></h3>
            <?php endif; ?> 

            <?php if(isset($_SESSION["admin"])) :?>
              <li><a href="/pages/dashboard.php">Dashboard</a></li>
            <?php endif; ?> 
            <form method="POST" action="/pages/deconnexion.php">
                <button style="background-color: tomato;">Deconnexion</button>
            </form>
    <?php else :?>
            <li><a href="/pages/connexion-admin.php">Admin</a></li>
            <li><a href="/pages/connexion-utilisateur.php">Connexion</a></li>
            <li><a href="/pages/inscription.php">Inscription</a></li>
    <?php endif ?>
    
  </ul>
</nav>
    
