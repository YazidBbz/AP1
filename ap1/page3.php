
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    

</head>
<body>
<form method="post" action="">
Votre email : <input type="email" name="email"><br>
Votre mot de passe : <input type="password" name="mdp"><br>
<button type="submit" name="submit" value="send">connexion</button>
 
</form>

<?php
session_start();
if (isset($_POST['submit']))
{
    echo "Email et mdp affiché <hr>";    
    $varmdp = $_POST['mdp']; 
	$varemail = $_POST['email'];
    echo "$varmdp - $varemail";


}