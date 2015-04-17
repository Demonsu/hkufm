<?php	
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';



	$num = 0;
	$line = '';
	$file_handle = fopen("song.csv", "r");
	$m=new Music();
	while(!feof($file_handle)) 
	{ 
		if ($num++ % 10000==0)
			echo (($num+0.1)/6000)."%</br>";
		$line=fgets($file_handle);
		//echo $line."--->>>>>";
		$song=explode(",",$line,3);
		//echo $song[0]." ".$song[1]." ".$song[2]."</br>";
		$m->insertSong($song[0],$song[2],$song[1]);
		
		//$line = $line.fgets($file_handle);
	} 
	fclose($file_handle);
	
		
	

	
	
	
?>