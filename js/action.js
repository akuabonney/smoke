var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
	var xmlHttp;
	if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();
		}
		else{
			xmlHttp = new ActiveObject("Microsoft.XMLHTTP");
			}
			return xmlHttp;
}

function checkin () {
	$('#chatwindowbx').fadeIn(200);
	$('#welbx').fadeOut(200);
	$('#chatareabx').fadeIn(200);
}

function closeall(){
	$('#chatareabx').fadeOut(200);
	$('#chatwindowbx').fadeOut(200);
	$('#welbx').fadeIn(200);
	document.getElementById("treadbx").innerHTML = '<div class="chtlinebx"><div class="botchtbx"><div class="chtxtbx botxt">Hi am a muzikiBot</div></div></div><div class="chtlinebx"><div class="botchtbx"><div class="chtxtbx botxt"><strong>Here are my commands</strong><br>/getlyics - to get the lyrics of a song<br>/getartistbio - to get the bio of an artist<br>/gettopten - to get the top ten songs on the billboard chart</div></div></div>';
}

function sendtxt(){
	var msg = $('#textmesg').val();
	if(msg != ''){
		var tread = document.getElementById("treadbx").innerHTML;
		document.getElementById("treadbx").innerHTML = tread + '<div class="chtlinebx"><div class="userchtbx"><div class="chtxtbx usertxt">'+msg+'</div></div></div>';
		document.getElementById('textmesg').value = "";

		if(xmlHttp.readyState == 0 || xmlHttp.readyState == 4){
			xmlHttp.open("POST", "inc/actions.php", true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.onreadystatechange = function(){
				if (xmlHttp.readyState==4 && xmlHttp.status==200){
					if(xmlHttp.responseText != 'error'){
						var tread = document.getElementById("treadbx").innerHTML;
						document.getElementById("treadbx").innerHTML = tread + xmlHttp.responseText;
					}
					else{
						var tread = document.getElementById("treadbx").innerHTML;
						document.getElementById("treadbx").innerHTML = tread + '<div class="chtlinebx"><div class="botchtbx"><div class="chtxtbx botxt"><strong>Here are my commands</strong><br>/getlyics - to get the lyrics of a song<br>/getartistbio - to get the bio of an artist<br>/gettopten - to get the top ten songs on the billboard chart</div></div></div>';
					}
				}
			}
			xmlHttp.send("action=botaction&data="+msg);
	}
	else{
		setTimeout(function(){declineall()},1000);
		}
	}
}