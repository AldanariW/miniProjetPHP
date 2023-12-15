<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Accueil appli</title>
	<style>

		body{
			display:flex;
		}
		table th, table tr td {
			border: 1px black solid;
		}

		td {
			height: 64px;
		}

		table {
			border-collapse: collapse;
			width: 50%;
			float: right;
		}

		#liste_rdv {
			width: 30%;
			border: 1px black solid;
			margin: 0 5px 0 5px;
		}
	</style>
</head>
<body>
	<div id="ajout">
		<a href="saisieclient.php">Saisie nouveau client </a><br>
		<a href="saisiemedecin.php"> Saisie nouveau médecin </a><br>
		<a href="saisierdv.php"> Saisie nouveau RDV </a>
	</div>
	

	<div id="liste_rdv" >
		<div style="border: black 1px solid;">
			<p><span style="background-color: lightblue;">02/13/2023</span>
				<span style="background-color: lightgreen;">15h-16h</span>
			Jean Dupont
			Martin Dupond</p>
		</div>
		
		<div style="border: black 1px solid;">
			<p><span style="background-color: lightblue;">02/13/2023</span>
				<span style="background-color: lightgreen;">15h-16h</span>
			Jean Dupont
			Martin Dupond</p>
		</div>

		<div style="border: black 1px solid;">
			<p><span style="background-color: lightblue;">02/13/2023</span>
				<span style="background-color: lightgreen;">15h-16h</span>
			Jean Dupont
			Martin Dupond</p>
		</div>
	</div>

	<!-- <table>
		<th>L</th>
		<th>M</th>
		<th>M</th>
		<th>J</th>
		<th>V</th>
		<th>S</th>
		<th>D</th>
		
		<tr>
			<td>1</td>
			<td>2</td>
			<td>3</td>
			<td>4</td>
			<td>5</td>
			<td>6</td>
			<td>7</td>
		</tr>

		<tr>
			<td>8</td>
			<td>9</td>
			<td>10</td>
			<td>11</td>
			<td>12</td>
			<td>13</td>
			<td>14</td>
		</tr>

		<tr>
			<td>15</td>
			<td>16</td>
			<td>17</td>
			<td>18</td>
			<td>19</td>
			<td>20</td>
			<td>21</td>
		</tr>

		<tr>
			<td>22</td>
			<td>23</td>
			<td>24</td>
			<td>25</td>
			<td>26</td>
			<td>27</td>
			<td>28</td>
		</tr>

		<tr>
			<td>29</td>
			<td>30</td>
			<td>31</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table> -->

</body>
</html>