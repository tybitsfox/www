<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
phpinfo();
/*extension_loaded('ffmpeg') or die("error loading");
$ffmpegInstance = new ffmpeg_movie("./movie/pacific.mp4");
echo "getFrameHeight: " . $ffmpegInstance->getFrameHeight()."<br>";
echo "getFrameWidth: " . $ffmpegInstance->getFrameWidth()."<br>"; 
echo "<br>end<br>";*/
?>
<?php/*
if (! extension_loaded (ffmpeg)) exit ('ffmpeg was not loaded ');
$movie_file = "test2.mp4";

// Instantiates the class ffmpeg_movie so we can get the information you want the video  
$movie = new ffmpeg_movie($movie_file);  

//Need to create a GD image ffmpeg-php to work on it  
$image = imagecreatetruecolor($width, $height); 

//Create an instance of the frame with the class ffmpeg_frame  
$frame = new ffmpeg_frame($Image);  

//Choose the frame you want to save as jpeg  
echo $thumbnailOf = $movie->getFrameRate() * 5;  

//Receives the frame  
$frameImg = $movie->GetFrame($thumbnailOf);

// Resizes the frame to 200, 100
//$frameImg-> resize(200, 100);  

//Convert to a GD image  
$image = $frameImg->toGDImage(); 

//Save to disk.  
imagejpeg($image, $movie_file.'.jpg', 100); */
?>
