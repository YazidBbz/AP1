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
    <h1>Partie Prof</h1>
    <h1>Accueil</h1>
    <h2>Bonjour <?php echo "$login"; ?></h2>
    <a href="crProf.php">Listes des comptes rendus des élèves</a>
    
</div>
<form method="post" action="index.php">
    <button type="submit">Se déconnecter</button>
</form>

   
</body>