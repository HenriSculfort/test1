<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="">
    </head>

    <body>


        <?php

        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=jointure;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }



        // Fonction SQL
        // UPPER(champ) : mise en majuscule du champ
        // AS permet de créer un alias pour le champ (=renomer) c'est un alias que l'on va utiliser dans l'affichage


        $reponse = $bdd->prepare('SELECT UPPER(nom) FROM users');
        $reponse->execute();

        $result = $reponse->fetchAll();
        foreach($result as $user){
            echo $user['UPPER(nom)']. '<br>';
        }


        // AS permet de créer un alias pour le champ (=renomer) c'est un alias que l'on va utiliser dans l'affichage
        // Pour echo permet de remplacer UPPER(nom) par nomMaj 
        // UPPER()  majuscule
        // LOWER()  minuscule
        // LENGTH() renvoie le nombre de caractères contenu dans le champ
        // COUNT()  compte le nombre d'entres dans la base

        echo '<br>';
        $reponse = $bdd->prepare('SELECT UPPER(nom) AS nomMaj FROM users');
        $reponse->execute();

        $result = $reponse->fetchAll();
        foreach($result as $user){
            echo $user['nomMaj']. '<br>';
        }




        // Fonction SQL sur les dates
        // DATE_FORMAT()

        echo '<br>';
        $reponse = $bdd->prepare('SELECT id, DATE_FORMAT(date_publi, "%d/%m/%Y %Hh%imin%ss") AS dateFR FROM articles');
        $reponse->execute();

        $result = $reponse->fetchAll();
        foreach($result as $user){
            echo $user['dateFR']. '<br>';
        }




        // Récupérer l'année... à partir d'un champ date de la table
        // DAY() MONTH() HOUR()

        echo '<br>';
        $reponse = $bdd->prepare('SELECT YEAR(date_publi) AS annee FROM articles');
        $reponse->execute();

        $result = $reponse->fetchAll();
        foreach($result as $user){
            echo $user['annee']. '<br>';
        }


        // Pour plusieurs donnée


        echo '<br>';
        $reponse = $bdd->prepare('SELECT YEAR(date_publi) AS annee , DAY(date_publi) AS jour FROM articles');
        $reponse->execute();

        $result = $reponse->fetchAll();
        foreach($result as $user){
            echo $user['annee']. '  le   ' .$user['jour']. '<br>';
        }



        // ajouter ou soustraire du temps à une date
        // DATE_ADD() et DATE_SUB()
        echo '<br>';
        $reponse = $bdd->prepare('SELECT DATE_ADD(date_publi, INTERVAL 1 YEAR) AS annee FROM articles');
        $reponse->execute();

        $result = $reponse->fetchAll();
        foreach($result as $user){
            echo $user['annee']. '<br>';
        }

        ?>












    </body>
</html>
