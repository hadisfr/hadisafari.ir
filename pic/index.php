<!doctype html>
<!--
	© 2016 Hadi Safari
	
	http://hadisafari.ir
	info[at]hadisafari.ir
-->
<?php
	$avatar = "avatar.jpg";
	$name = "Hadi Safari";
	$defaultdir = "img/home";
	/*
		dir/file.png
		dir/thumb/file.png
		dir/det.js (optional): {"file.png": "detail", "anotherfile.png": "det"};
	*/
?>
<html lang="en"><head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Protofolio</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="canonical" href="http://pic.hadisafari.ir" />
	<link rel="icon" type="image/png" href="icon.png">
	<?php
		function testinput($str){
			$str = trim($str);
			$str = stripslashes($str);
			$str = htmlspecialchars($str);
			return $str;
		}
		function addmenunode($addr){
			$dir = scandir($addr);
			$flag = false;
			if($addr == "img")
				$isroot = true;
			else
				$isroot = false;
			for($i = 0; $i < count($dir); $i++)
				if(strpos($dir[$i], "thumb") === false && strpos($dir[$i], "det") === false && strpos($dir[$i], ".") === false){
					$flag = true;
					break;
				}
			if(!$isroot)
				echo "<li><a href=" . ".?dir=" . str_replace("/", "*", $addr) . ">" . substr($addr, strrpos($addr, "/") + 1) . "</a>\t";
			if($flag){
				if(!$isroot)
					echo "<ul>";
				for($i = 0; $i < count($dir); $i++)
					if(strpos($dir[$i], "thumb") === false && strpos($dir[$i], "det") === false && strpos($dir[$i], ".") === false)
						addmenunode($addr . "/" . $dir[$i]);
				if(!$isroot)
					echo "</ul>";
			}
			if(!$isroot)
				echo "</li>";
		}
		$dir = testinput($_GET["dir"]);
		if($dir == false){
			$dir = $defaultdir;
		}
		$dir = str_replace("*", "/", $dir);
		$pics = scandir($dir);
		echo "\n";
	?>
	<script>
		var address = "<?php echo $dir; ?>";
		var piclist = [
		<?php
			echo "\t";
			for($i = 2, $flag = false; $i < count($pics); $i++){
				if(strpos($pics[$i], ".") === false || strpos($pics[$i], "det.js") !== false)
					continue;
				if($flag)
					echo ",\n\t\t\t";
				$flag = true;
				echo "\"" . $dir . "/thumb/" . $pics[$i] . "\"";
			}
			echo "\n";
		?>
		];
		<?php
			$detaddr = $dir . "/det.js";
			if(file_exists($detaddr)){
				echo "var det = " . file_get_contents($detaddr) . ";\n";
			}
			echo "\n";
		?>
	</script>
</head><body>
	<div id="sidebar">
		<div id="sideheader">
			<img src=<?php echo $avatar; ?>>
			<h3><?php echo $name; ?></h3>
		</div>
		<div id="menutoggle"><a href=""><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></a></div>
		<ul id="sidemenu">
			<?php
			addmenunode("img");
			?>

		</ul>
	</div>
	<div id="mainbar">
		<div id="header">
			<h1><a href=".">Portofolio</a></h1>
			<ul id="mainmenu">
				<li><a href=".">Home</a></li>
				<li><a href="http://hadisafari.ir/" target="_blank">hadisafari.ir</a></li>
			</ul>
		</div>
		<div class="col"></div>
		<div class="col"></div>
		<div class="col"></div>
		<div class="clearfix"></div>
		<div id="footer">
			<p>All pictures &copy; 2016 - 2018 Hadi Safari. All rights reserved.</p>
			<p>info[at]hadisafari.ir</p>
		</div>
	</div>
	<div id="msgback"><div id="msganima"><div id="msgbox">
		<img src="">
		<div class="det">
			<div id="msgdet"></div>
			<p>&copy; Hadi Safari</p>
		</div>
	</div></div></div>
	<script src="http://hadisafari.ir/js/jquery.min.js"></script>
	<script src="script.js"></script>
</body></html>