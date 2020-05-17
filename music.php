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
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

	 
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

					<form action="music.php" method="GET">

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
			<div class="siteResults row mr-0">

                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="music"  allowscriptaccess="always"></iframe>
                </div>

<?php
if (isset($_GET['term']) )
{
     
  if (!empty($_GET['term']))
  {
	  $clientID='5412b486c62700b0f6f739432e9d83c4';
    $api_url = "http://api.soundcloud.com/tracks.json?client_id=$clientID&q=".urlencode($_GET['term']);
//get json datas from soundcloud API
$api_content = file_get_contents($api_url);
//Decodes a JSON string
$api_content_array = json_decode($api_content, true);
//print_r($api_content_array);
foreach ($api_content_array as $val) { ?>

<div class="col-md-3 mb-5">
<div class="musicbox">
<a href="" data-toggle="modal" data-src="http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F<?php echo $val['id'];?>" data-target="#myModal" class="video-btn" >

<img src="<?php echo $val['user']['avatar_url'];?>" width="50" height="50" title="Play" alt="Play" class="rounded-circle float-left mr-3" />
<h6><?php echo $val['title'];?></h6>
</a>
<a href="<?php echo $val['permalink_url'];?>" class="badge badge-success float-right">Details</a>
<div class="clearfix"></div>
</div>
</div>

<?php
 }
?>




    
		
           <?php 
		
    } 
           
}
?> 
</div>
</div>
</div>

  <!-- Modal -->
<div class="modal videomodal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">

      
      <div class="modal-body">

       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
        <!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
<iframe class="embed-responsive-item"  scrolling="no" frameborder="no" src="" id="video" allowscriptaccess="always"></iframe>
  
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
      $('#myModal').on('shown.bs.modal', function (e) {

      $("#video").attr('src',$videoSrc + "?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;autoplay=1" ); 
      })

      $('#myModal').on('hide.bs.modal', function (e) {

          $("#video").attr('src',$videoSrc); 
      })

});
</script>
<script>
$('.siteResults ').masonry({
  // options...
  itemSelector: '.col-md-3'
});
</script>

<div class="footer-bottom">
    <div class="left">&copy; Copyright 2020, Developed by Md Aminur Rahman, Grove School of Engineering, City College of New York</div>

</div>
</body>
</html>