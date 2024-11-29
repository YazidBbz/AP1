<?php
session_start();
if(!isset($_SESSION['login'])){
    // Je renvoie la personne au login si elle n'est pas connectée
    header('location: index.php');
    exit;
}
require_once '_conf.php';

// Connexion à la base de données
$bdd = new mysqli($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

// Vérification de la connexion
if ($bdd->connect_error) {
    die("Échec de la connexion à la base de données : " . $bdd->connect_error);
}

$login= $_SESSION['login'];
// Je sélectionne toutes les colonnes de la table cr et je join la table user par rapport à cr.id_user = user.id où user.login = à la variable login
$requete = "SELECT * FROM cr INNER JOIN user on cr.id_user = user.id where user.login = '$login'";
$resultat = mysqli_query($bdd, $requete);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Comptes Rendus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            max-width: 1200px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
        }

        td {
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e8f6ff;
        }

        .status-oui {
            color: green;
            font-weight: bold;
        }

        .status-non {
            color: red;
            font-weight: bold;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Liste des Comptes Rendus</h1>
    <table>
        <thead>
            <tr>
                <th>Sujet</th>
                <th>Contenu</th>
                <th>Date CR</th>
                <th>Vu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($resultat) > 0) {
                while ($cr = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>" . ($cr['sujet']) . "</td>";
                    echo "<td>" . ($cr['contenu']) . "</td>";
                    echo "<td>" . ($cr['dateCR']) . "</td>";
                   // echo "<td>" . ($cr['date_modif']) . "</td>";
                    echo "<td class='" . ($cr['vu'] ? "status-oui" : "status-non") . "'>" . ($cr['vu'] ? "Oui" : "Non") . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucun compte rendu trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <form method="post" action="index.php">
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>
