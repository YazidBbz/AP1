<?php 
session_start();
include "_conf.php";

if (isset($_POST['send_connexion'])) {
    echo "send connexion envoyé <hr>";

    $varlogin = $_POST['login'];
    $varmdp = $_POST['mdp'];

    echo "login : " . $_POST['login'] . "<br> mdp : $varmdp";

    // Connexion à MySQL
    if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
        echo '';

        // Requête avec mot de passe haché (assurez-vous que les mots de passe sont hachés dans la BDD)
        $requete = "SELECT * FROM user WHERE login='$varlogin'";
        echo "<hr>$requete<hr>";

        $resultat = mysqli_query($connexion, $requete);
        $trouve = false;

        if ($donnees = mysqli_fetch_assoc($resultat)) {
            // Vérifie le mot de passe haché
            
                $trouve = true;
                $_SESSION['Sid'] = $donnees['id'];
                $_SESSION['Slogin'] = $donnees['login'];
                $_SESSION['Stype'] = $donnees['id_statut'];
                echo "<hr>Connexion utilisateur réussie <br> Voici votre login : " . $_SESSION['Slogin'];
        }

        if (!$trouve) {
            echo "<hr>Connexion utilisateur échouée. Login ou mot de passe incorrect.";
        }

        // Ferme la connexion
        mysqli_close($connexion);
    } else {
        echo 'Erreur de connexion à la base de données.';
    }
}

else if (isset($_POST['send_inscription'])) {
    echo "send inscription envoyé <hr>";

    $varlogin = $_POST['login'];
    $varmdp = $_POST['mdp'];
    $varemail = $_POST['email'];

    echo "$varlogin - $varmdp - $varemail";

    // Connexion à MySQL
    if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
        echo 'Félicitations, vous êtes connecté à la BDD';

        // Hacher le mot de passe avant de l'insérer
        $hashedPassword = password_hash($varmdp, PASSWORD_DEFAULT);

        // Requête pour insérer un nouvel utilisateur
        $requete = "INSERT INTO user (login, mdp, email, id_statut) VALUES ('$varlogin', '$hashedPassword', '$varemail', 2)"; // 2 pour élève, par exemple

        if (!mysqli_query($connexion, $requete)) {
            echo "<br>Erreur lors de l'inscription : " . mysqli_error($connexion) . "<br>";
        } else {
            echo "<b>Inscription réussie</b>";
        }

        // Ferme la connexion
        mysqli_close($connexion);
    } else {
        echo 'Erreur de connexion à la base de données.';
    }
}
?>
