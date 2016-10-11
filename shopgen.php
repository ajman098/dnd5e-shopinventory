<?php
	require("connect.php");
	
	$gplimit = [
		4000,
		10000,
		20000,
		80000,
		300000,
		1500000,
		4000000,
		10000000
	];
	$rarity = [
		2,
		5,
		7,
		9,
		12
	];
	foreach($db->query("SELECT * FROM categories ORDER BY id") as $row)
	{
		if (isset($_POST[$row['name']]))
		{
			$array[$row['id']] = TRUE;
		}
		else
		{
			$array[$row['id']] = FALSE;
		}
	}
	
	$stmt = $db->prepare('UPDATE shopinfo SET name = :shopname, short = :shopdesc WHERE id = 0');
	$stmt->bindParam(':shopname', $_POST['shopname'], PDO::PARAM_STR);
	$stmt->bindParam(':shopdesc', $_POST['shopdesc'], PDO::PARAM_STR);
	$stmt->execute();
	
	foreach($db->query("SELECT * FROM shop ORDER BY id") as $row)
	{
		
		$price = ceil((rand(6,21)-ceil($_POST['townsize']/rand(1,3)))/10*$row['cost']);
		$sql = "UPDATE shop SET price='".$price."' WHERE id='".$row['id']."'";
		$db->query($sql);
		
		if ($price > $gplimit[$_POST['townsize']] || $price <= 0)
		{
			$stock = 0;
		}
		elseif ($array[$row['cat']])
		{
			//exclude categories!
			$stock = 0;
		}
		else
		{
			$stock = round((rand(1,$_POST['shopsize']) - $rarity[$row['rarity']])*$_POST['townsize']*rand(8,12)*0.1);
		}
		if ($stock < 0) $stock = 0;
		$sql = "UPDATE shop SET stock='".$stock."' WHERE id='".$row['id']."'";
		$db->query($sql);
		
		echo $row['cost'] . " (" . $price . ") ".$stock."<br>";
	}
	
	header("Location: ./index.php");
	exit();
?>