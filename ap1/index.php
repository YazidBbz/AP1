<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- on renvoie en post vers perso.php -->
    <form method="POST" action="perso.php">
        <h2>Connexion</h2>
        Votre login : <input type="text" name="login"><br>
        Votre mot de passe : <input type="password" name="mdp"><br>
        <a href="oublie.php" class="special">Mot de passe oublié ?</a> 
        <input type="submit" value="Connexion" name="send_connexion">
        <a href="page3.php" class="special">Pas d'identifiant ? Inscrivez-vous</a>

    </form>


    

    </body>
    </html>

    
    