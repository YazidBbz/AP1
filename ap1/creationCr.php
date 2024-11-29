<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '_conf.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('location: index.php');
    exit;
}

$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

$nameEleve = $_SESSION['login'];
$query = "SELECT id FROM user WHERE login = '$nameEleve'";
$result = mysqli_query($connexion, $query);
$id = $result ? mysqli_fetch_assoc($result)['id'] : null;
$message = '';


if (isset($_POST['send_newCR'])) {
    $newSujet = mysqli_real_escape_string($connexion, $_POST['sujet']);
    $newContenu = mysqli_real_escape_string($connexion, $_POST['contenu']);

    $requete = "INSERT INTO  cr(sujet, contenu, dateCR, id_user)  VALUES('$newSujet', '$newContenu', NOW(), $id)";
   // mysqli_query($connexion, $requete);
    if (mysqli_query($connexion, $requete)) {
        $message = "Compte-rendu enregistré avec succès!";
    } else {
        $message = "Erreur lors de l'enregistrement : " . mysqli_error($connexion);
    }
}

mysqli_close($connexion);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Compte Rendu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        button {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            color: #fff;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            color: green;
        }
    </style>
</head>
<body>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Compte-Rendu</title>
    <link rel="stylesheet" href="create_cr.css">
</head>
<body>
    <div id="formulaire">
        <h1>Créer votre compte-rendu</h1>
        <!-- On affiche le message de confirmation si le CR a été créé -->
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="sujet" placeholder="Sujet" required>
            <textarea name="contenu" placeholder="Contenu de votre Compte-rendu" rows="5" required></textarea>
            <input type="date" name="date">
            <input type="submit" name="send_newCR" value="Enregistrer">
        </form>
    </div>
</body>
</html>

    <form method="post" action="index.php">
    <button type="submit">Se déconnecter</button>
</form>
</body>
</html>