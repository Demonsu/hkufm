<?php	
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';



	$num = 1;
	$line = '';
	
	for ($num=1; $num<=2193; $num++) 
	{
		echo $num." : ";
		
		try {
			$line = file_get_contents("../music/infov2/".$num.".txt");
			//echo $line;
			$obj = json_decode($line);
			//echo "</b>";
			//var_dump($obj);
			$title= $obj->{'title'};
			
			$author =$obj->author;
			
			$authorname= $author[0]->name;
			//echo $author[0];
			$rating =$obj->rating->{'average'};
			$image =$obj->image;
			$musicurl=$obj->music_url;
			echo $title." ".$authorname." ".$rating." ".$image." ".$musicurl."</br>";
			$m=new Music();
			echo $m->updateSong($num,$title,$authorname,$image,$musicurl,$rating);
		}
		catch (Exception $e)
		{
			echo "failed</br>";
		};
		//fclose($file_handle);
	} 
		
		
		//$m=new Music();
		//$m->insertSong(1001,2193);
		
	

	
	
	
?>