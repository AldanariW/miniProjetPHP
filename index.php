<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Accueil appli</title>
	<link rel="stylesheet" type="text/css" href="style/index.css">
</head>
<body>
	<div id="ajout">
		<a href="saisieclient.php">Saisie nouveau client </a><br>
		<a href="saisiemedecin.php"> Saisie nouveau médecin </a><br>
		<a href="saisierdv.php"> Saisie nouveau RDV </a>
	</div>

	<div id="liste_rdv" >

		<?php
			function creerRDV($dateRDV, $heureDebutRDV, $heureFinRDV, $prenomClient, $nomClient, $prenomMedecin, $nomMedecin){
				echo(
				'<div class="rdv_item">
					<p><span class="date_rdv">'.$dateRDV.'</span>
					<span class="heure_rdv">'.$heureDebutRDV.' - '.$heureFinRDV.'</span>
					<br>Client : '.$prenomClient.' '.strtoupper($nomClient).
					'<br>Medecin : '.$prenomMedecin.' '.$nomMedecin.'</p>
				</div>');
			}

			try {
				$linkpdo = new PDO("mysql:host=localhost;dbname=miniprojetphp", 'root', '');
				$linkpdo->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$req = $linkpdo->prepare(
					"SELECT CAST(rdv.DateHeure AS DATE) as dateRDV, 
						CAST(rdv.DateHeure AS TIME) as heureDebut,
						CAST(CAST(rdv.DateHeure AS TIME) + rdv.Duree AS TIME) ,
						c.Prenom, c.Nom, m.Prenom, m.Nom
					FROM consultation rdv, client c, medecin m
					WHERE rdv.IdClient = c.IdClient AND rdv.IdMedecin = m.IdMedecin;
					AND CAST(rdv.DateHeure AS DATE) > date();");

				if ($req->execute()) {
					while ($resultat = $req->fetch(PDO::FETCH_BOTH)) {
						creerRDV($resultat[0],
							$resultat[1],
							$resultat[2],
							$resultat[3],
							$resultat[4],
							$resultat[5],
							$resultat[6]);
					}
				}
			} catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());
			}
			
		?>
	</div>

	
</body>
</html>