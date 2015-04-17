<?php	
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';



	$num = 2194;
	$line = '';
	$file_handle = fopen("ids.txt", "r");
	$m=new Music();
	while(!feof($file_handle)) 
	{ 
		$line=fgets($file_handle);
		echo $line."--->>>>>";
		$song=explode(":",$line,2);
		echo $song[0]." ".$song[1]."</br>";
		echo $m->insertSong($num,$song[1],$song[0]);
		$num++;
		//$line = $line.fgets($file_handle);
	} 
	fclose($file_handle);
	
		
	

	
	
	
?>