<?php

ob_start();
$num=0;
$dirpt  =  "online";
$reftime  =  1;
if (is_dir($dirpt) && $dir = opendir($dirpt)) {
 while (($file = readdir($dir)) !== false) {
  if(strcmp($file,"..")==0 || strcmp($file,".")==0){
    continue;
  }
  $D_[date("Y-m-d H:i:s",filemtime($dirpt."/".$file))]=$file;
  $num++;
  unset($cum);
 } 
 closedir($dir);
 $filename  =  session_id();
 $fp    =  fopen($dirpt."/".$filename,"w");
 fputs($fp,"");
 fclose($fp);
 $ntime  =  date("Y-m-d H:i:s",mktime(date("H"),date("i")-1,0,date("m"),date("d"),date("Y")));
 $D_[$ntime]="-";
 krsort($D_);
 $onlinenumber=0;
 while(1){
  $vkey=key($D_);
  $onlinenumber++;
  if(strcmp($ntime,$vkey)==0){
    break;
  }else{
    array_shift($D_);
  }
 }
 array_shift($D_);
 reset($D_);
 while(count($D_)>0){
  $ckey=key($D_);
  unlink($dirpt."/".$D_[$ckey]);
  if(!next($D_)){
    break;
  }
 }
}else{
  @chmod("..",0777);
  @mkdir($dirpt,0777);
  
}
$online=$onlinenumber-1;
$retime=60*$reftime;
echo "当前在线<strong><font color=red>$online</font></strong>人<meta http-equiv=refresh content=\"{$retime},url=\">";
ob_end_flush();
?>