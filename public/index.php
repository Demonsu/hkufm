<?php
	$user = 0;
	if(isset($_SESSION['USERID'])){
		$user = 1;
	}
	else if(isset($_SESSION['VISITORID'])){
		$user = 2;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>HKU FM</title>
	
	<link rel="icon" href="./img/hkufm.ico" type="image/x-icon" /> 
	<link rel="shortcut icon" href="./img/hkufm.ico" type="image/x-icon" />
	
	<link rel="stylesheet" href="./dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="./css/index.css" />
	<link rel="stylesheet" href="./css/console.css" />
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="./js/index.js"></script>
	<script type="text/javascript" src="./js/console.js"></script>

<?php if($user == 1) echo '
<script>
	$(document).ready(function(){
		userid = "'.$_SESSION["USERID"].'";
		getuserinfo();
		playmode(1);
		usertype = 1;
	});
</script>
'; 
else if($user == 2) echo'
<script>
	$(document).ready(function(){
		userid = "Visitor"+"'.$_SESSION["VISITORID"].'";
		getuserinfo();
		playmode(2);
		usertype = 2;
	});
</script>
';
?>


</head>
<body>
	<div class="topcover">
		<p class="triT">
			<?php if($user == 1) echo "Hello <a href='javascript:triT();'>".$_SESSION['USERID']."</a> <a href='./handle/logout.php'>Logout</a>";
				else if($user == 2)
					echo "Hello Visitor<a href='javascript:triT();'>".$_SESSION['VISITORID']."</a> <a href='./handle/logout.php'>Logout</a>";
				else
					echo '<a href="javascript:triT();">Login</a>';
			?>
		</p>
		<div id="topmsg">
			<p id="msgshow">test</p>
		</div>
	</div>
	<div id="login-panel">
		<div id="login" <?php if($user == 1 || $user == 2) echo 'style="display:none;opacity:0"'; ?> >
			<p><h3>Login</h3></p>
			<p style="margin-left:-20px">username</p>
			<p><input  placeholder="username"  type="text" id="loginid" /></p>
			<p>pwd<a href="./forget.php">(forget?)</a></p>
			<p><input  placeholder="password" type="password" id="loginpasswd" onkeypress="ifreturn()" /></p>
			<p id="loginerror"></p>
			<p>
				<button class="loginbtn" onclick="login()">login</button>
				<button class="loginbtn" onclick="gotoR()">register</button>
			</p>
			
		</div>
		<div id="register" style="display:none">
			<p><h3>New User</h3></p>
			<p>username</p>
			<p><input type="text" id="Rid"/></p>
			<p>password</p>
			<p><input type="password" id="Rpasswd"/></p>
			<p>confirm</p>
			<p><input type="password" id="Rconfirm"/></p>
			<p id="registererror"></p>
			<p>
				<button class="loginbtn glyphicon glyphicon-arrow-left" onclick="backlogin()"> </button>
				<button class="registerbtn" onclick="register()">R&Login</button>
			</p>
		</div>
		<div id="user" <?php if($user == 0) echo 'style="display:none;opacity:0"'; ?> >
			<p><h3 id="user-id"></h3></p>
			<p><button class="loginbtn" onclick="window.location='./handle/logout.php'">logout</button></p>
			<div class="recommenditem" id="recommendbox">
				<div class="recommendbox">
					<div class="musicbox" onclick="playthis()"></div>
					<div class="musictitle"></div>	
				</div>
				<div class="musicleft" onclick="showVisitor(1)"></div>
				<div class="musicright" onclick="showVisitor(2)"></div>
			</div>
			<div class="musictags">
				<p>Current Song: <span id="tagid"></span></p>
				<p id="newtags">
				
				</p>
				<p><label><input type="text" id="tags" /><button class="btnright" onclick="addtags()">OK</button></label></p>
				
				<p><label class="addtags">
				<button class="btnleft" onclick="cleartags()">Clear</button>
				<button class="btnright">Give TAG</button>
				</label></p>
				<p id="oldtags">
				
				</p>
			</div>
			<p><a href="javascript:playmode(4)">Continue</a></p>
		</div>
	</div>
	
	<div class="Sweet_button">
		<div class="Sweet_pp">
			<div class="Sweet_pp_x" id="pp_button" onclick="play_pause()"></div>
		</div>
		<div class="Sweet_next" onclick="recommendation()"></div>
		<div class="Sweet_love" onclick="like()"></div>
		<div class="Sweet_trash" onclick="hate()"></div>
		<div class="progress-line">
			<div id="progress-inline"></div>
		</div>
		<div id="time_left">0:00</div>
		<div id="time_right">-0:00</div>
		<div class="music_ico">
			<img id="music_img" height="80px"/>
			<div id="img_cover">
				<div class="music_sound">
					<img id="sound_ico" src="./img/sound24.png" width="24px" onclick="volume_0_1()"/>
					<div class="sound_under">
						<div id="sound_length"></div>
						<div class="length_cover" onclick="change_volume(this)"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="music_info">	
			<div class="music_title"><span id="title1"></span></div>
			<div class="music_title">Issue Date: <span id="title2"></span></div>
			<div class="music_title">Rating: <span id="title3"></span></div>
			<div class="music_title">Public: <span id="title4"></span></div>
		</div>
	</div>

	<div class="footer">
		<span>Copyright 2015. <br> <a href="javascript:void(0)" onclick="window.open('http://cser.nju.edu.cn/XiaFan')">@Demonsu</a><br>All Rights Reserved.</span>
	</div>
	
	<div id="terminal">
		<div class="tertitle">
			ternimal
		</div>

		<textarea id="msgwindow" disabled ></textarea>

		<input type="text" id="terin" />
	</div>

	
</body>
</html>
