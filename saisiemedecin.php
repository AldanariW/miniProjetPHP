<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Saise nouveau client</title>
	<style>
	</style>
</head>
<body>
	<button><a href="index.php" style="text-decoration: none;">Retour</a></button>
	<h1>Saisie nouveau médecin</h1>
	<form action="saisiemedecin.php" method="post" style="text-align: right; width: 20%;">

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