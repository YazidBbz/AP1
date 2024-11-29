<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '_conf.php';

// Connexion à la base de données
$bdd = new mysqli($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

// Vérification de la connexion
if ($bdd->connect_error) {
    die("Échec de la connexion à la base de données : " . $bdd->connect_error);
}
if(isset($_POST['send_connexion'])){


$mdp = $_POST['mdp'];
$login = $_POST['login'];
echo "login : $login";
// Sélectionne tous les utilisateurs avec leur mot de passe en clair
$requete = ("SELECT * FROM user WHERE `login` = '$login' AND mdp = '$mdp'");
$resultat = mysqli_query($bdd, $requete);


if (mysqli_num_rows($resultat)==0 ) {
    echo "MDP OR LOGIN ERROR";
    } else {

        $user = mysqli_fetch_assoc($resultat);
        $id_statut = $user['id_statut'];
        echo "tu es co mgl ton id : $id_statut";
        $_SESSION['login']= $login;
        if($id_statut == 1){
            echo "vous êtes le professeur";
            header('location: accueilProf.php');
            
        }else if ($id_statut == 2){
            echo "vous êtes un élève";
            header('location: accueilEleve.php');
        } else {
            echo "Vous n'avez aucun statut";
        }
        exit;
    }
}
?>

