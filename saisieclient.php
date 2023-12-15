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
		$linkpdo = new PDO("mysql:host=localhost;dbname=miniprojetphp", "root", "");
	} catch (Exception $e) {
		throw new Exception("Erreur lors du lien avec la base de données", 1);
	}


	if (isset($_POST['submit'])) {
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
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
		$dateNaissance = $_POST['dateNaissance'];
		$rueNaissance = $_POST['rueNaissance'];
		$villeNaissance = $_POST['villeNaissance'];
		$codePostalNaissance = $_POST['codePostalNaissance'];
		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];
		$codepostal = $_POST['codepostal'];
		$numSecu = $_POST['numsecu'];

	}

	$missing = array();
	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			array_push($missing, $key);
		}
	}
	if (!empty($missing)) {
		throw new Exception("Champs Manquant", 11); // TODO mettre une popup a la place de die
	}

	try {
		$exist = $linkpdo->prepare("SELECT COUNT(*)
					FROM Client
					WHERE Nom = :nom
					AND Prenom = :prenom
					AND Adresse = :adresse
					AND Civilite = :civilite
					AND DateNaissance = :dateNaissance
					AND LieuNaissance = :rueNaissance
					AND CodePostal = :codePostalNaissance
					AND Ville = :villeNaissance
					AND NumSecu = :numSecu;");
	} catch (\Throwable $th) {
		throw new Exception("Erreur d'éxcecution de requète", 2);
	}

	$exist->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
	$exist->bindParam(':prenom', $prenom, PDO::PARAM_STR, 50);
	$exist->bindParam(':adresse', $adresse, PDO::PARAM_STR, 50);
	$exist->bindParam(':civilite', $civilite, PDO::PARAM_STR, 3);
	$exist->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR); // TODO as Date
	$exist->bindParam(':rueNaissance', $rueNaissance);
	$exist->bindParam(':villeNaissance', $villeNaissance);
	$exist->bindParam(':codePostalNaissance', $codePostalNaissance);
	$exist->bindParam(':ville', $ville, PDO::PARAM_STR, 50);
	$exist->bindParam(':codepostal', $codepostal);
	$exist->bindParam(':numSecu', $numSecu);


	try {
		$exist->execute();
	} catch (\Throwable $th) {
		throw $th;
		//throw new Exception("Erreur d'éxcecution de requète", 2);
	}

	if ($exist->fetchColumn() == 0) {
		try {
			$req = $linkpdo->prepare(
				"INSERT INTO contact (Civilite, Nom, Prenom, Adresse, CodePostal, Ville, DateNaissance, LieuNaissance, NumSecu)
				VALUES (:civilite, :nom, :prenom, :adresse, :codepostal, :ville, :dateNaissance, :rueNaissance, :numSecu);");
		} catch (\Throwable $th) {
			throw new Exception("Erreur d'éxcecution de requète", 2);
		}

		$exist->bindParam(':civilite', $civilite);
		$exist->bindParam(':nom', $nom);
		$exist->bindParam(':prenom', $prenom);
		$exist->bindParam(':adresse', $adresse);
		$exist->bindParam(':codepostal', $codepostal);
		$exist->bindParam(':ville', $ville);
		$exist->bindParam(':dateNaissance', $dateNaissance);
		$exist->bindParam(':rueNaissance', $rueNaissance);
		$exist->bindParam(':numSecu', $numSecu);

		try {
			$req->execute();
		} catch (\Throwable $th) {
			throw new Exception("Erreur d'éxcecution de requète", 2);
		}
	} else {
		echo "Contact already exist !"; // TODO mettre une popup a la place de echo
	}



	?>


	<header>
		<button id="retour">
			<img src="images/retour.png">
			<a href="index.php">Retour</a>
		</button>
		<h1>Saisie nouveau client</h1>
		<div>easter egg :p</div> <!-- En fait la div sert à centre le titre et aligner le bouton a gauche 
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
				<input type="text" name="numsecu" placeholder="15 chiffres" maxlength="15" size="15" required>
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
				<input type="date" name="dateNaissance" id="datenaissance" required>
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

		<input type="submit" value="Enregistrer" id ="enregistrer">

	</form>




</body>

</html>