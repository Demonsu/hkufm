<?php	
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	$operation=$_POST["operation"];
	
	if ($operation == 'GETTAGBYTAG'){
		
		$tag = $_POST['tag'];
		$m=new Music();
		
		echo $m->getTag($tag);
		
	
	}
	if($operation == 'GETTAGBYSONGID'){//获取音乐信息
		$str = '
				{
					"src":"%s.mp3",
					"douban":%s,
					"songid":%s,
					"extra":%s
				}
			';
		$extra = 0;
		$num = $_POST['songid'];
		$nump = $num;
		$line = '';
		if($num <= 2193){
			$file_handle = fopen("../music/infov2/".$num.".txt", "r");
			$line = fgets($file_handle);
			fclose($file_handle);
		}
		else{
			$nump = 'billboard'.($num-2193);
			
			$file_handle = fopen("../music/infov2/".$nump.".txt", "r");
			while(!feof($file_handle)) 
			{ 
				$line = $line.fgets($file_handle);
			} 
			fclose($file_handle);
		}
		$return = sprintf($str,$num,$line,$num,$extra);
		//$return = sprintf($str,$nump,$line,$num,$extra);
		
		echo $return;
	}
?>
