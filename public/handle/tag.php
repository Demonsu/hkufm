<?php	
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	$operation=$_POST["operation"];
	ini_set('max_execution_time', 120);
	if ($operation == 'GETTAGBYTAG'){
		
		$tag = $_POST['tag'];
		$m=new Music();
		
		echo $m->getTag($tag);
		
	
	}
	if($operation == 'GETTAGBYSONGID'){//��ȡ������Ϣ
		$tag = $_POST['song'];
		$m=new Music();
		
		echo $m->getSongTag($tag);
	}
?>
