<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Saise nouvelle consultation</title>
	<style>
	</style>
</head>
<body>
	<button><a href="index.php" style="text-decoration: none;">Retour</a></button>
	<h1>Saisie nouvelle consultation</h1>
	<form action="saisiemedecin.php" method="post">

		<label>Client :
			<select name="client" placeholder="Jean Dupont">
				<option>-- Choisir un client --</option>
		<?php
			function creerUsager($civilite, $nom, $prenom) {
				echo(
					'<option>'.$civilite.'. '.strtoupper($nom).' '.ucfirst($prenom).'</option>'
				);
			}

			try {
				$linkpdo = new PDO("mysql:host=localhost;dbname=miniprojetphp", 'root', '');
				$linkpdo->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$req = $linkpdo->prepare("SELECT civilite, nom, prenom FROM client");


				if ($req->execute()) {
					while ($resultat = $req->fetch(PDO::FETCH_BOTH)) {
						creerUsager($resultat[0],
							$resultat[1],
							$resultat[2]);
					}
				}
		?>
			</select>
		</label><br>

		<label>Médecin :
			<select name="medecin" placeholder="Jeanne Dupond">
				<option>-- Choisir un médecin --</option>
				<?php 
					$req = $linkpdo->prepare("SELECT civilite, nom, prenom FROM medecin");

					if ($req->execute()) {
						while ($resultat = $req->fetch(PDO::FETCH_BOTH)) {
							creerUsager($resultat[0],
								$resultat[1],
								$resultat[2]);
						}
					}
				} catch (Exception $e) {
					die('Erreur : ' . $e->getMessage());
				}?>
			</select>
		</label><br>

		<label>Date :
			<input type="date" name="date" min="<?= date('Y-m-d'); ?>">
		</label><br>

		<label>Heure de début :
			<input type="time" name="heuredebut" value="12:00" step="300">
		</label><br>

		<label>Heure de fin :
			<input type="time" name="heurefin" value="12:30" step="300">
		</label><br>

		<input type="submit" name="valider" value="Valider">
		
	</form>
</body>
</html>