<?php
require "../partials/header.php";

// *** Middleware Authentifaction
if(isset($_SESSION["is_connected"]) && $_SESSION["is_connected" ] === true) {
    header("Location:/");
}

if(!empty($_POST)) {
    $password = parse_ini_file("../.env")["PASSWORD"];
    $pdo = new PDO("mysql:host=localhost;dbname=livredor", "root", $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Logique
   $stmt =  $pdo->prepare("SELECT * FROM admins WHERE email = ?");
   $stmt->execute([$email]);
   $admin = $stmt->fetch();

   // verifier si l'email existe
   if(!$admin) {
    $_SESSION["error"] = "Auccun compte associe a cet email";
    header("Location: /pages/connexion-admin.php");
    return;
   }
   // verifier le mot de passe
   if($password !== $admin["password"]) {
    $_SESSION["error"] = "Mot de passe invalide";
    header("Location: /pages/connexion-admin.php");
    return;
   }
   
   // Tout est bon;
   $_SESSION["admin"] = $admin;
   $_SESSION["success"] = "Vous etes connecté";
   $_SESSION["is_connected"] = true;
   header("Location: /");

}

?>

<div class="container">

    <?php if(isset($_SESSION["error"])) :?>
        <div style="background-color: tomato; padding : 2rem 1rem;"> <?= $_SESSION["error"] ?> </div>
    <?php endif; ?>

    <?php if(isset($_SESSION["success"])) :?>
        <div style="background-color: chartreuse; padding : 2rem 1rem;"> <?= $_SESSION["success"] ?> </div>
    <?php endif; ?>

    <h1>Connexion administrateur</h1>

    <form action="" method="post">

        <input type="email" placeholder="Votre email" name="email">
        <input type="password" placeholder="Votre Mot de passe" name="password">
        <button type="submit">Connexion</button>

    </form>
</div>

<?php
unset($_SESSION["error"]);
require "../partials/footer.php";
?>