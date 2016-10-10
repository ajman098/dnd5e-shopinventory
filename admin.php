<!DOCTYPE html>
<?php require("connect.php"); ?>	
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Shop Generator</title>
		<style>
			body {
				font-family: arial, sans-serif;
			}
			
			table {
				border-collapse: collapse;
				width: 100%;
			}

			td, th {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 8px;
			}
			
			input, select {
				font-size: 100%;
				border: 1px solid #dddddd;
				padding: 6px 6px;
			}
			
			.button {
				border : solid 0px #ffffff;
				border-radius : 3px;
				moz-border-radius : 3px;
				font-size : 30px;
				color : #ffffff;
				padding : 12px 19px;
				background-color : #1620de;
				margin-top:5px;
			}

			tr:nth-child(even) {
				background-color: #dddddd;
			}
			
			a {
				color:black;
				text-decoration:none;
			}
		</style>
		<script src="jquery-3.1.0.slim.min.js" type="text/javascript"></script>
	</head>
	<body>	
		<h1 style="font-size:400%;text-align:center;padding-top:50px"><a href="./index.php">Shop Generator</a></h1>
		<div style="width:900px;margin:0 auto;padding:50px 0px 200px;">
		<form action='shopgen.php' method="post">
		<div>
			<h2>Shop Name</h2>
			<input type='text' name='shopname' value="Gorker's Item Emporium" size='30'><br>		
			<h2>Shop Description</h2>
			<input type='text' name='shopdesc' value="Feel free to peruse our inventory. If you have any questions, please direct them to the master. If you would like to sell any items, you are welcome to do so at the counter." size='30'><br>		
			<h2>Town Size</h2>
			<select name="townsize">
				<option value="4000">Thorp</option>
				<option value="10000">Hamlet</option>
				<option value="20000">Village</option>
				<option value="80000">Small Town</option>
				<option value="300000">Large Town</option>
				<option value="1500000">Small City</option>
				<option value="4000000">Large City</option>
				<option value="10000000">Metropolis</option>
			</select>
			<h2>Shop Size</h2>
			<select name="shopsize">
				<option value="4">Tiny</option>
				<option value="6">Small</option>
				<option value="8">Medium</option>
				<option value="10">Large</option>
			</select>
			<h2>Forbidden Categories</h2>
			<table><tr>
	<?php
		$i=0;
		foreach($db->query("SELECT * FROM categories ORDER BY id") as $cat)
		{
			if ($i == 4)
			{
				echo "</tr><tr>";
				$i=0;
			}
			echo "<td><input type='checkbox' name='".$cat['name']."' id='".$cat['name']."' value='1'> <label for='".$cat['name']."'>".$cat['brief']."</label></td>";
			$i++;
		}
	?>	  
			</tr></table>
			
		</div>
		<br>
		<input class=button type="submit" value="Generate"></form>
		</div>
	</body>
</html>