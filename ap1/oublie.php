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
<button type="submit" name="submit" value="send">connexion</button>
 
</form>

<?php
session_start();
if (isset($_POST['submit']))
{
    $mail = $_POST['email'];
    if($mail) {
        $header= 'From: yazidbbz@gmail.com\r\n';
        $header .="Content-Type: text/plain; charset=UTF-8\r\n";
        $retour = mail ($mail,'nouveau mdp','',$header);
        
    if($retour) {

            echo'email envoyé';

        }
        else {
            echo 'email pas envoyé';
        }
    }
}

?>
    



</body>
</html>

