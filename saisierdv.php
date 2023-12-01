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

		<label>Client :
			<select name="client" placeholder="Jean Dupont">
				<option>Bonjour</option>
				<option>Bonjour 2</option>
				<option>Bonjour 3</option>
			</select>
		</label>
		<br>

		<label>Client :
			<select name="client" placeholder="Jean Dupont">
				<option>Bonjour</option>
				<option>Bonjour 2</option>
				<option>Bonjour 3</option>
			</select>
		</label>

		

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