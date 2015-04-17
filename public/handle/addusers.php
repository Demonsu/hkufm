<?php	
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	
	$num=0;
	$file_handle = fopen("user.csv", "r");
	while(!feof($file_handle)) 
	{ 
		if ($num++ % 10000==0)
			echo (($num+0.1)/11000)."%</br>";
		$line=fgets($file_handle);
		//echo $line."--->>>>>";
		$user=explode(",",$line,3);
		//echo $user[0]." ".$user[1]." ".$user[2]."</br>";
		$u=new User();
		$u->adduser($user[0],$user[2],$user[1]);
		
	}
?>
