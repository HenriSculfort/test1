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


        // On affiche tout les articles et leurs auteurs
        // jointure interne avec WHERE

        $reponse = $bdd->prepare('SELECT articles.id,nom,title,date_publi FROM articles, users WHERE articles.idUsers = users.id');
        $reponse->execute();


        //         $result = $reponse->fetchALL();
        // OU
        //         while($donnees = $reponse->fetch()){


        //            var_dump($result);


        while($donnees = $reponse->fetch()){

        ?> 
        <article>
            <h2><?php echo $donnees['title'] ?></h2>
            publié par <?php echo $donnees['nom'] ?>
        </article>
        <?php

        }

        // on a fini de traiter la reponse
        $reponse->closeCursor();


        // Jointure interne avec INNER JOIN
        // La jointure interne ne va pas afficher que les résultats qui ont une correspondance entre les deux tables
        // on affiche tous les articles et leurs auteurs



        $reponse = $bdd->prepare('SELECT articles.id,nom,title,date_publi FROM articles INNER JOIN users ON articles.idUsers = users.id');
        $reponse->execute();

        //        $result = $reponse->fetchAll();
        //        var_dump($result);
        while($donnees = $reponse->fetch()){
        ?> 
        <article>
            <h2><?php echo $donnees['title'] ?></h2>
            publié par <?php echo $donnees['nom'] ?>
        </article>
        <?php
        }
        ?>


        <?php

        // jointure externe avec LEFT JOIN
        // on affiche tout les articles et leurs auteurs
        // récupere toutes les entrées de la table à gauche de JOIN

        $reponse = $bdd->prepare('SELECT articles.id, nom, title, date_publi FROM articles LEFT JOIN users ON articles.idUsers = users.id');
        $reponse->execute();

        // jointure externe avec RIGHT JOIN
        // on affiche tout les articles et leurs auteurs
        // récupere toutes les entrées de la table à droite de JOIN

        $reponse = $bdd->prepare('SELECT articles.id, nom, title, date_publi FROM articles RIGHT JOIN users ON articles.idUsers = users.id');
        $reponse->execute();
        
        // Va afficher que Mattieu a fait un article !! alors qui n'est pas dans la table articles
        while($donnees = $reponse->fetch()){
        ?> 
        <article>
            <h2><?php echo $donnees['title'] ?></h2>
            publié par <?php echo $donnees['nom'] ?>
        </article>
        <?php
        }
        ?>
        
        

     




































    </body>
</html>
