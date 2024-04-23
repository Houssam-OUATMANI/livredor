<?php
require "../../partials/header.php";

// *** Middleware Authentifaction
if(isset($_SESSION["is_connected"]) && $_SESSION["is_connected" ] === true) {
    header("Location:/");
}

if(!empty($_POST)) {
    $password = parse_ini_file("../../.env")["PASSWORD"];
    $pdo = new PDO("mysql:host=localhost;dbname=livredor", "root", $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if($user) {
        $_SESSION["error"] = "Vous avez déja un compte!!";
        header("Location:/pages/connexion");
        return;
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO USERS (name, email, password) VALUES (?,?,?)");
    $stmt->execute([$name, $email, $hash]);

   // Tout est bon;
   $_SESSION["success"] = "Vous etes inscrit";
   header("Location: /pages/connexion-utilisateur.php");

}

?>

<div class="container">

    <?php if(isset($_SESSION["error"])) :?>
        <div style="background-color: tomato; padding : 2rem 1rem;"> <?= $_SESSION["error"] ?> </div>
    <?php endif; ?>

    <h1>Inscription</h1>

    <form action="" method="post">

        <input type="text" placeholder="Votre Nom" name="name">
        <input type="email" placeholder="Votre email" name="email">
        <input type="password" placeholder="Votre Mot de passe" name="password">
        <button type="submit">Inscription</button>

    </form>
</div>

<?php
unset($_SESSION["error"]);
require "../../partials/footer.php";
?>