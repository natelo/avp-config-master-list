<?php
/*
 * Master list
 * 
 * Class for main page server master list.
 * 
 */


class masterlist {
	
	/*
	 * Fix the colors
	*/
	public function parse_colors($text) {
	
		# Clear garbage
		$text = preg_replace('/[^\r\n\t\x20-\x7E\xA0-\xFF]/', '', trim($text));
		
		# load first set..
		$switch = 1;
	
		# Check if there's a color..
		if (substr_count($text, '^')>0) {
		
		  $clr = array ( // colors
	        "\"#000000\"", "\"#DA0120\"", "\"#00B906\"", "\"#E8FF19\"", //  1
	        "\"#170BDB\"", "\"#23C2C6\"", "\"#E201DB\"", "\"#FFFFFF\"", //  2
	        "\"#CA7C27\"", "\"#757575\"", "\"#EB9F53\"", "\"#106F59\"", //  3
	        "\"#5A134F\"", "\"#035AFF\"", "\"#681EA7\"", "\"#5097C1\"", //  4
	        "\"#BEDAC4\"", "\"#024D2C\"", "\"#7D081B\"", "\"#90243E\"", //  5
	        "\"#743313\"", "\"#A7905E\"", "\"#555C26\"", "\"#AEAC97\"", //  6
	        "\"#C0BF7F\"", "\"#000000\"", "\"#DA0120\"", "\"#00B906\"", //  7
	        "\"#E8FF19\"", "\"#170BDB\"", "\"#23C2C6\"", "\"#E201DB\"", //  8
	        "\"#FFFFFF\"", "\"#CA7C27\"", "\"#757575\"", "\"#CC8034\"", //  9
	        "\"#DBDF70\"", "\"#BBBBBB\"", "\"#747228\"", "\"#993400\"", // 10
	        "\"#670504\"", "\"#623307\""                                // 11
          );

	        if ($switch == 1)
	        { // colored string
	            $search  = array (
	            "/\^0/", "/\^1/", "/\^2/", "/\^3/",        //  1
	            "/\^4/", "/\^5/", "/\^6/", "/\^7/",        //  2
	            "/\^8/", "/\^9/", "/\^a/", "/\^b/",        //  3
	            "/\^c/", "/\^d/", "/\^e/", "/\^f/",        //  4
	            "/\^g/", "/\^h/", "/\^i/", "/\^j/",        //  5
	            "/\^k/", "/\^l/", "/\^m/", "/\^n/",        //  6
	            "/\^o/", "/\^p/", "/\^q/", "/\^r/",        //  7
	            "/\^s/", "/\^t/", "/\^u/", "/\^v/",        //  8
	            "/\^w/", "/\^x/", "/\^y/", "/\^z/",        //  9
	            "/\^\//", "/\^\*/", "/\^\-/", "/\^\+/",    // 10
	            "/\^\?/", "/\^\@/", "/\^</", "/\^>/",      // 11
	            "/\^\&/", "/\^\)/", "/\^\(/", "/\^[A-Z]/", // 12
	            "/\^\_/",                                  // 14
	            "/&</", "/^(.*?)<\/font>/"                 // 15
	            );
	
	            $replace = array (
	            "&<font color=$clr[0]>", "&<font color=$clr[1]>",   //  1
	            "&<font color=$clr[2]>", "&<font color=$clr[3]>",   //  2
	            "&<font color=$clr[4]>", "&<font color=$clr[5]>",   //  3
	            "&<font color=$clr[6]>", "&<font color=$clr[7]>",   //  4
	            "&<font color=$clr[8]>", "&<font color=$clr[9]>",   //  5
	            "&<font color=$clr[10]>", "&<font color=$clr[11]>", //  6
	            "&<font color=$clr[12]>", "&<font color=$clr[13]>", //  7
	            "&<font color=$clr[14]>", "&<font color=$clr[15]>", //  8
	            "&<font color=$clr[16]>", "&<font color=$clr[17]>", //  9
	            "&<font color=$clr[18]>", "&<font color=$clr[19]>", // 10
	            "&<font color=$clr[20]>", "&<font color=$clr[21]>", // 11
	            "&<font color=$clr[22]>", "&<font color=$clr[23]>", // 12
	            "&<font color=$clr[24]>", "&<font color=$clr[25]>", // 13
	            "&<font color=$clr[26]>", "&<font color=$clr[27]>", // 14
	            "&<font color=$clr[28]>", "&<font color=$clr[29]>", // 15
	            "&<font color=$clr[30]>", "&<font color=$clr[31]>", // 16
	            "&<font color=$clr[32]>", "&<font color=$clr[33]>", // 17
	            "&<font color=$clr[34]>", "&<font color=$clr[35]>", // 18
	            "&<font color=$clr[36]>", "&<font color=$clr[37]>", // 19
	            "&<font color=$clr[38]>", "&<font color=$clr[39]>", // 20
	            "&<font color=$clr[40]>", "&<font color=$clr[41]>", // 21
	            "", "", "", "", "", "",                             // 22
	            "", "</font><", "\$1"                               // 23
	            );
	
	            $ctext = preg_replace($search, $replace, $text);
	
	            if ($ctext != $text)
	            {
	                $ctext = preg_replace("/$/", "</font>", $ctext);
	            }
	
	            return trim($ctext);
	        }
	        elseif ($switch == 2)
	        { // colored numbers
	            if ($text <= 39)
	            {
	                $ctext = "<font color=$clr[7]>$text</font>";
	            }
	            elseif ($text <= 69)
	            {
	                $ctext = "<font color=$clr[5]>$text</font>";
	            }
	            elseif ($text <= 129)
	            {
	                $ctext = "<font color=$clr[8]>$text</font>";
	            }
	            elseif ($text <= 399)
	            {
	                $ctext = "<font color=$clr[9]>$text</font>";
	            }
	            else
	            {
	                $ctext = "<font color=$clr[1]>$text</font>";
	            }
	
	            return trim($ctext);
	        }
		}
		# no color so just return ..
		else {
			return trim($text);
		} 
	}
	
