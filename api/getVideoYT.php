<?php
	include_once('../cmr/config/database.php');
	include_once('../cmr/config/settings.php');
	include_once('../cmr/config/classes.php');
	
  
ob_start();// if not, some servers will show this php warning: header is already set in line 46...

$videoReturn = new stdClass();
$videoReturn->error = true;
$videoReturn->id = 0;
$videoReturn->ref = '';
$videoReturn->title = '';
$videoReturn->thumbnail = '';
$videoReturn->videos = array();
$videoReturn->message = '';
$videoReturn->messages = array();

if(isset($_REQUEST['videoid'])) {
	$my_id = $_REQUEST['videoid'];
	if( preg_match('/^https:\/\/w{3}?.youtube.com\//', $my_id) ){
		$url   = parse_url($my_id);
		$my_id = NULL;
		if( is_array($url) && count($url)>0 && isset($url['query']) && !empty($url['query']) ){
			$parts = explode('&',$url['query']);
			if( is_array($parts) && count($parts) > 0 ){
				foreach( $parts as $p ){
					$pattern = '/^v\=/';
					if( preg_match($pattern, $p) ){
						$my_id = preg_replace($pattern,'',$p);
						break;
					}
				}
			}
			if( !$my_id ){
				echo '<p>No video id passed in</p>';
				exit;
			}
		}else{
			echo '<p>Invalid url</p>';
			exit;
		}
	}elseif( preg_match('/^https?:\/\/youtu.be/', $my_id) ) {
		$url   = parse_url($my_id);
		$my_id = NULL;
		$my_id = preg_replace('/^\//', '', $url['path']);
	}
} else {
	echo '<p>No video id passed in</p>';
	exit;
}

if(isset($_REQUEST['type'])) {
	$my_type =  $_REQUEST['type'];
} else {
	$my_type = 'Download';
}


/* First get the video info page for this video id */
//$my_video_info = 'http://www.youtube.com/get_video_info?&video_id='. $my_id;
$my_video_info = 'http://www.youtube.com/get_video_info?&video_id='. $my_id.'&asv=3&el=detailpage&hl=en_US'; //video details fix *1
$my_video_info = curlGet($my_video_info);

/* TODO: Check return from curl for status code */
$thumbnail_url = $title = $url_encoded_fmt_stream_map = $type = $url = '';

