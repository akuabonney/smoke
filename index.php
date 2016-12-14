<html>
<head>
	<title>muzikiBot</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="js/library/jquery-2.1.1.min.js"></script>
	<script src="js/library/jquery.cycle.all.js"></script>

</head>
<body>
	<div id="welbx" onclick="checkin()" class="animated bounceIn">
		<button id="buttx">Hi..! Check in.</button>
	</div>
	<div id="chatwindowbx">
		<div id="chatareabx" class="animated bounceInRight">
			<div id="cttopbx">
				<div class="closebx" onclick="closeall()">
					<i class="fa fa-remove closex" aria-hidden="true"></i>
				</div>
				<div class="formcnt">
					<div id="treadbx">
						<div class="chtlinebx">
							<div class="botchtbx">
								<div class="chtxtbx botxt">Hi am a muzikiBot</div>
							</div>
						</div>
						<div class="chtlinebx">
							<div class="botchtbx">
								<div class="chtxtbx botxt">
									<strong>Here are my commands</strong><br>
									/getlyics - to get the lyrics of a song<br>
									/getartistbio - to get the bio of an artist<br>
									/gettopten - to get the top ten songs on the billboard chart
								</div>
							</div>
						</div>
					</div>
					<div id="actiontolbx">
						<div class="commandbx">
							<i class="fa fa-lightbulb-o cmdx" aria-hidden="true"></i>
						</div>
						<input type="text" id="textmesg" placeholder="Text goes here...">
						<button id="sendbt" onclick="sendtxt()">
							<i class="fa fa-send" aria-hidden="true"></i>
							Send
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/action.js"></script>
</body>
</html>