	/*
	 * Open socket
	 */
	private function open_socket($host, $port, $ver) {
				 
		$socket=fsockopen($host, $port, $errno, $errstr, 3);

		# Connect
		if (!$socket) {
			die("Unable to create socket: ".$host.":".$port." $errstr<br />");
		} else {
			fwrite($socket, "\xFF\xFF\xFF\xFFgetservers ".$ver." empty full");
			stream_set_timeout($socket, 2);
			$data=fread($socket, 4096);
			fclose($socket);
		}
		
		# Set data
		$data = explode("\\", $data);
		 
		for($i=0, $o=0; $i<count($data); $i++) {
			if (strlen($data[$i])>=4) { 
				 
				// First 4 bytes are the ip:
				$list_server[$o]['ip']=ord($data[$i][0]).".".ord($data[$i][1]).".".ord($data[$i][2]).".".ord($data[$i][3]);
				 
				// Last 2 bytes are the port, Takes penultimate number and multiply by 256 and sum with the last number:
				$list_server[$o]['port']=(ord($data[$i][4])*256) + ord($data[$i][5]);
				 
				$o++;
			}
		}
		 
		# Distribute data
		foreach ($list_server AS $info) {
			 
			$host = "udp://" . $info['ip']; // udp://ipserver
			$port = $info['port'];			
			
			$skip_ips = array('255.255.255.255', '69.64.76.211'); 
			if (!in_array($info['ip'], $skip_ips) && !empty($info['ip']) && (int)substr($info['port'], 0, 1)==2) {
				$fp = fsockopen($host, $port, $errno, $errstr, 1);
				 
				if (!$fp) {
					echo "<h3><center>Failed to contact master server or server may be unreachable.</h3></center>";
				return;
				}
				else {
					fwrite($fp, "\xFF\xFF\xFF\xFFgetinfo");
					stream_set_timeout($fp, 2);
					$data = fread($fp, 350);					
					fclose($fp);
					 
				}				
				 
				# Break data
				$serverdata = explode("\n", $data);
				 
				# share infos
				$setting = explode("\\", $serverdata[1]);
				 
				$infoserver = array();
				for ($i=1; $i<count($setting); $i+=2) 
					$infoserver[$setting[$i]] = $setting[$i+1];
				 
				foreach ($infoserver AS $name => $value) {					
					$serverInfo[trim($name)] = trim($value);
				}
				
				switch($serverInfo["gametype"]) {
					case "5":
						$gametype = "wolf mp";
						break;
					case "6":
						$gametype = "wolf sw";
						break;
					case "7":
						$gametype = "wolf cp";
						break;
				}
				
				($serverInfo["punkbuster"]=="1") ? $punkbuster = '<span class="color_green">Yes</span>' : $punkbuster = '<span class="color_red">No</span>';
				$servers[$info['ip'].":".$info['port']] = array (
						"ip" => $info['ip'],
						"port" => $info['port'],
						"protocol" => $serverInfo["protocol"],
						"hostname" => $this->parse_colors($serverInfo["hostname"]),
						"mapname" => preg_replace('/\^([0-9]){1}/', '', $serverInfo["mapname"]),
						"clients" => $serverInfo["clients"],
						"protocol" => $serverInfo["protocol"],
						"maxclients" => $serverInfo["sv_maxclients"],
						"gametype" => $gametype,
						"pure" => $serverInfo["pure"],
						"game" => $serverInfo["game"],
						"sv_allowAnonymous" => $serverInfo["sv_allowAnonymous"],
						"gameskill" => $serverInfo["gameskill"],
						"friendlyFire" => $serverInfo["friendlyFire"],
						"maxlives" => $serverInfo["maxlives"],
						"tourney" => $serverInfo["tourney"],
						"punkbuster" => $punkbuster,
						"ping" => "N/A"
				);
			}
		}
		# Output data		
		return $servers;
	}
	
