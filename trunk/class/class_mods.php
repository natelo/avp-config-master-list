<?php
/*
 * List mods.
 * 
 * List selected mods.
 * NOTE: Most of the stuff is hardcoded as i have no intentions to create a full blown CMS...
 * If that's your desire, then you'll have to dynamically parse variables from DB in routing etc..
 * 
 */

class mods extends db {
	
	# Protocol sorter 
	private function sort_prot($protocol=false) {
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
	
	# Routing
	public function print_label($handle=false) {
		$URI = !empty($_GET['a']) ? $_GET['a'] : NULL;
		$found = false;
		
		if ($URI != NULL) 
			switch ($URI) {
				case "AvPMOD-2.0":
					if (!$handle)
						$print = "AvPMOD Config Generator :: AvPMOD 2.0";
					$found = true;
				break;
				case "AvPMOD-1.4":
					if (!$handle)
						$print = "AvPMOD Config Generator :: AvPMOD 1.4";
					$found = true;
					break;
				case "AvPMOD-1.3":
					if (!$handle)
						$print = "AvPMOD Config Generator :: AvPMOD 1.3";
					$found = true;
				break;
				case "AvPMOD-1.2":
					if (!$handle)
						$print = "AvPMOD Config Generator :: AvPMOD 1.2";
					$found = true;
				break;		
				case "server-browser":						
					if (!$handle)
						$print = "Master Server List" . $this->sort_prot();
					$found = true;
					break;
				case "server":
					if (empty($_GET['b']))
						return header('location: /home');					
					else						
					return "Master Server List :: Server info";
				break; 	
				default:
					$found = false;
				break;
			}
		else
			return "Main page";
		
		# If not found redirect to default (home) page.
		if (!$found)
			header('location: /home');
		
		if (!$handle)
			return $print;
		else
			return $found;
	}
	
	# Admin's/Player's commands list
	private function cmds_list($type="0") {		
		
		# Url is false, die out..
		if ($this->print_label(true) == false)
			return;
	
		$url = $this->clean($_GET['a']);
			
		# Sql
		$sql = "SELECT cmname, cmabout FROM ".TBL_CMDS." WHERE cmmod='".$url."' AND cmtype='".$type."' ORDER BY cmname ASC";	
		
		# Query it
		$this->mysql();
		$this->clean($sql);
		$query = mysql_query($sql);
		
		# Print the list now		
		echo '<div class="listcmds">';

			while ($fetch = mysql_fetch_array($query)) {				
				
					echo '<div class="help" title="'.$fetch['cmabout'].'">'.$fetch['cmname'].'</div>';
			}
			
		echo '</div>';	
	
		mysql_free_result($query);
	return;
	}
	
	# Sort cvars
	private function sort_cvars($type, $prefix, $cvar, $value, $help, $extra="", $array="") {
		# Cmds list
		$list = "";
			$cmds = "";
				$cmds_size = "";
		
		# Integer
		if ($type==1)
			echo '<div class="config_row">
					<label><b>'.$cvar.':</b> <small>(<i class="help" title="'.$help.'">?</i>)</small></label>
					<span class="right"><input type="checkbox" name="'.$cvar.'" value="'.$value.'" class="config_size" '.$extra.'/></span> 
					</div>';
		
		# Check if it's a commands list..
		$cmds = ($type==2 && $extra==1) ? true : false;
	
		# Build the list
		if ($cmds) {
			# List is 0 (or "")for admins...players are 1 but we don't have that yet...	
			$list = $this->cmds_list();
				$css = " cmds";
					$cmds_size = ' maxlength="236"';
		}
		
		# String
		if ($type==2)
			echo '<div class="config_row">
				  <label><b>'.$cvar.':</b> <small>(<i class="help" title="'.$help.'">?</i>)</small></label>
				  <span class="right"><input type="text" name="'.$cvar.'" value="'.$value.'" class="config_size'.$css.'" id="searchfield" title="searchfield" onfocus="clearText(this)" onblur="clearText(this)"'.$cmds_size.'/></span> 
				  </div>' . $list;
		# Options
		if ($type==0) {
			echo '<label><b>'.$cvar.':</b> <small>(<i class="help" title="'.$help.'">?</i>)</small></label>
					<span class="right">
					<select name="'.$cvar.'">'; 
						# Loop options
						foreach ( explode(",",$array) as $option) {	
							# Set default value
							$default = ($option == $value) ? 'selected="selected"': "";	
							# List options now
							echo '<option value="'.$option.'" '.$default.'>'.$option.'</option>';
						}
			echo	 '</select>
			 	  </span><br class="clearit"/>';
		}	
	}
	
	# Load mod that's set
	public function load_mod($mod, $type) {
		
		# Before doing anything, even check if there's a match...
		if ($this->print_label(true) == false) {
			echo "<h3><center>Page you are looking for doesn't exists...</center></h3>";
		return;
		}			
		
		# Sql
		$sql = "SELECT cprefix, cname, cvalue, cvalue_ext, cgroup, ccomments, ctype, cextra FROM ".TBL_CVARS." WHERE cmod='".$mod."' ORDER BY cid ASC";
	
		# Query it
		$this->mysql();	
			$this->clean($sql);
				$query = mysql_query($sql);			
	
		# This will get ugly...
		while ($fetch = mysql_fetch_array($query)) {	
					
			# Sort to correct group
			if ($fetch['cgroup'] == $type) {
				
				$checked = ($fetch['ctype'] == 1 && $fetch['cvalue'] == 1) ? 'checked' : "";
				
				# String
				if ($fetch['ctype'] == 2)
					$this->sort_cvars(2, $fetch['cprefix'], $fetch['cname'], $fetch['cvalue'], $this->clean_output($fetch['ccomments']), $fetch['cextra']);
				# Integer
				else if ($fetch['ctype'] == 1)
					$this->sort_cvars(1, $fetch['cprefix'], $fetch['cname'], $fetch['cvalue'], $this->clean_output($fetch['ccomments']), $checked);
				# Select			
				else if ($fetch['ctype'] == 0) 
					$this->sort_cvars(0, $fetch['cprefix'], $fetch['cname'], $fetch['cvalue'], $this->clean_output($fetch['ccomments']), "", $fetch['cvalue_ext']);
			}
			
		}	
		
		# Free memory
		$this->free_memory($query);
	}		
}