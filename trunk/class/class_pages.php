<?php
/*
 * Pages
 * 
 * Sort and load correct pages.  
 * 
 */


class pages {
	
	# Protocol sorter
	private function sort_protocol($protocol=false) {
		$ver = (empty($_GET['b'])) ? false : explode('-', $_GET['b']);
	
		if (!$protocol) {
			# Fix prints
			if ($ver[1] == "56") $ver = "Demo servers list";
			else if ($ver[1] == "57") $ver = "RtcW 1.0 servers list";
			else if ($ver[1] == "58") $ver = "RtcW 1.3 servers list";
			else if ($ver[1] == "60") $ver = "RtcW 1.4 servers list";
			else if ($ver[1] == "62") $ver = "wolfX servers list";
			else $ver = false;
		} # Set it for query
		else {
		# Fix prints
		if ($ver[1] == "56") $ver = "56";
		else if ($ver[1] == "57") $ver = "57";
		else if ($ver[1] == "58") $ver = "58";
		else if ($ver[1] == "60") $ver = "60";
		else if ($ver[1] == "62") $ver = "62";
		else $ver = "57"; # We always start with 1.0 master list.
		}
			
		# Set it now
		if (!$protocol)
			$prot = empty($ver) ? "" : " :: " . $ver;
		else
			$prot = empty($ver) ? "57" : $ver;
	
		return $prot;
	}
	
	# Get page..
	public function get_page($page) {
		# Main page
		if (empty($page)) {			
			# Default page..
			echo "<h2>Rtcw Master Server Browser and AvPMOD Config Creator.</h2>
				  Use side menu to navigate to desirable page...<br /><br />  
				<h3>Brief info</h3>
				Was a little bored and had this idea for a while so I decided to create it...
				If you found any bugs please report them on <a href='http://rtcwx.com'>rtcwx.com</a>.<br /><br />
				<h3>AvPMOD Config generator:</h3>
				I was planning to create this for years now.. I finally find some time (and will) to do it. Now you can configure 
				the mod the way you like it and stop bugging me how it's done...:) I made sure all the settings are up to date for every version,
				so pick your version and set whatever you want, the way you want. There's brief info available for each command so use it, or read the full 
				version on <a href='http://avpwiki.rtcwx.com'>AvPMOD wiki</a>. I'll make sure that list is always up to date with actual version. Older versions are not longer 
				supported and are here only for legacy - it's advised you move to latest version in case if you run older version's still, as most of known bugs have been fixed 
				as well as new functions added. 
				<h3>Master Server Browser:</h3>
				Master browser grabs info directly from master server, so it's always actual and up to date.<br />  
				Pick the version you want to query and simply click on a server to get list of players and all the server info..<br /><br />  				
				<b>NOTE:</b> I do know some servers don't get listed on master list and I'm looking into it (kinda). ;)<br /><br />
				<h3>Note for lamers:</h3>
				Anyone trying to rip this template is facing a lawsuit..<br />Basic framework and layout of this template is done by me but is also licensed under a company I work for occasionally...
				I as author have the right to use it but currently cannot distribute it as I given away the license in another project it was initually used..
				so if you're stealing it I wont care much but company I work for may, so don't say I didn't warn you..<br />
				In case if license becomes obsolete I may release whole script under GPL if there's interest..<br /><br />
				<h3>Credits:</h3>
				All the work on this site - code and styling was done by me from top to bottom. But some of the work is derived from other sources:<br /><br /> 
				<i>Side menu and page basic styling derived from: <a href='http://sprawsm.com/uni-form/'>UniForm by Dragan Babic</a></i><br />
				<i>Idea and snippets for Rtcw master list: <a href='http://wolfmp.info'>wolfmp.info</a></i><br />
				<i>jQuery plugins used: <a href='http://www.dfc-e.com/metiers/multimedia/opensource/jqtransform/'>jqTransform</a>, <a href='http://code.drewwilson.com/entry/tiptip-jquery-plugin'>TipTip</a></i><br /><br />
				I claim no credits for their work, as they belong to original authors. <br /><br />
				
				<i>Nate a.k.a. 'L0,</i>
				";	
		} else if ($page == 'server-browser' && empty($_GET['b'])) {
			# Master list
			$master = new masterlist();
			
			echo $master->show_masterlist(57);
		# Version handler and server browser	
		} else if ($page == 'server-browser' && !empty($_GET['b'])) {
				# Master list
				$master = new masterlist();		
			
				echo $master->show_masterlist($this->sort_protocol(true));
		# Server info
		} else if ($page == 'server' && !empty($_GET['b'])) {		
			$master = new masterlist();	
			
			$master->server_info($_GET['b']);
		
		} else if (!empty($page) ) {
			$mods = new mods();
			
			# Kinda lame but at least we don't print form on each page..
			echo '<form class="jqtransform" action="'.ROOT_DIR.'generate.php" method="post">
				  <fieldset class="config_title">';	
			
			# Get label so we can print it in cfg..
			echo '<input type="hidden" name="version" value="'.$mods->print_label().'" />';		
			
			# Get the cvars
			echo '<h3>Admin settings</h3>';
				if (!empty($_GET['a'])) echo $mods->load_mod($_GET['a'], "Admins");
			echo '<small><i>More info available on our <a href="http://avpwiki.rtcwx.com">Wiki</a>!</i></small>';
			echo '<h3>Server Bot system (SB)</h3>';
				if (!empty($_GET['a'])) echo $mods->load_mod($_GET['a'], "ServerBot");
			echo '<small><i>More info available on our <a href="http://avpwiki.rtcwx.com">Wiki</a>!</i></small>';
			echo '	<h3>Eye Candy</h3>';
				if (!empty($_GET['a'])) echo $mods->load_mod($_GET['a'], "EyeCandy");
			echo '<small><i>More info available on our <a href="http://avpwiki.rtcwx.com">Wiki</a>!</i></small>';
			echo '	<h3>Message of the day (MOTDs)</h3>';
				if (!empty($_GET['a'])) echo $mods->load_mod($_GET['a'], "Motds", "cvalue"); 
			echo '<small><i>More info available on our <a href="http://avpwiki.rtcwx.com">Wiki</a>!</i></small>';
			echo '	<h3>General settings</h3>';
				if (!empty($_GET['a'])) echo $mods->load_mod($_GET['a'], "General");
			echo '<small><i>More info available on our <a href="http://avpwiki.rtcwx.com">Wiki</a>!</i></small>';
			echo '	<h3>Weapon settings</h3>';
				if (!empty($_GET['a'])) echo $mods->load_mod($_GET['a'], "Weapons");
			echo '<small><i>More info available on our <a href="http://avpwiki.rtcwx.com">Wiki</a>!</i></small>';
				
			echo '<h3>Config properties</h3>
			      <div class="config_row">
				  <label><b>Config name:</b> <small>(<i class="help" title="Name of config that is going to be created. <br /><b>NOTE:</b> Full name with extension is required!">?</i>)</small></label>
				  <span class="right"><input type="text" name="cfg" value="avpmod.cfg" class="config_size" /></span>
				  </div>';

			# Rest of the form...	
			echo '<br class="clearit" />
			 		<input type="reset" value="Reset" name="Reset" />    	
			    	<input type="submit" value="Create config" name="submit" /> 			    	
					<br class="clearit" />					
					<small><i>More info available on our <a href="http://avpwiki.rtcwx.com">Wiki</a>!</i></small>		
			      </fieldset>	
			    </form>';
		} 		
	}
	
	# Check labels
	public function check_label() {
		$mods = new mods();
		
		# Print form label now...
		echo $mods->print_label();
	}	
	
	
}