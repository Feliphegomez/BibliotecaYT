<!-- <link href="<?php echo path_homeTheme; ?>css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
<!-- Custom Theme files -->
<link href="<?php echo path_homeTheme; ?>css/style.css" rel='stylesheet' type='text/css' />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- <script type="text/javascript" src="<?php echo path_homeTheme; ?>js/jquery-1.11.1.min.js"></script> -->
<script type="text/javascript" src="<?php echo path_homeTheme; ?>js/login.js"></script>
<script src="<?php echo path_homeTheme; ?>js/jquery.easydropdown.js"></script>
<!--Animation-->
<script src="<?php echo path_homeTheme; ?>js/wow.min.js"></script>
<link href="<?php echo path_homeTheme; ?>css/animate.css" rel='stylesheet' type='text/css' />
<script>
	new WOW().init();
</script>

<link href="<?php echo path_homeLibs; ?>jPlayer-2.9.2/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
<!-- <script type="text/javascript" src="<?php echo path_homeLibs; ?>jPlayer-2.9.2/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo path_homeLibs; ?>jPlayer-2.9.2/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo path_homeLibs; ?>jPlayer-2.9.2/add-on/jplayer.playlist.min.js"></script>

<link rel="stylesheet" href="<?php echo path_homeLibs; ?>treeview/css/bootstrap-treeview.css" crossorigin="anonymous">
<script type="text/javascript" src="<?php echo path_homeLibs; ?>treeview/js/bootstrap-treeview.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

			
<script>
function downVideoYT(inputId){
	var newval = '';
	var newval2 = '';
	
	var myregexp = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i;
	var search = [];
	search = $("#" + inputId).val().match(myregexp);
	
	if(search != null && search[1].length > 10)
	{
		newval2 = search[1];
		console.log(newval2);
		// location.replace('/create:video/youtube/#/' + newval2);
		// location.reload();
		window.location.replace('/create:video/youtube/#/' + newval2);
	}else{
		alert('La URL no es valida.');
	}	
}
</script>