	/*
	 * Sort data
	 */	
	private function sort_data(array $array, $key, $asc = true) {
	    $result = array();
	       
	    $values = array();
	    foreach ($array as $id => $value) {
	        $values[$id] = isset($value[$key]) ? $value[$key] : '';
	    }
	       
	    if ($asc) {
	        asort($values);
	    }
	    else {
	        arsort($values);
	    }
	       
	    foreach ($values as $key => $value) {
	        $result[$key] = $array[$key];
	    }
	       
	    return $result;
	}	
	
	/*
	 * Show Master list
	 */
	public function show_masterlist($ver="57") {
		# Master URL
		$host="udp://dpmaster.deathmask.net";
		//$host="udp://wolfmaster.s4ndmod.com";
		//$host="udp://82.192.42.115";
			$port=27950;
			
			/*
			 *  $ver = Protocol version
			 *	57 = Rtcw - 1.0
			 * 	58 = Rtcw - 1.3
			 *	59 = Rtcw - 1.33
			 * 	60 = Rtcw - 1.4+
			 *  62 = wolfX - pre-alpha 		
			 */		
			
		$data = $this->open_socket($host, $port, $ver);
		
		// Sort the multidimensional array
		$servers = $this->sort_data($data, 'hostname');		
		
		# Version handler
		echo '<div class="prot_links"><span class="right">
			  	<!-- <a href="/home/server-browser/protocol-56" class="list_links">Rtcw Demo List</a> | -->
			  	<a href="/home/server-browser/" class="list_links">Rtcw 1.0 List</a> |
			  	<!-- <a href="/home/server-browser/protocol-58" class="list_links">Rtcw 1.3 List</a> | -->
			  	<a href="/home/server-browser/protocol-60" class="list_links">Rtcw 1.4 List</a> 
		      </div></span>';
		
		# Title
		echo '<div class="server_list">
				  <div class="server_row_title">
					  <div class="server_hostname_title">Server name</div>
					  <div class="server_map_title">Map</div>
					  <div class="server_players_title">Players</div>
					  <div class="server_ping_title">Ping</div>
					  <div class="server_pb_title">PB</div>
					  <div class="server_ff_title">FF</div>	
					  <div class="server_maxlives_title">DM</div>						 
			  		</div>'; 
			
		foreach ($servers AS $server) {
			
			# Fix unnamed servers..
			$server['hostname'] = !empty($server['hostname']) ? $server['hostname'] : "Unnamed server";
			
			if (!empty($server["mapname"])) {
				
				# Nice prints
				$ff = ($server["friendlyFire"]== 0) ? 'No' : 'Yes';
				$dm = ($server["maxlives"]== 0) ? '<span class="color_red">No</span>'  : '<span class="color_green">Yes</span>';
				
				# Print now
				echo '<div class="server_row">
						<div class="server_hostname"><a href="/home/server/'.$server["ip"] . ":" . $server["port"].'">'.$server['hostname'].'</a></div>
						<div class="server_map">' . $server["mapname"] . '</div>
						<div class="server_players">' . $server["clients"] .' (' . $server["maxclients"] . ')</div>
						<div class="server_ping">' . $server["ping"] . '</div>
						<div class="server_pb">'  . $server["punkbuster"]  . '</div>
						<div class="server_ff">'  . $ff . '</div>	
						<div class="server_maxlives">'  . $dm . '</div>							
					  </div>';
			} 
		}
		# Close the server list..
		echo '</div>';

		# Count the list
		$numServers = count($servers);
		echo '<span class="right">Got ' . $numServers . " servers from master server.</span>";
		
	return;
	}
	
	/*************************** Server info *********************************/
	
	/*
	 * Socket 
	 * 
	 * Open socket and grab info
	 */
	private function info_socket($server, $dataType="1") {		
		$server = explode(":", $server);
		
		# Set vars
		$host="udp://" . $server[0]; 
			$port=$server[1];
		 
	
		# Connect to socket		 
		$fp = fsockopen($host, $port, $errno, $errstr, 20);
		 
		if (!$fp) {
			echo "<h3><center>Could not contact selected server or server may be unreachable.</h3></center>";
		return;
		} else {
			fwrite($fp, "\xFF\xFF\xFF\xFFgetstatus");
				$data = fread($fp, 4096);
					fclose($fp);
		}
		 
		
		# Extract data		
		$serverdata = explode("\n", $data);		
			$setting = explode("\\", $serverdata[1]);

		
		# Loop thru data
		$infoserver = array();
		for ($i=1; $i<count($setting); $i+=2) 
			$infoserver[$setting[$i]] = $setting[$i+1];
		
		# Output data
		if ($dataType == 1)
			return $infoserver;
		else		 
			return $serverdata;
	}
	
