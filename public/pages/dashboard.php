<?php
require "../../partials/header.php";
// *** Middleware Authentifaction
if(!isset($_SESSION["admin"])) {
    header("Location:/");
}


$password = parse_ini_file("../../.env")["PASSWORD"];
$pdo = new PDO("mysql:host=localhost;dbname=livredor", "root", $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM temoignages ORDER BY id DESC");
$data = $stmt->fetchAll();
?>

<div class="container">

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($data as $d) :?>
                   <tr>
                        <td><?= $d["nom"] ?></td>
                        <td><?= $d["message"] ?></td>
                        <td>
                            <a href="/pages/edit.php?id=<?=$d['id']?>">Editer</a>
                            <form onsubmit="return confirm('Etes vous sur de vouloir bien supprimé')" action="/pages/delete.php?id=<?=$d["id"]?>" method="POST">
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                   </tr> 
            <?php endforeach ;?>
        </tbody>
    </table>

</div>


