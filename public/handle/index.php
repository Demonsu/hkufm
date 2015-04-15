<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<?php
$_BASE_PATH="../../";
include_once '../../sys/core/init.inc.php';
include "./getid3/getid3.php";
$getid = new getid3;
for($i = 1;$i<=2899;$i++){

			

	$fileinfo = $getid->analyze('../music/musicv2/billboard'.$i.'.mp3');


	echo $fileinfo['tags']['id3v1']['title'][0];

	echo $fileinfo['tags']['id3v1']['artist'][0];

	echo $fileinfo['tags']['id3v1']['album'][0];

	echo $fileinfo['tags']['id3v1']['year'][0];

	$title = $fileinfo['tags']['id3v1']['title'][0];
	$artist = $fileinfo['tags']['id3v1']['artist'][0];
	$album = $fileinfo['tags']['id3v1']['album'][0];
	$year = $fileinfo['tags']['id3v1']['year'][0];

	$douban = '
		{
			"attrs":{
				"singer":["%s"],
				"pubdate":["%s"]
			},
			"title":"%s",
			"rating":{
				"average":"%s"
			},
			"image":"./img/default.jpg"
		}
	';
	$line = sprintf($douban,$artist,$year,$title,'0');
	
	$fp = fopen("../music/infov2/billboard".$i.".txt", "w+");
	fwrite($fp,$line); 
	fclose($fp);
}

?>