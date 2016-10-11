<!DOCTYPE html>
<?php require("connect.php"); ?>
<?php require("colors.php"); ?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>D&D 5e Shop Inventory</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/quickref.css">
	<style>
		#section-info, #section-info .item-icon {
			background-color: black;
			border-color: black;
		}
		#section-info .text {
			color: black;
		}
		
		
		<?php
			$j = 0;
			foreach($db->query("SELECT * FROM categories ORDER BY id ASC") as $row)
			{
				echo '#section-'.$row['name'].', #section-'.$row['name'].' .item-icon {
			background-color: '.$colorarray[$j].';
			border-color: '.$colorarray[$j].';
		}
		#section-'.$row['name'].' .text {
			color: '.$colorarray[$j].';
		}
		
		';
				$j++;
			}
		?>
	</style>
    <link rel="stylesheet" type="text/css" href="css/icons.css">
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora:700' rel='stylesheet' type='text/css'>
    <!-- Javascript -->
    <script type="text/javascript" src="js/jquery/jquery.min.js" charset="utf-8"></script>
</head>
<body class="page-background">
    <div class="page fontsize" data-size="fullscreen">
		<?php
		
			$stmt = $db->prepare("SELECT * FROM shopinfo WHERE id='0' LIMIT 1"); 
			$stmt->execute(); 
			$shopinfo = $stmt->fetch();
			
		?>
		
		<!-- Shopinfo section -->
			<div id="section-info" class="section-container">
				<div class="section-title">
					Welcome to <?php echo $shopinfo['name']; ?>! <span class="float-right"><?php echo $shopinfo['city']; ?></span>
				</div>
				<div class="section-content">
					<div class="section-row section-subtitle text fontsize">
						<?php echo $shopinfo['short']; ?>
					</div>
				</div>
			</div>
		
		<?php
			$catcount = 0;
			foreach($db->query("SELECT * FROM categories ORDER BY id ASC") as $row)
			{
				echo '		<!-- '.$row['brief'].' section -->
			<div id="section-'.$row['name'].'" class="section-container">
				<div class="section-title">
					'.$row['brief'].' <span class="float-right"><!-- Flavor Text --></span>
				</div>
				<div class="section-content">
					<div class="section-row section-subtitle text fontsize">
						'.$row['info'].'
					</div>
					<div class="section-row" id="basic-'.$row['name'].'">
					</div>
				</div>
			</div>
	
	';
				$catcount++;
			}
		?>

    </div>

    <!-- Modal -->
    <div class="modal" id="modal" tabindex="-1">
        <div class="modal-backdrop" id="modal-backdrop"></div>
        <div class="modal-dialog modalsize">
            <div class="section-container modal-container" id="modal-container">
                <div class="section-title" id="modal-title">
                    Modal title<span class="float-right">Action</span>
                </div>
                <div class="section-content">
                    <div class="section-row section-subtitle text" id="modal-subtitle">
                        Subtitle
                    </div>
                    <div class="section-row text">
                        <div id="modal-bullets">
                        </div>
                    </div>
                    <div class="section-row text" id="modal-reference">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data -->
	<?php
	
		function Outofstock()
		{
			global $i, $stack;
			if (!$i)
			{
				$push = [
					"title" => "Out of Stock",
					"icon" => "dead-head",
					"subtitle" => "Oh noes!",
					"description" => "Looks like we're out of stock in this category. Check back later!",
					"reference" => "",
					"bullets" => [""] 
				];
				array_push($stack, $push);
			}
		}
		
		function Fillcategory($category)
		{
			global $db, $i, $stack;
			$stack = [];
			$i = 0;
			$stmt = $db->prepare("SELECT * FROM categories WHERE id='".$category."' LIMIT 1"); 
			$stmt->execute(); 
			$cat = $stmt->fetch();
			foreach($db->query("SELECT * FROM shop WHERE cat='".$category."' AND stock>='1' ORDER BY icon DESC, name ASC") as $row)
			{
				$push = [
					"title" => $row['name'],
					"icon" => $row['icon'],
					"subtitle" => ($row['price']/100).'GP',
					"description" => $row['brief'],
					"reference" => "",
					"bullets" => [$row["info"]] 
				];
				array_push($stack, $push);
				$i++;
			}
			Outofstock();
			echo '<script>var data_'.strtolower($cat['name']).' = '.json_encode($stack).';</script>';
		}
		$stack;
		$i;
		for ($j = 0; $j < $catcount; $j++)
		{
			Fillcategory($j);
		}
	?>

    <script type="text/javascript" src="js/quickref.js" charset="utf-8"></script>
</body>
</html>
