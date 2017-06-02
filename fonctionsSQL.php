<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	//1ere chose, on établi la connexion
	//bien mettre le nom de la base de données apres dbname=
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=jointure;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	//fonctions SQL
	//UPPER(champ) : mise en majuscule du champ
	// AS permet de créer un alias pour le champ (= renommer) c'est cet alias que l'on va utiliser lors de l'affichage
	$reponse = $bdd->prepare('SELECT UPPER(nom) AS nomMaj FROM users');
	$reponse->execute();
	$result = $reponse->fetchAll();
	foreach($result as $user){
		echo $user['nomMaj'] .'<br>';		
	}

	//LOWER() met le champ en minuscule

	//LENGTH() renvoie le nombre de caractères contenus dans le champ
	$reponse = $bdd->prepare('SELECT LENGTH(nom) AS nombre FROM users');
	$reponse->execute();
	$result = $reponse->fetchAll();
	foreach($result as $user){
		echo $user['nombre'] .'<br>';		
	}

	//COUNT() compte le nombre d'entrées dans la base
	$reponse = $bdd->prepare('SELECT COUNT(id) AS nbArticles FROM articles');
	$reponse->execute();
	$result = $reponse->fetch();
	
	echo 'Il y a ' . $result['nbArticles'] .'articles dans la table<br>';

	//TRIM() supprime les caractères invisibles (espaces, tabulations, retour à la ligne) en début et en fin de chaîne
	$reponse = $bdd->prepare('SELECT TRIM(content) AS contenu FROM articles');
	$reponse->execute();
	$result = $reponse->fetchAll();
	foreach($result as $article){
		echo $article['contenu'] .'<hr>';		
	}

	/*MAX(champ) renvoie l'entrée qui a la plus grande valeur
	pour un nombre et par ordre alpahbétique inverse pour un texte*/
	$reponse = $bdd->prepare('SELECT MAX(title) AS idMax FROM articles');
	$reponse->execute();
	$result = $reponse->fetch();
	
	echo $result['idMax'] .'<hr>';	
	//résultat inverse  avec MIN()


	//SUM(champ) renvoie la somme du champ
	$reponse = $bdd->prepare('SELECT SUM(tel) AS somme FROM users');
	$reponse->execute();
	$result = $reponse->fetch();
	
	echo $result['somme'] .'<hr>';
	
	

	//FONCTIONS SQL sur les DATES
	//DATE_FORMAT()
	$reponse = $bdd->prepare('SELECT id, DATE_FORMAT(date_publi, "%d/%m/%Y %Hh%imin%ss") AS dateFR FROM articles');
	$reponse->execute();
	$result = $reponse->fetchAll();
	foreach($result as $user){
		echo $user['dateFR'] .'<br>';		
	}


	//Récupérer l'année, le jour.... à partir d'un champ date de la table
	//DAY() MONTH() YEAR() HOUR() MINUTE() SECOND()
	$reponse = $bdd->prepare('SELECT  YEAR(date_publi) AS annee FROM articles');
	$reponse->execute();
	$result = $reponse->fetchAll();
	foreach($result as $user){
		echo $user['annee'] .'<br>';		
	}
	//on peut cumuler
	$reponse = $bdd->prepare('SELECT  YEAR(date_publi) AS annee , MONTH(date_publi) AS mois, HOUR(date_publi) as heure FROM articles');
	$reponse->execute();
	$result = $reponse->fetchAll();
	foreach($result as $user){
		echo $user['annee'] .'<br>';
		echo $user['mois'] .'<br>';
		echo $user['heure'] .'<hr>';		
	}

	//Ajouter ou Soustraire du temps à une date
	//DATE_ADD() et DATE_SUB()
	$reponse = $bdd->prepare('SELECT  DATE_SUB(date_publi, INTERVAL 3 HOUR) AS annee FROM articles');
	$reponse->execute();
	$result = $reponse->fetchAll();
	foreach($result as $user){
		echo $user['annee'] .'<br>';		
	}



	?>
</body>
</html>