	/*
	 * Load correct image for map
	 */
	private function map_image($var) {
		
		# Lowercase..
		$var = strtolower($var);
		
		# Path
		$file = 'images/maps/' . $var.'.jpg';
		
		if (file_exists($file)) {
			return '<img src="/'.$file.'" />';
		} else {
			return '<img src="'.ROOT_DIR.'images/maps/unknown.jpg" />';
		}
	} 
	
	/*
	 * SERVER INFO
	*/
	public function server_info($server) {
		$url = $_GET['b'];
		
		# Grab data
		$data = $this->info_socket($server);
		
		# Sort some stuff
		$pbs = (empty($data['sv_punkbuster']) || $data['sv_punkbuster'] == 0) ? '<span class="color_red">No</span>' : '<span class="color_green">Yes</span>';
		$ff = (empty($data['g_friendlyFire']) || $data['g_friendlyFire'] == 0)? '<span class="color_red">Disabled</span>' : '<span class="color_green">Enabled</span>';
		$img = $this->map_image($data['mapname']); 
		$host = (!$data['sv_hostname']) ? 'Unnamed server' : trim($this->parse_colors($data['sv_hostname']));	
		$game =  (!$data['gamename']) ? $data['GAMENAME'] : $data['gamename'];	
		# Have to do it twice..?!
		$svname = (empty($host)) ? 'Unnamed server' : trim($this->parse_colors($data['sv_hostname']));
		$pb = (!$data['sv_punkbuster']) ? '<span class="color_red">No</span>' : '<span class="color_green">Yes</span>';
		
		//print_r($data); echo '<br /><br />';		
	
		# Print server details now
		echo '<div class="server_info">
				  <div class="server_info_title"><span class="left">Server:</span> '.$svname.' <span class="right"><a href="/home/server/'.$url.'">Refresh page</a></span></div>
				  <div class="server_infodetails">
				  	<ul>				  		
				  		<li><b>Server IP:</b></li>
				  		<li><b>Gamename:</b></li>
				  		<li><b>Slots:</b></li>				  		
				  		<li><b>Friendly Fire:</b></li>
				  		<li><b>PunkBuster:</b></li>
				  		<li class="full_info"><a href="#" id="extra_info">Show full server Info</a></li>
				  	</ul>
				  </div>
				  <div class="server_infodetails_ext">
				  	<ul>				  		
				  		<li>'.$url.'</li>
				  		<li>'.$this->parse_colors($game).'</li>
				  		<li>'.$data['sv_maxclients'].'</li>				  		
				  		<li>'.$ff.'</li>
				  		<li>'.$pb.'</li>	
				  	</ul>
				  </div>
				  <div class="server_infomap">
				  '.$this->parse_colors($data['mapname']).'
				  <br />
				  '.$img.'
				  </div>				  
				  <div class="server_extra">';
				
			# Grab all the data..			
			foreach ($data AS $extra => $key) {
				echo '<div class="extra_data_print"><b>' . $this->parse_colors($extra) . ':</b> ' . $this->parse_colors($key) . '</div>';
			}
		
			echo  '</div>
				  <div class="server_infoplayers">';
		
		$clients = $this->info_socket($server, 0);
		
		# Loop thru players
		$infoplayers=array();
		for($i=2, $a=0; $i<count($clients)-1; $i++) {
			 list($score, $ping, $name)=explode(" ", $clients[$i], 3);
                       
             	$infoplayers[$a]['score']=$score;
                $infoplayers[$a]['ping']=$ping;
                $infoplayers[$a]['name']=substr($name, 1, -1); // remove quotes
                $infoplayers[$a]['clientid']=$i-1;
                $a++;
		}
		
		echo '<div class="clients_title">
			  <div class="clients_id_title">Slot</div><div class="clients_name_title">Player</div><div class="clients_score_title">Score</div><div class="clients_ping_title">Ping</div>			  
			  <br /></div>';
		
		if (!$infoplayers)
			echo 'There are no players on server..';
		else 
			foreach ($infoplayers AS $info) {
				
				echo '<div class="clients_id">' . $info['clientid'] . '</div>
					  <div class="clients_name">' . $this->parse_colors($info['name']) . '</div>
					  <div class="clients_score">' . $info['score'] . '</div>
				      <div class="clients_ping">' . $info['ping'] . '</div><br />';
			}
					
		echo	 '</div>
			  </div>';
	
	}
}