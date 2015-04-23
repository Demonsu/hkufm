<?php

class Music extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	
	public function getTag($tag){
	//<li class='list-group-item'>hahahah<span class="badge">hehe</span></li>
		$r="";
		$sql = "SELECT * FROM song where tag like '%".$tag."%' limit 0,100";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while($result=mysql_fetch_assoc($select)){
			$r=$r."<li class='list-group-item'><h4 class='list-group-item-heading'>";
			$r=$r.$result['title']."</h4>";
			$r=$r."<p class='list-group-item-text'>";
			$tags=explode(",",$result['tag']);
			foreach ($tags as $t)
			{
				$r=$r."<span class=\"badge\">".$t."</span>";
			}
			$r=$r."</p></li>";
		}
		return $r;
	}
	public function getSongTag($song){
		$r="";
		$sql = "SELECT * FROM song where title like '%".$song."%' limit 0,100";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while($result=mysql_fetch_assoc($select)){
			$r=$r."<li class='list-group-item'><h4 class='list-group-item-heading'>";
			$r=$r.$result['title']."</h4>";
			$r=$r."<p class='list-group-item-text'>";
			$tags=explode(",",$result['tag']);
			foreach ($tags as $t)
			{
				$r=$r."<span class=\"badge\">".$t."</span>";
			}
			$r=$r."</p></li>";
		}
		return $r;
	}
	
	public function getlist($uid){
	
		$sql = "SELECT * FROM record WHERE uid='".$uid."' AND (action='like' or action='listen')";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		$return = "";
		$result = null;
		if($num > 0){
			while($result=mysql_fetch_assoc($select)){
				$return = $result['sid'].",".$return;
			}
		}
		
		$sql = "SELECT * FROM recom where uid='".$uid."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if($num > 0){
			while($result=mysql_fetch_assoc($select)){
				$return = $result['sid'].",".$return;
			}
		}
		for ($i=0;$i<5;$i++)
			$return = rand(1,2193).",".$return;
		return $return;
	}
	public function addRecord($uid,$sid,$time,$type){
		$sql="select * from record where uid='".$uid."' and sid='".$sid."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num>0)
		return -1;
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
