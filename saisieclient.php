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