parse_str($my_video_info);
if($status=='fail'){
	$videoReturn->message = 'Error in video ID.';
	$videoReturn->messages[] = 'Error in video ID.';
}
else{
	switch($config['ThumbnailImageMode'])
	{
	  case 2: $videoReturn->thumbnail = '/api/yt/getimage.php?videoid='. $my_id .'&sz=hd'; break;
	  case 1: $videoReturn->thumbnail = '/api/yt/getimage.php?videoid='. $my_id .'&sz=hd'; break;
	  case 0:  default:  // nothing
	}
	$my_title = $videoReturn->title = $title;
	$videoReturn->ref = $my_id;
	$cleanedtitle = clean($title);

	if(isset($url_encoded_fmt_stream_map)) {
		/* Now get the url_encoded_fmt_stream_map, and explode on comma */
		$my_formats_array = explode(',',$url_encoded_fmt_stream_map);
		if($debug) {
			if($config['multipleIPs'] === true) {
				$videoReturn->messages[] = ($outgoing_ip);
			}
			$videoReturn->messages[] = ($my_formats_array);
		}
	} else {
		$videoReturn->messages[] = 'No encoded format stream found.';
		$videoReturn->messages[] = 'Here is what we got from YouTube:';
		$videoReturn->messages[] = $my_video_info;
	}
	if (count($my_formats_array) == 0) {
		$videoReturn->messages[] = 'No format stream map found - was the video id correct?';
	}
	else{
		
		/* create an array of available download formats */
		$avail_formats[] = '';
		$i = 0;
		$ipbits = $ip = $itag = $sig = $quality = '';
		$expire = time();

		foreach($my_formats_array as $format) {
			parse_str($format);
			$avail_formats[$i]['itag'] = $itag;
			$avail_formats[$i]['quality'] = $quality;
			$type = explode(';',$type);
			$avail_formats[$i]['type'] = $type[0];
			$avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
			parse_str(urldecode($url));
			$avail_formats[$i]['expires'] = date("G:i:s T", $expire);
			$avail_formats[$i]['ipbits'] = $ipbits;
			$avail_formats[$i]['ip'] = $ip;
			$i++;
		}

		if ($debug) {
			$videoReturn->messages[] = 'These links will expire at '. $avail_formats[0]['expires'];
			$videoReturn->messages[] = 'The server was at IP address '. $avail_formats[0]['ip'] .' which is an '. $avail_formats[0]['ipbits'] .' bit IP address. Note that when 8 bit IP addresses are used, the download links may fail.';
		}
		
		/*
		if(isset($_REQUEST['copy']) && isset($_REQUEST['title']))
		{
			$videoReturn->title = (string) $_REQUEST['title'];
		}*/
			
			
		if ($my_type == 'Download') {
			/* now that we have the array, print the options */
			for ($i = 0; $i < count($avail_formats); $i++) {
				$avail_formats[$i]['ref'] = $my_id;
				$avail_formats[$i]['title'] = $videoReturn->title;
				$avail_formats[$i]['poster'] = $videoReturn->thumbnail;
				$avail_formats[$i]['thumb'] = $videoReturn->thumbnail;
				$avail_formats[$i]['extension'] = formatVideo($avail_formats[$i]['type']);
				$avail_formats[$i]['size'] = get_size($avail_formats[$i]['url']);
				$avail_formats[$i]['sizem'] = formatBytes(get_size($avail_formats[$i]['url']));
				$avail_formats[$i]['copy'] = false;
				
				$clean_title = clean($videoReturn->title);
				$clean_ref = clean($my_id);
				$clean_quality = clean($avail_formats[$i]['quality']);
				
				if($config['VideoLinkMode']=='direct'||$config['VideoLinkMode']=='both'){
					$directlink = explode('.googlevideo.com/',$avail_formats[$i]['url']);
					$directlink = 'https://redirector.googlevideo.com/' . $directlink[1] . '';
					# echo '<a href="' . $directlink . '&title='.$cleanedtitle.'" class="mime">' . $avail_formats[$i]['type'] . '</a> ';
				  
					$avail_formats[$i]['directlink'] = $directlink . '&title='.$cleanedtitle;
					
					
					$titleFile = "{$clean_ref}-{$clean_quality}-{$clean_title}.{$avail_formats[$i]['extension']}";
					
					$avail_formats[$i]['remote_file_url'] = $avail_formats[$i]['directlink'];
					$avail_formats[$i]['local_file'] = $_SERVER['DOCUMENT_ROOT'] . "/" . videos_folder_name . "/{$titleFile}";
					
					$remote_file_url = $avail_formats[$i]['directlink'];
					$local_file = $_SERVER['DOCUMENT_ROOT'] . "/" . videos_folder_name . "/{$titleFile}";
					$avail_formats[$i]['file'] = "/" . videos_folder_name . "/{$titleFile}";
					
					if (file_exists($local_file))
					{
						# echo 'No upload, exist!';
				
						$params = new stdClass();
						$params->ref = $videoReturn->ref;
						$params->title = $videoReturn->title;
						$params->thumb = $videoReturn->thumbnail;
						$params->videos = array($avail_formats[$i]);
						$new = new VideoYT($params);
						$videoReturn->id = $new->id;
						$avail_formats[$i]['copy'] = true;
					}
					else
					{
						if(isset($_REQUEST['copy'])) {
							$copy = copy( $remote_file_url, $local_file );
							if( !$copy ) {
								# echo "Doh! failed to copy $file...\n";	
								$avail_formats[$i]['copy'] = false;
							}
							else{
								# echo "WOOT! success to copy $file...\n";
								
								$params = new stdClass();
								$params->ref = $videoReturn->ref;
								$params->title = $videoReturn->title;
								$params->thumb = $videoReturn->thumbnail;
								$params->videos = array($avail_formats[$i]);
								$new = new VideoYT($params);
								$videoReturn->id = $new->id;
								$avail_formats[$i]['copy'] = true;
								
							}
						}
					}
					
				}
				
				if($config['VideoLinkMode']=='proxy'||$config['VideoLinkMode']=='both')
					# echo ' / ' . '<a href="download.php?mime=' . $avail_formats[$i]['type'] .'&title='. urlencode($my_title) .'&token='.base64_encode($avail_formats[$i]['url']) . '" class="dl">download</a>';
					
					/*
					$directlink = "download.php?mime={$avail_formats[$i]['type']}&title=". urlencode($my_title) ."&token=".base64_encode($avail_formats[$i]['url']);
					$typeClean = clean($avail_formats[$i]['type']);
					$urlVideo = $_SERVER['DOCUMENT_ROOT'] . "/videos/{$cleanedtitle}-{$typeClean}";
					file_put_contents($urlVideo, fopen($directlink, 'r'));
					*/
					
					$avail_formats[$i]['proxylink'] = 'download.php?mime=' . $avail_formats[$i]['type'] .'&title='. urlencode($my_title) .'&token='.base64_encode($avail_formats[$i]['url']);
					# formatBytes(get_size($avail_formats[$i]['url']))
					
				$videoReturn->videos[] = $avail_formats[$i];
			}
			
			foreach($videoReturn->videos as $item)
			{
				if($item['size'] > 0 && $videoReturn->error == true)
				{
					$videoReturn->error = false;
				}
			}
			
		}
		else {

			/* In this else, the request didn't come from a form but from something else
			 * like an RSS feed.
			 * As a result, we just want to return the best format, which depends on what
			 * the user provided in the url.
			 * If they provided "format=best" we just use the largest.
			 * If they provided "format=free" we provide the best non-flash version
			 * If they provided "format=ipad" we pull the best MP4 version
			 *
			 * Thanks to the python based youtube-dl for info on the formats
			 *   							http://rg3.github.com/youtube-dl/
			 */

			$format =  $_REQUEST['format'];
			$target_formats = '';
			switch ($format) {
				case "best":
					/* largest formats first */
					$target_formats = array('38', '37', '46', '22', '45', '35', '44', '34', '18', '43', '6', '5', '17', '13');
					break;
				case "free":
					/* Here we include WebM but prefer it over FLV */
					$target_formats = array('38', '46', '37', '45', '22', '44', '35', '43', '34', '18', '6', '5', '17', '13');
					break;
				case "ipad":
					/* here we leave out WebM video and FLV - looking for MP4 */
					$target_formats = array('37','22','18','17');
					break;
				default:
					/* If they passed in a number use it */
					if (is_numeric($format)) {
						$target_formats[] = $format;
					} else {
						$target_formats = array('38', '37', '46', '22', '45', '35', '44', '34', '18', '43', '6', '5', '17', '13');
					}
				break;
			}

			/* Now we need to find our best format in the list of available formats */
			$best_format = '';
			for ($i=0; $i < count($target_formats); $i++) {
				for ($j=0; $j < count ($avail_formats); $j++) {
					if($target_formats[$i] == $avail_formats[$j]['itag']) {
						//echo '<p>Target format found, it is '. $avail_formats[$j]['itag'] .'</p>';
						$best_format = $j;
						break 2;
					}
				}
			}

			//echo '<p>Out of loop, best_format is '. $best_format .'</p>';
			if( (isset($best_format)) && 
			  (isset($avail_formats[$best_format]['url'])) && 
			  (isset($avail_formats[$best_format]['type'])) 
			  ) {
				$redirect_url = $avail_formats[$best_format]['url'].'&title='.$cleanedtitle;
				$content_type = $avail_formats[$best_format]['type'];
			}
			if(isset($redirect_url)) {
				header("Location: $redirect_url"); 
			}

		} // end of else for type not being Download
		// *1 = thanks to amit kumar @ bloggertale.com for sharing the fix
		
	}
}


#FINAL
header('Content-Type: application/json');
echo json_encode($videoReturn,JSON_PRETTY_PRINT);
return json_encode($videoReturn,JSON_PRETTY_PRINT);