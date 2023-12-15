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
	} catch (\Throwable $th) {
		throw $th;
	}


	if (isset($_POST['submit'])) {
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$civilite = isset($_POST['civilite']) ? $_POST['civilite'] : '';
		$dateNaissance = $_POST['dateNaissance'];
		$rueNaissance = $_POST['rueNaissance'];
		$villeNaissance = $_POST['villeNaissance'];
		$codePostalNaissance = $_POST['codePostalNaissance'];
		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];
		$codepostal = $_POST['codepostal'];
		$numSecu = $_POST[''];

	}

	$missing = array();
	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			array_push($missing, $key);
		}
	}
	if (!empty($missing)) {
		die("All the field must be filled ! missing : " . implode(", ", $missing)); // TODO mettre une popup a la place de die
	}

	try {
		$exist = $linkpdo->prepare("SELECT count(*)
                    FROM contact
                    WHERE nom = :nom 
					AND prenom = :prenom 
					AND adresse = :adresse 
					AND codePostale = :codePostale 
					AND ville = :ville 
					AND telephone = :telephone");
	} catch (\Throwable $th) {
		throw $th;
	}

	$exist->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
	$exist->bindParam(':prenom', $prenom, PDO::PARAM_STR, 50);
	$exist->bindParam(':adresse', $adresse, PDO::PARAM_STR, 100);
	$exist->bindParam(':codePostale', $codePostale, PDO::PARAM_STR, 5);
	$exist->bindParam(':ville', $ville, PDO::PARAM_STR, 50);
	$exist->bindParam(':telephone', $telephone, PDO::PARAM_STR, 10);

	try {
		$exist->execute();
	} catch (\Throwable $th) {
		throw $th;
	}

	if ($exist->fetchColumn() == 0) {
		try {
			$req = $linkpdo->prepare("INSERT INTO contact (nom, prenom, adresse, codePostale, ville, telephone)
                        VALUES (:nom, :prenom, :adresse, :codePostale, :ville, :telephone)");
		} catch (\Throwable $th) {
			throw $th;
		}

		$req->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
		$req->bindParam(':prenom', $prenom, PDO::PARAM_STR, 50);
		$req->bindParam(':adresse', $adresse, PDO::PARAM_STR, 100);
		$req->bindParam(':codePostale', $codePostale, PDO::PARAM_STR, 5);
		$req->bindParam(':ville', $ville, PDO::PARAM_STR, 50);
		$req->bindParam(':telephone', $telephone, PDO::PARAM_STR, 10);


		try {
			$req->execute();
		} catch (\Throwable $th) {
			throw $th;
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
					<input type="radio" name="mCivilite" required>
				</label>

				<label>Mme
					<input type="radio" name="mmeCivilite" required>
				</label>

				<label>Autre
					<input type="radio" name="aCivilite" required>
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
					<input type="texte" name="rueNaissance" placeholder="Hôpital X OU Adresse naissance" required>
				</label>
				<br>

				<label>Ville
					<input type="texte" name="villeNaissance" placeholder="Paris" required>
				</label>
				<br>

				<label>Code postal
					<input type="texte" name="codePostalNaissance" placeholder="75100" required>
				</label>
			</fieldset>
		</fieldset>

		<fieldset id="adresse_client">
			<legend>Adresse Client</legend>
			<label>Adresse
				<input type="texte" name="adresse" placeholder="5 rue Jean Moulin" required>
			</label>
			<br>

			<label>Ville
				<input type="texte" name="ville" placeholder="Paris" required>
			</label>
			<br>

			<label>Code postal
				<input type="texte" name="codepostal" placeholder="75100" required>
			</label>

		</fieldset>

		<input type="submit" value="Enregistrer">

	</form>




</body>

</html>
