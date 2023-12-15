<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/saisie.css">
	<link rel="stylesheet" type="text/css" href="style/saisiemedecin.css">
	<title>Saise nouveau client</title>
</head>
<body>
	<header>
		<button id="retour" href="index.php">
			<a href="index.php">
				<img src="images/retour.png">
				Retour
			</a>
		</button>
		<h1>Saisie nouveau médecin</h1>
	</header>

	<form action="saisiemedecin.php" method="post">
		<fieldset id="infos_medecin">
			<legend>Informations Médecin</legend>

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
	</form>
</body>
</html>