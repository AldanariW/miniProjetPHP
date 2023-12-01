<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/saisieclient.css">
	<title>Saise nouveau client</title>
	<style>
	</style>
</head>
<body>
	<header>
		<button><a href="index.php">Retour</a></button>
		<h1>Saisie nouveau client</h1>
		<div>bjour</div>
	</header>
	<form action="saisieclient.php" method="post">
		<fieldset id="infos_client">
			<legend>Informations client</legend>

			<label>Prénom :
				<input type="text" name="prenom" placeholder="Martin">
			</label>
			<br>

			<label>Nom :
				<input type="text" name="nom" placeholder="Dupont">
			</label>
			<br>

			<fieldset id="civilite">
				<legend>Civilite</legend>

				<label>M.
					<input type="radio" name="civilite">
				</label>

				<label>Mme
					<input type="radio" name="civilite">
				</label>

				<label>Autre
					<input type="radio" name="civilite">
				</label>
			</fieldset>
		</fieldset>

		<fieldset id="infos_naissance">
			<legend>Informations Naissance Client</legend>

			<label>Date de naissance :
				<input type="date" name="dateNaissance">
			</label>
			<br>

			<fieldset class="lieu_naissance">
				<legend>Lieu de naissance</legend>

				<label>Adresse
					<input type="texte" name="rueNaissance" placeholder="Hôpital X OU Adresse naissance">
				</label>
				<br>

				<label>Ville
					<input type="texte" name="villeNaissance" placeholder="Paris">
				</label>
				<br>

				<label>Code postal
					<input type="texte" name="codePostalNaissance" placeholder="75100">
				</label>
			</fieldset>
		</fieldset>

		<fieldset id="adresse_client">
			<legend>Adresse Client</legend>
			<label>Adresse
					<input type="texte" name="adresse" placeholder="5 rue Jean Moulin">
				</label>
				<br>

				<label>Ville
					<input type="texte" name="ville" placeholder="Paris">
				</label>
				<br>

				<label>Code postal
					<input type="texte" name="codepostal" placeholder="75100">
				</label>

		</fieldset>

	</form>
</body>
</html>