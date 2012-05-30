<?php 
	define("ROOT_LEVEL", true); 
	include 'api.php'; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
<title>AvPMOD Config creator</title>

<!-- META -->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="Author" content="Nate L0" />
<meta name="Description" content="AvPMOD config creator" />
<!-- jQuery -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT_DIR; ?>js/jquery.jqtransform.js"></script>
<script type="text/javascript" src="<?php echo ROOT_DIR; ?>js/load_jqtransform.js"></script>
<script type="text/javascript" src="<?php echo ROOT_DIR; ?>js/load_effects.js"></script>
<script type="text/javascript" src="<?php echo ROOT_DIR; ?>js/jquery.tipTip.minified.js"></script>

<!-- CSS -->
<link href="<?php echo ROOT_DIR; ?>css/global.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8" />
<!--[if IE]>
<link href="<?php echo ROOT_DIR; ?>css/ie.fix.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8" />
<![endif]-->
<script>
$(function(){
	$(".help").tipTip({edgeOffset: 10});
});
</script>
<script>
$(document).ready(function() {	
	$('input.cmds').focus(function(){	 
		$(".listcmds").stop().slideDown("slow");
	});
	$('input.cmds').blur(function(){	
		$(".listcmds").stop().slideUp("normal");
	});		

	$( "#extra_info" ).toggle( 
		function() {
			$( ".server_extra" ).slideDown("normal");
		   		$(this).text($(this).text() == 'Show full server Info' ? 'Hide details' : 'Show full server Info');          	
		return false;   // Stop page jumping
		},
		function() {
			$( ".server_extra" ).slideUp("fast");
				$(this).text($(this).text() == 'Show full server Info' ? 'Hide details' : 'Show full server Info');        	  
		return false;   // Stop page jumping
		});
});
</script>
<script>
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>
</head>

<body>

<div class="top">
<div id="top_nav">  
    <!-- <a href="#" id="selected">Domov</a> -->
    <a href="http://fokkewolf.proboards.com">Home base</a>
    <a href="http://rtcwx.com/index.php/board,30.0.html">Mod Support</a>
    <a href="http://avpwiki.rtcwx.com">AvP Wiki</a>    
</div>
</div>


<!-- BEGIN WRAPPER -->
<div id="wrapper">
  <div class="header">
    <h2><?php echo $pages->check_label(); ?></h2>
    <p>by Nate 'L0,</p>
  </div>
		
		<?php @$pages->get_page($_GET['a']); ?>			
		
		<br class="clearit" />	

</div>
<!-- END OVERVIEW -->
  
<!-- BEGIN MAIN -->
<div id="main">
  

</div>
<!-- END MAIN -->
  

<!-- END WRAPPER -->

<!-- SIDE BROWSER -->
<div class="side_module"> 
  <h2>Jump to</h2>
    <ul> 
      <li><a href="<?php echo ROOT_DIR; ?>home/server-browser" class="side_link">Server Browser</a></li>     
      <li><a href="<?php echo ROOT_DIR; ?>version/AvPMOD-2.0" class="side_link">AvPMOD 2.0</a></li>
      <li><a href="<?php echo ROOT_DIR; ?>version/AvPMOD-1.4" class="side_link">AvPMOD 1.4</a></li> 
      <li><a href="<?php echo ROOT_DIR; ?>version/AvPMOD-1.3" class="side_link">AvPMOD 1.3</a></li>
      <li><a href="<?php echo ROOT_DIR; ?>version/AvPMOD-1.2" class="side_link">AvPMOD 1.2</a></li>
  </ul>
</div>

<!-- BEGIN FOOTER -->

<div id="footer">
<ul>
<li>Made by: <a href="mailto:nate@rtcwx.com">Nate 'L0,</a> &copy; <?php echo date("Y"); ?> - all rights reserved</li>
</ul>
</div>

<!-- END FOOTER -->

</body>
</html>