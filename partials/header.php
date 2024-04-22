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
            <form method="POST" action="/pages/deconnexion.php">
                <button style="background-color: tomato;">Deconnexion</button>
            </form>
    <?php else :?>
            <li><a href="/pages/connexion.php">Connexion</a></li>
    <?php endif ?>
    
  </ul>
</nav>
    
