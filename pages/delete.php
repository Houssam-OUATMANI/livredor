<?php
require "../partials/header.php";
// *** Middleware Authentifaction
if(!isset($_SESSION["admin"])) {
    header("Location:/pages/dashboard.php");
}


$id = intval($_GET["id"]);

$password = parse_ini_file("../.env")["PASSWORD"];
$pdo = new PDO("mysql:host=localhost;dbname=livredor", "root", $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("DELETE FROM temoignages WHERE id = ?");
$stmt->execute([$id]);

header("Location:/pages/dashboard.php");
