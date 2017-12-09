<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>

		<!-- Ex 1: Number of Songs (Variables) -->
		<?php
		$song_count = 5678;
		$song_hour = (int)($song_count / 10);
		?>
		<p>
			I love music.
			I have <?= $song_count ?> total songs,
			which is over <?=$song_hour?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>

			<ol>
				<?php
				$news_pages = 5;
				if(isset($_GET["newspages"])){
					$news_pages = $_GET["newspages"];
				}

				for($i =0; $i<$news_pages;$i++){ ?>
				<li><a href="http://music.yahoo.com/news/archive/?page=<?=$i+1?>">Page <?=$i+1?></a></li>
				<?php } ?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<?php
		$favorite_artists = array("Guns N' Roses","Green Day","Blink182","Queen");
		 ?>
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<?php
			$favorite_artists = file("favorite.txt");
			function str_converter($name){
				$before = explode(" ",$name);
				$after = implode("_",$before);
				return $after;
			}
		 ?>
		<div class="section">
			<h2>My Favorite Artists</h2>

			<ol>
				<?php foreach ($favorite_artists as $artist) { ?>
					<li><a href="http://en.wikipedia.org/wiki/<?=str_converter($artist)?>"><?=$artist?></a></li>
				<?php  }?>
			</ol>
		</div>

		<!-- Ex 6: Music (Multiple Files) -->
		<?php
		function cmp($a, $b)
		{
		    if (filesize($a) == filesize($b)) {
		        return 0;
		    }
		    return (filesize($a) < filesize($b)) ? 1 : -1;
		}
			$music_list = glob("lab5/musicPHP/songs/*.mp3");
			usort($music_list,"cmp");
		 ?>
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<?php
					foreach($music_list as $music) {
				 ?>
				<li class="mp3item">
					<a href="<?=$music?>"><?=basename($music)?></a>(<?=(int)(filesize($music)/1024)?>KB)
				</li>
				<?php } ?>

				<!-- Exercise 8: Playlists (Files) -->
				<?php
					$reverse_playlist = array_reverse(glob("lab5/musicPHP/songs/*.m3u"));
					foreach($reverse_playlist as $playlist) {
				 ?>
				 <li class="playlistitem"><?=basename($playlist)?>:
					 <ul>
						 <?php
						 $shuffled_list = file($playlist);
						 shuffle($shuffled_list);
						 foreach ($shuffled_list as $list) {
							 if(strpos($list,"mp3") != 0) {?>
						 		 		<li><?=$list?></li>
					 <?php } }?>
					 </ul>
				 </li>
			 <?php } ?>
			</ul>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
