<?php
    require "../partials/header.php";
    $password = parse_ini_file("../.env")["PASSWORD"];
    $pdo = new PDO("mysql:host=localhost;dbname=livredor", "root", $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if(!empty($_POST)) {
        $nom = $_POST["nom"];
        $message = $_POST["message"];
        $stmt =$pdo->prepare("INSERT INTO temoignages (nom, message) VALUES (?, ?)");
        $stmt->execute([$nom, $message]);
        header("Location:/");
    }
   $stmt = $pdo->query("SELECT * FROM temoignages ORDER BY id DESC");
   $data = $stmt->fetchAll();


?>

<main class="container">
    <?php if(isset($_SESSION["success"])) :?>
        <div style="background-color: chartreuse; padding : 2rem 1rem;"> <?= $_SESSION["success"] ?> </div>
    <?php endif; ?>
    <h1>Livre d'or</h1>

    <form action="" method="POST">
        <input type="text" placeholder="Votre nom" name="nom">
        <textarea name="message" placeholder="Votre message"></textarea>
        <button type="submit">Ajouter</button>
    </form>

    <?php if((!empty($data))) :?>
        <?php foreach ($data as $d) :?>
            <article>
                <h2><?= $d["nom"] ?></h2>
                <p><?= $d["message"] ?></p>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
    <div>

    </div>
</main>


<?php
    unset($_SESSION["success"]);
    require "../partials/footer.php"
?>

