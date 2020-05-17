<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Spider's Hub</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	 
</head>
<body>
<?php $q=$_GET['term']; ?>
	<div class="wrapper">
	
		<div class="header">


			<div class="headerContent">

				<div class="logoContainer">
					<a href="index.php">
						<img src="assets/images/doodleLogo.png">
					</a>
				</div>

				<div class="searchContainer">

					<form action="search.php" method="GET">

						<div class="searchBarContainer">
							<input type="hidden" name="type" value="<?php echo $type; ?>">
							<input class="searchBox" type="text" name="term" value="<?php echo $q; ?>" autocomplete="off">
							<button class="searchButton">
								<img src="assets/images/icons/search.png">
							</button>
						</div>

					</form>

				</div>

			</div>


			<div class="tabsContainer ">

				<ul class="tabList ">

					<li class="<?php echo $type == 'sites' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?term=$q&type=sites"; ?>'>
							Sites
						</a>
					</li>

					<li class="<?php echo $type == 'images' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?term=$q&type=images"; ?>'>
							Images
						</a>
					</li>
					<li class="<?php echo $type == 'audio' ? 'active' : '' ?>">
						<a href='<?php echo "audio.php?term=$q&type=audio"; ?>'>
							Audio
						</a>
					</li>

				</ul>


			</div>
		</div>










		<div class="mainResultsSection">
			<p class="resultsCount">Showing top 10 results</p>
			<div class="siteResults">


<?php
$query=$_GET['term'];
$data = [
    'q' => $query,
    'api_token' => '195c31c4f719932a1f2e5b07ffc47f69',
];
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_URL, 'https://api.audd.io/findLyrics/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
curl_close($ch);
//echo $result;
$res = json_decode($result, true);
//print_r($res);
//echo $res['result'][0]["song_id"];
//print_r( $res->{'result'}->{0}->{'song_id'});
foreach ($res['result'] as $value) {
	echo '<h3 class="title" style="font-size:18px">'.$value['full_title'].'</h3>';
	//echo 'Media: '.$value['media'].'<br/>';
	$media = json_decode($value['media'], true);
	//print_r($media);
	foreach ($media as $link) {
		if($link['provider']!='apple_music')
		echo '<a href="'.$link['url'].'" target="_blank">'.$link['provider'].'</a> &nbsp; ';
	}
	echo '<br/><br/>';
}
?>
</div>
</div>
</div>

<div class="footer-bottom">
    <div class="left">&copy; Copyright 2020, Developed by Md Aminur Rahman, Grove School of Engineering, City College of New York</div>

</div>
</body>
</html>