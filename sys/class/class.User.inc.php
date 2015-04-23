<?php

class User extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	
	public function register($uid,$passwd){
		$sql="SELECT * FROM user WHERE uid='".$uid."' ";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num>=1)
			return 0;
		$sql = "
			INSERT INTO user 
			(uid,passwd)
			VALUES
			('".$uid."','".$passwd."')
		";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;
	}
	
	public function login($uid,$passwd){
		$sql="SELECT * FROM user WHERE uid='".$uid."' AND passwd='".$passwd."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		$result=mysql_fetch_assoc($select);
		if ($num>0)
		{
			$_SESSION["USERID"]=$uid;
			return 1;
		}else
		{
			return 0;
		}
	}
	public function useronline(){
		$sql = "SELECT uid FROM record WHERE time > now()-5000";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$arr = array();
		while($result=mysql_fetch_assoc($select)){
			if(!in_array($result['uid'],$arr)){
				array_push($arr,$result['uid']);
			}
		}
		return count($arr);
	}
	public function getrecom($uid)
	{
		$sql="
			select s.sid,s.title,r.degree from recom r,song s where r.uid='".$uid."' and s.sid=r.sid
		";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		$r="";

		while($result=mysql_fetch_assoc($select)){
			$r=$r."<li onclick=\""."playrecom(".$result['sid'].")\">".$result['title'].":".$result['degree']."</li>";
		}
		
		$sql = "SELECT r.sid,s.title, r.action FROM record r, song s WHERE (s.sid = r.sid)AND(r.uid='".$uid."') AND (r.action='like' or r.action='listen')";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if($num > 0){
			while($result=mysql_fetch_assoc($select)){
				$r=$r."<li onclick=\""."playrecom(".$result['sid'].")\">".$result['title'].":".$result['action']."</li>";
			}
		}
		
		if ($r=="")
			return "Sorry, None For You";
		return $r;
		
	}
	public function adduser($uid,$name,$tid){
		$sql = "
			INSERT INTO user 
			(uid,passwd,name,tid)
			VALUES
			('".$uid."','".$uid."','".$name."','".$tid."')
		";
		if (!mysql_query($sql,$this->root_conn))
		{
			echo $sql;
		  //die('Error: ' . mysql_error());
		}	
		 return 1;
	}
}

?>