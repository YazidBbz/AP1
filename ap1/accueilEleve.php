
<?php
  
session_start();
if(!isset($_SESSION['login'])){
    // Je renvoie la personne au login si elle n'est pas connectée
    header('location: index.php');
    exit;
}
$login= $_SESSION['login'];

?>
<link rel="stylesheet" href="style.css">
<body class="accueil">
    
<div>
    <h1>Partie élève</h1>
    <h1>Accueil</h1>
    <h2>Bonjour <?php echo "$login"; ?></h2>
    <a href="listeCr.php">Listes des comptes rendus</a>
    <a href="creationCr.php">Créer un compte rendu</a>
</div>
<form method="post" action="index.php">
    <button type="submit">Se déconnecter</button>
</form>

   
</body>


