<?php
	$db = new PDO('mysql:host=mysql.gorker.org;dbname=gorkergit;charset=utf8', 'gitread', 'Hawj98300Kk');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>