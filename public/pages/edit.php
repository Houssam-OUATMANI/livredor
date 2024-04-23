<?php
require "../../partials/header.php";
// *** Middleware Authentifaction
if(!isset($_SESSION["admin"])) {
    header("Location:/pages/dashboard.php");
}

$id = intval($_GET["id"]);

$password = parse_ini_file("../../.env")["PASSWORD"];
$pdo = new PDO("mysql:host=localhost;dbname=livredor", "root", $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM temoignages WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();


if(!empty($_POST)) {
    $nom = $_POST["nom"];
    $message = $_POST["message"];
    $stmt =$pdo->prepare("UPDATE temoignages SET nom = ?, message = ? WHERE id = ?");
    $stmt->execute([$nom, $message, $id]);
    header("Location:/pages/dashboard.php");
}
?>

<div class="container">

    <h1>Editer le temoignage</h1>
    <form action="?id=<?= $data["id"]?>" method="POST">
            <input type="text" placeholder="Votre nom" name="nom" value="<?= $data["nom"]?>">
            <textarea name="message" placeholder="Votre message"><?= $data["message"]?></textarea>
            <button type="submit">Modifier</button>
    </form>
</div>
