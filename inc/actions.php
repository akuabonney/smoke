<?php
session_start();
require 'link.php';
include 'clean.inc';


ini_set('error_reporting', E_ALL);

$key = '281143146:AAG1iDooNW1Z95q4aDi0ISsop7z8JzChxog';
$website = 'https://api.telegram.org/bot'.$key;
$chatId = '303200657';


// $update = file_get_contents($website.'/getupdates');
// //$update = file_get_contents('php://input');
// $update = json_decode($update, TRUE);
// //echo $update;//["result"][0]['message']['message_id'];

// $chatId = '303200657';
// //$chatId = $update["message"]["chat"]["id"];
// //$message = $update["message"]["text"];
// sendMessage($chatId, "testing");

// switch ($message) {
// 	case '/test':
// 		sendMessage($chatId, "testing");
// 		break;
	
// 	default:
// 		sendMessage($chatId, "nothing");
// 		break;
// }




function sendMessage($chatId, $message){
	$url = $GLOBALS['website']."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
	file_get_contents($url);
}

if(isset($_POST['action']) && $_POST['action'] == 'botaction'){
	$msg = clean($link, $_POST['data']);
	if(empty($msg) == true){
		echo "error";
		exit();
	}

	$chkcmd = substr($msg, 0, 1);
	if($chkcmd == '/'){
		$_SESSION['cmd'] = $msg;
		switch ($_SESSION['cmd']) {
			case '/getlyrics':
				// $message = 'Enter the name of the artist and the title of the song. (ie: Seperate them with a comma.)';
				// sendMessage($chatId, $message);
				echo '<div class="chtlinebx">
							<div class="botchtbx">
								<div class="chtxtbx botxt">Enter the name of the artist and the title of the song.<br> <i>ie: Seperate them with a comma.</i></div>
							</div>
						</div>';
						exit();
				break;

			case '/getartistbio':
				// $message = 'Enter the name of the artist.';
				// sendMessage($chatId, $message);
				echo '<div class="chtlinebx">
							<div class="botchtbx">
								<div class="chtxtbx botxt">Enter the name of the artist.</div>
							</div>
						</div>';
						exit();
				break;

			case '/gettopten':
				// $message = 'Enter the genre of music.';
				// sendMessage($chatId, $message);
				echo '<div class="chtlinebx">
							<div class="botchtbx">
								<div class="chtxtbx botxt">Enter the genre of music</div>
							</div>
						</div>';
						exit();
				break;
			
			default:
				echo "error";
				exit();
				break;
		}
	}
	else if(empty($_SESSION['cmd']) == false){
			$_SESSION['data'] = $msg;
			switch ($_SESSION['cmd']) {
				case '/getlyrics':
					$datax = explode(',',$_SESSION['data']);
					$getlyrics = getlyrics($link, $datax[0], $datax[1], $chatId);
					echo $getlyrics;
					break;

				case '/getartistbio':
					$getartistbio = getartistbio($link, $_SESSION['data'], $chatId);
					echo $getartistbio;
					break;

				case '/gettopten':
					$gettopten = gettopten($link, $_SESSION['data'], $chatId);
					echo $gettopten;
					break;
				
				default:
					echo "error";
					exit();
					break;
			}
			exit();
	}
	else{
		echo "error";
		exit();
	}
}



function getlyrics($link, $artist, $title, $chatId){
	$_SESSION['cmd'] = '';

	$g = mysqli_query($link, "SELECT lyrics, album,year FROM lyrics WHERE artistid=(SELECT aid FROM artist WHERE aname LIKE '$artist') AND songtitle LIKE '$title' ");
	$num = mysqli_num_rows($g);
	if($num == 0){
		// $message = 'sorry...Lyrics not found :-(';
		// sendMessage($chatId, $message);
		return '<div class="chtlinebx">
					<div class="botchtbx">
						<div class="chtxtbx botxt">sorry...Lyrics not found :-(</div>
					</div>
				</div>';
	}
	else{
		$gr = mysqli_fetch_assoc($g);
		// $message = 'Artist: '.$artist.'
		// 			Album: '.$gr['album'].'
		// 			Year: '.$gr['year'].'
		// 			'.$gr['lyrics'].'';
		// sendMessage($chatId, $message);
		return '<div class="chtlinebx">
					<div class="botchtbx">
						<div class="chtxtbx botxt">
							Artist: <strong>'.$artist.'</strong><br>
							Title: <strong>'.$title.'</strong><br>
							Album: <strong>'.$gr['album'].'</strong><br>
							Year: <strong>'.$gr['year'].'</strong><br>
							'.$gr['lyrics'].'
						</div>
					</div>
				</div>';
	}
	
}


function getartistbio($link, $artist){
	$_SESSION['cmd'] = '';
	$g = mysqli_query($link, "SELECT bio FROM artist WHERE aname='$artist' ");
	$num = mysqli_num_rows($g);
	if($num == 0){
		// $message = 'sorry...'.$artist.' bio not found :-(';
		// sendMessage($chatId, $message);
		return '<div class="chtlinebx">
					<div class="botchtbx">
						<div class="chtxtbx botxt">sorry...'.$artist.' bio not found :-(</div>
					</div>
				</div>';
	}
	else{
		$gr = mysqli_fetch_assoc($g);
		// $message = 'Artist: '.$artist.'
		// 			Album: '.$gr['album'].'
		// 			Year: '.$gr['year'].'
		// 			'.$gr['lyrics'].'';
		// sendMessage($chatId, $message);
		return '<div class="chtlinebx">
					<div class="botchtbx">
						<div class="chtxtbx botxt">
							Artist: <strong>'.$artist.'</strong><br>
							'.$gr['bio'].'
						</div>
					</div>
				</div>';
	}
}


function gettopten($link, $genre){
	$_SESSION['cmd'] = '';
	return '<div class="chtlinebx">
				<div class="botchtbx">
					<div class="chtxtbx botxt">here is your top ten</div>
				</div>
			</div>';
}
?>