goldkey = [38,38,40,40,37,39,37,39,66,65,66,65];
goldkey_index = 0;
terminal_on = false;

fuck = 0;

$(document).ready(function(){
	$(this).keydown(function(){
		if(terminal_on == true)
			return;
		if(event.keyCode == goldkey[goldkey_index]){
			goldkey_index++;
			if(goldkey_index == goldkey.length){
				terminal_on = true;
				$('#terminal').animate({left:'0px'},500);
				$('#terin').focus();
				setTimeout("$('#terin').val('')",200);
			}
		}
		else
			goldkey_index = 0;
	});
	
	$('#terminal').keydown(function(){
		if(event.keyCode == 13){
			text = $('#terin').val();
			if(text != ''){
				handleterminal(text);
				$('#terin').val('');
			}
		}
	});
});

function handleterminal(text){
	split = text.split(' ');
	switch(split[0]){
		case 'help':
			$('#msgwindow').val('Sorry, you should do it yourself!');
			break;
		case 'songid':
			$('#msgwindow').val('songid: '+song);
			break;
		case 'volume':
			$('#msgwindow').val('volume: '+volume);
			break;
		case 'users':
			$.ajax({
				type:'POST',
				url:'./handle/user.php',
				data:{
					operation:'USERONLINE'
				},
				success:function(data){
					$('#msgwindow').val('users online now: '+data);
				},
				error:function(){
					$('#msgwindow').val('error accured...');
				}
			});
			break;
		case 'exit':
			terminal_on = false;
			$('#terminal').animate({left:'-400px'});
			$('#msgwindow').val('');

			goldkey_index = 0;
			break;
		default:handleinputerror(text);
	}
}

function handleinputerror(text){
	if(fuck > 5){
		$('#msgwindow').val('你不是主人！%>_<%');
	}
	else
		$('#msgwindow').val('error: Unexpected input "'+text+'"');
	fuck++;
}