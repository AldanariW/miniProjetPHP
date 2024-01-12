<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/saisie.css">
	<link rel="stylesheet" type="text/css" href="style/saisieclient.css">
	<title>Saise nouveau client</title>
	<style>
	</style>
</head>

<body>

	<?php

	try {
		$linkpdo = new PDO("mysql:host=localhost;dbname=miniprojet", "root", "");
	} catch (Exception $e) {
		throw new Exception("Erreur lors du lien avec la base de données", 1);
	}

	$missing = array();
	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			array_push($missing, $key);
		}
	}
	if (!empty($missing)) {
		throw new Exception("Champs Manquant", 11); // TODO mettre une popup a la place de throw
	}

	if (isset($_POST['Enregistrer'])) {
		switch ($_POST['civilite']) {
			case 'M':
				$civilite = 'M';
				break;
			case 'Mme':
				$civilite = 'Mme';
				break;
			case 'Autre':
				$civilite = 'Oth';
				break;
			default:
				break;
		}
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];

		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];
		$codepostal = $_POST['codepostal'];

		$dateNaissance = date('Y-m-d', strtotime($_POST['dateNaissance']));
		$rueNaissance = $_POST['rueNaissance'];
		$villeNaissance = $_POST['villeNaissance'];
		$codePostalNaissance = $_POST['codePostalNaissance'];

		$numSecu = $_POST['numsecu'];

		try {
			$exist = $linkpdo->prepare("SELECT COUNT(*)
					FROM Client
					
					WHERE Civilite = :civilite
					AND Nom = :nom
					AND Prenom = :prenom

					AND Adresse = :adresse
					AND Ville = :ville
					AND CodePostal = :codepostal

					AND DateNaissance = :dateNaissance
					AND RueNaissance = :rueNaissance
					AND VilleNaissance = :villeNaissance
					AND CodePostalNaissance = :codePostalNaissance

					AND NumSecu = :numSecu;");

		} catch (\Throwable $th) {
			throw new Exception("Erreur d'éxcecution de requète", 2);
		}

		$exist->bindParam(':civilite', $civilite, PDO::PARAM_STR, 3);
		$exist->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
		$exist->bindParam(':prenom', $prenom, PDO::PARAM_STR, 50);

		$exist->bindParam(':adresse', $adresse, PDO::PARAM_STR, 50);
		$exist->bindParam(':ville', $ville, PDO::PARAM_STR, 50);
		$exist->bindParam(':codepostal', $codepostal, PDO::PARAM_STR_CHAR, 5);

		$exist->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR); // TODO as Date
		$exist->bindParam(':rueNaissance', $rueNaissance, PDO::PARAM_STR, 50);
		$exist->bindParam(':villeNaissance', $villeNaissance, PDO::PARAM_STR, 50);
		$exist->bindParam(':codePostalNaissance', $codePostalNaissance, PDO::PARAM_STR_CHAR, 5);

		$exist->bindParam(':numSecu', $numSecu, PDO::PARAM_STR_CHAR, 15);

		try {
			$exist->execute();
		} catch (\Throwable $th) {
			throw $th;
			//throw new Exception("Erreur d'éxcecution de requète", 2);
		}

		if ($exist->fetchColumn() == 0) {
			try {
				$req = $linkpdo->prepare(
					"INSERT INTO client (
					Civilite, Nom, Prenom, 
					Adresse, CodePostal, Ville, 
					DateNaissance, 
					RueNaissance, VilleNaissance, CodePostalNaissance, 
					NumSecu
				) VALUES (
					:civilite, :nom, :prenom, 
					:adresse, :codepostal, :ville,
					:dateNaissance,
					:rueNaissance, :villeNaissance, :codePostalNaissance,
					:numSecu
				)"
				);
			} catch (\Throwable $th) {
				throw new Exception("Erreur d'éxcecution de requète", 2);
			}

			$req->bindParam(':civilite', $civilite, PDO::PARAM_STR, 3);
			$req->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$req->bindParam(':prenom', $prenom, PDO::PARAM_STR, 50);

			$req->bindParam(':adresse', $adresse, PDO::PARAM_STR, 50);
			$req->bindParam(':ville', $ville, PDO::PARAM_STR, 50);
			$req->bindParam(':codepostal', $codepostal, PDO::PARAM_STR, 5);

			$req->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
			$req->bindParam(':rueNaissance', $rueNaissance, PDO::PARAM_STR, 50);
			$req->bindParam(':villeNaissance', $villeNaissance, PDO::PARAM_STR, 50);
			$req->bindParam(':codePostalNaissance', $codePostalNaissance, PDO::PARAM_STR, 5);

			$req->bindParam(':numSecu', $numSecu, PDO::PARAM_STR, 15);

			try {
				$req->execute();
			} catch (\Throwable $th) {
				throw $th;
				//throw new Exception("Erreur d'éxcecution de requète", 2);
			}
		} else {
			echo "Contact already exist !"; // TODO mettre une popup a la place de echo
		}
	}
	?>


	<header>
		<button id="retour">
			<img src="images/retour.png">
			<a href="index.php">Retour</a>
		</button>
		<h1>Saisie nouveau client</h1>
		<div>easter egg :p</div> <!-- En fait la div sert à centrer le titre et aligner le bouton a gauche 
			sans mettre en absolute-->
	</header>

	<form action="saisieclient.php" method="post">
		<fieldset id="infos_client">
			<legend>Informations Client</legend>

			<label>Prénom :
				<input type="text" name="prenom" placeholder="Martin" required>
			</label>
			<br>

			<label>Nom :
				<input type="text" name="nom" placeholder="Dupont" required>
			</label>
			<br>

			<label>N° Sécurité sociale :
				<input type="text" name="numsecu" placeholder="15 chiffres" length="15" size="15" required>
			</label>


			<fieldset id="civilite">
				<legend>Civilite</legend>

				<label>M.
					<input type="radio" name="civilite" required>
				</label>

				<label>Mme
					<input type="radio" name="civilite" required>
				</label>

				<label>Autre
					<input type="radio" name="civilite" required>
				</label>
			</fieldset>
		</fieldset>

		<fieldset id="infos_naissance">
			<legend>Informations Naissance Client</legend>

			<label>Date de naissance :
				<input type="date" max="<?= date('Y-m-d'); ?>" required>
			</label>
			<br>

			<fieldset class="lieu_naissance">
				<legend>Lieu de naissance</legend>

				<label>Adresse
					<input type="text" name="rueNaissance" placeholder="Hôpital X OU Adresse naissance" required>
				</label>
				<br>

				<label>Ville
					<input type="text" name="villeNaissance" placeholder="Paris" required>
				</label>
				<br>

				<label>Code postal
					<input type="text" name="codePostalNaissance" placeholder="75100" required>
				</label>
			</fieldset>
		</fieldset>

		<fieldset id="adresse_client">
			<legend>Adresse Client</legend>
			<label>Adresse
				<input type="text" name="adresse" placeholder="5 rue Jean Moulin" required>
			</label>
			<br>

			<label>Ville
				<input type="text" name="ville" placeholder="Paris" required>
			</label>
			<br>

			<label>Code postal
				<input type="text" name="codepostal" placeholder="75100" required>
			</label>

		</fieldset>

		<fieldset id="medecin_referent">
			<legend>Médecin référent</legend>

			<select>
				<option value="">Pas de médecin référent</option>
				<option value="test">Mes couilles</option>
			</select>

		</fieldset>

		<input type="submit" value="Enregistrer" id="enregistrer" name="Enregistrer">

	</form>




</body>

</html>