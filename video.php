<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Spider's Hub</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	 
</head>
<body>
<?php $q=$_GET['term'];
$maxResults=12;
error_reporting(0);
$type = isset($_GET["type"]) ? $_GET["type"] : "sites";


 ?>
	<div class="wrapper">
	
		<div class="header">


			<div class="headerContent">

				<div class="logoContainer">
					<a href="index.php">
						<img src="assets/images/doodleLogo.png">
					</a>
				</div>

				<div class="searchContainer">

					<form action="video.php" method="GET">

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

                    <li class="<?php echo $type == 'musics' ? 'active' : '' ?>">
                        <a href='<?php echo "music.php?term=$q&type=musics"; ?>'>
                            Music
                        </a>
                    </li>

					<li class="<?php echo $type == 'videos' ? 'active' : '' ?>">
						<a href='<?php echo "video.php?term=$q&type=videos"; ?>'>
							Video
						</a>
					</li>

				</ul>


			</div>
		</div>










		<div class="mainResultsSection">
			<p class="resultsCount">Showing top results for <strong><?= $_GET['term'] ?></strong></p>
			<div class="siteResults">

<?php
if (isset($_GET['term']) )
{
     
  if (!empty($_GET['term']))
  {
    $apikey = 'AIzaSyDIoxs-q4MkHxWrnB7Btd_kVxiaML8E058'; 
    $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . urlencode($q) . '&maxResults=' . $maxResults  . '&key=' . $apikey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);
    $value = json_decode(json_encode($data), true);
?>


<div class="row mr-0 videos-data-container" id="SearchResultsDiv">

<?php
$videoId=NULL;
    for ($i = 0; $i < $maxResults; $i++) {
        $videoId = $value['items'][$i]['id']['videoId'];
        $title = $value['items'][$i]['snippet']['title'];
        $description = $value['items'][$i]['snippet']['description'];
		if($videoId){
        ?> 
    <div class="col-md-3 mb-5">
		<div class="video-tile">
<div  class="videoDiv">
    <!-- <iframe id="iframe" style="width:100%;height:100%" src="//www.youtube.com/embed/<?php echo $videoId; ?>" 
data-autoplay-src="//www.youtube.com/embed/<?php echo $videoId; ?>?autoplay=1"></iframe> -->
<div data-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $videoId; ?>" data-target="#myModal" class="video-btn" style="cursor: pointer;"> <i class="fab fa-youtube videoiconoverlay"></i></div>

    <img src="https://img.youtube.com/vi/<?php echo $videoId; ?>/0.jpg" class="img-fluid pb-3 video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $videoId; ?>" data-target="#myModal"/>    
</div>
<div class="videoInfo">
<div class="videoTitle">
<b>
<a href="" data-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $videoId; ?>" data-target="#myModal" class="video-btn" >
<?php echo substr($title,0,80); ?>
</a>
</b>
</div>

</div>
</div>
	</div>
		
           <?php 
		}// end if video id condition
        }
    } 
           
}
?> 
</div>
</div>
</div>

  <!-- Modal -->
<div class="modal videomodal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      
      <div class="modal-body">

       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
        <!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always"></iframe>
</div>
        
        
      </div>

    </div>
  </div>
</div>
<script type="text/javascript">
    //for youtube video modal
$(document).ready(function() {
      var $videoSrc;  
      $('.video-btn').click(function() {
          $videoSrc = $(this).data( "src" );
      });
      console.log($videoSrc);
      $('#myModal').on('shown.bs.modal', function (e) {

      $("#video").attr('src',$videoSrc + "?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;autoplay=1" ); 
      })

      $('#myModal').on('hide.bs.modal', function (e) {

          $("#video").attr('src',$videoSrc); 
      })

});
</script>

        <div class="footer-bottom">
            <div class="left">&copy; Copyright 2020, Developed by Md Aminur Rahman, Grove School of Engineering, City College of New York</div>

        </div>
</body>
</html>