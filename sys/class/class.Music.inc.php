<?php

class Music extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	
	public function getlist($uid){
		$sql = "SELECT * FROM record WHERE uid='".$uid."' AND action='like' or action='listen' ORDER BY time DESC";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		$return = "";
		$result = null;
		if($num > 0){
			$date = date('Y-m-d H:i:s');
			$time = date('Y-m-d H:i:s',strtotime("$date +6 hour"));
			$result=mysql_fetch_assoc($select);
			if(strtotime($result['time']) > strtotime($time)){
				$return = $result['sid'];
			}
			while($result=mysql_fetch_assoc($select)){
				if(strtotime($result['time']) > strtotime($time) ){
					$return = $result['sid'].",".$return;
				}
				else{
					break;
				}
			}
		}
		
		return $return;
	}
	public function addRecord($uid,$sid,$time,$type){
		$sql = "INSERT INTO record (uid,sid,time,action) VALUES 
			('".$uid."','".$sid."','".$time."','".$type."');
		";
		if (!mysql_query($sql,$this->root_conn))
		{
			die('Error: ' . mysql_error());
		}
		return 1;
	}
	public function insertSong ($id,$title,$author)
	{

		$sql="insert into song (sid,title,author) VALUES ('".$id."','".$title."','".$author."')";
		if (!mysql_query($sql,$this->root_conn))
		{
			echo $sql;
			//die('Error: ' . mysql_error());
		}
		
	}
	public function updateSong($id,$title,$author,$image,$music_url,$rating){
		$sql="update song set title='".$title."',author='".$author."',image='".$image."',music_url='".$music_url."',rating='".$rating."' where sid='".$id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
			//die('Error: ' . mysql_error());
		}
		return 1;
	}
	
}

?>
