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

			function ajouterHeures($t1, $t2) {
				$m = (intval(substr($t1, -5, 2)) + intval(substr($t2, -5, 2))) % 60;
				$h = (intval(substr($t1, 0, 2)) + intval(substr($t2, 0, 2))) % 60 + intdiv(intval(substr($t1, -5, 2)) + intval(substr($t2, -5, 2)), 60);
				return ($h < 9 ? '0' : '').$h.($m < 9 ? ':0' : ':').$m;
			}

			try {
				$linkpdo = new PDO("mysql:host=localhost;dbname=MiniProjet", 'root', '');
				$linkpdo->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$req = $linkpdo->prepare(
					"SELECT CAST(rdv.DateHeure AS DATE) as dateRDV, 
						CAST(rdv.DateHeure AS TIME) as heureDebut,
						CAST(rdv.Duree AS TIME) as duree,
						c.Prenom,
						c.Nom,
						m.Prenom, 
						m.Nom
					FROM consultation rdv, client c, medecin m
					WHERE rdv.IdClient = c.IdClient AND rdv.IdMedecin = m.IdMedecin;
					AND CAST(rdv.DateHeure AS DATE) > NOW();");

				if ($req->execute()) {
					while ($resultat = $req->fetch(PDO::FETCH_BOTH)) {
						ajouterHeures('00:50:00', '00:50:00');
						creerRDV($resultat[0],
							substr($resultat[1],0,5),
							ajouterHeures($resultat[1],$resultat[2]),
							$resultat[3],
							$resultat[4],
							$resultat[5],
							$resultat[6],
						);
					}
				}
			} catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());
			}
			
		?>
	</div>

	
</body>
</html>