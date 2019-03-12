<?php
setlocale(LC_ALL,"es_CO");
setlocale(LC_MONETARY,"es_CO");

// Set your default timezone
// use this link: http://php.net/manual/en/timezones.php
date_default_timezone_set("America/Bogota");

$list_months = new stdClass();
$list_months->en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$list_months->es = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

$languaje = new stdClass();
$languaje->es = new stdClass();
$languaje->es->mounts = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$languaje->es->actions = new stdClass();
$languaje->es->actions->change = 'Modificando';
$languaje->es->actions->create = 'Creando';
$languaje->es->actions->delete = 'Eliminando';
$languaje->es->actions->view = 'Viendo';

$languaje = new stdClass();
$languaje->en = new stdClass();
$languaje->en->mounts = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$languaje->en->actions = new stdClass();
$languaje->en->actions->change = 'Modificando';
$languaje->en->actions->create = 'Creando';
$languaje->en->actions->delete = 'Eliminando';
$languaje->en->actions->view = 'Viendo';

define('title_sm', 'APM');
define('title_md', 'Base Aplicacion');
define('title_lg', 'Base de Aplicacion Multi Lenguaje');
define('pageDescription', 'Base de Aplicacion en PHP, Vue, Axios, jQuery y Bootstrap');

define('theme_active', 'default');
define('theme_active_selectDefault', 'default');
define('theme_active_admin', 'default');

define('path_home', '/');
define('path_homeAdmins', path_home.'/front-admin/');
define('path_homeThemeAdmin', path_home.'cmr/content/themes/'.theme_active_admin.'/');
define('path_homeLibs', path_home.'cmr/includes/libs/');
define('path_homeGlobalInc', path_home.'cmr/includes/');
define('path_homeTheme', path_home.'cmr/content/themes/'.theme_active.'/');

define('path_homeClients', path_home.'');

# define('MODE_DEBUG', true);
 define('MODE_DEBUG', false);
define('DEBUG_SESSION', false);
define('DEBUG_SITE', true);

define('videos_folder', '/web/wuaifai.com/public_html/videos_html');
define('videos_folder_name', 'videos_html');



if(MODE_DEBUG == true)
{
	error_reporting(E_ALL);
	ini_set('display_errors', 1);	
}

# -------- CONFIG API YOUTUBE --------------

  /**********|| Thumbnail Image Configuration ||***************/
  # $config['ThumbnailImageMode']=0;   // don't show thumbnail image
  # $config['ThumbnailImageMode']=1;   // show thumbnail image directly from YouTube
  $config['ThumbnailImageMode']=2;    // show thumbnail image by proxy from this server

  /**********|| Video Download Link Configuration ||***************/
  #$config['VideoLinkMode']='direct'; // show only direct download link
  #$config['VideoLinkMode']='proxy'; // show only by proxy download link
  $config['VideoLinkMode']='both'; // show both direct and by proxy download links

  /**********|| features ||***************/
  $config['feature']['browserExtensions']=true; // show links for install browser extensions? true or false
  
  /**********|| Multiple IPs ||***************/
  # You can enable this option if you are having problems with youtube IP limit / IP ban.
  # This option will work only if the IP you add are available for the server.
  # That means you have to buy some additionnal public IPs and assign these new static IPs to the server.
  # This should work only if you have a dedicated server...
  #
  #
  # Example of adding additional IPs to Ubuntu server 14.04 LTS 
  # !!!! Be very careful, you may block yourself !!!!
  # !!!! If you are connecting to your server remotly by ssh. You would do this only if you know what you do !!!!
  # !!!! This is only an example with a specific dedicated server (ovh.net) !!!!
  #
  # For this example, the main IP on the server is 123.456.789.001
  # We want to add additionnal IPs 789.456.123.001 and 789.456.123.002
  #
  # Edit /etc/network/interfaces and put something like this:
  #
  # # The loopback network interface
  # auto lo
  # iface lo inet loopback
  #
  # # The Main server IP: 
  # auto eth0
  # iface eth0 inet static
  #     address 123.456.789.001
  #     netmask 255.255.255.0
  #     network 123.456.789.0
  #     broadcast 123.456.789.255
  #     gateway 123.456.789.254
  #
  # # Additionnal IP: 789.456.123.001
  # auto eth0:0
  # iface eth0:0 inet static
  #     address 789.456.123.001
  #     netmask 255.255.255.255
  #     broadcast 789.456.123.001
  #     gateway 123.456.789.254
  #
  # # Additionnal IP: 789.456.123.002
  # auto eth0:1
  # iface eth0:0 inet static
  #     address 789.456.123.002
  #     netmask 255.255.255.255
  #     broadcast 789.456.123.002
  #     gateway 123.456.789.254
  #
  # # Additionnal IP xxx.xxx.xxx.xxx
  # auto eth0:2
  # iface eth0:2 inet static
  # (...)
  #
  # and so on for each IP you want to add....
  #
  #
  # Reboot your server
  # If you are having trouble and cannot connect anymore over ssh to your server,
  # that means your new network configuration has errors...
  # So be very careful before applying your configuration.
  # Try it first on a local dev server before messing up with your pro server.
  # 
  # 
  $config['multipleIPs']=false; // enable multiple IPs support to bypass Youtube IP limit? true or false
  $config['IPs'] = [
	  //'xxx.xxx.xxx.xxx',
	  //'xxx.xxx.xxx.xxx',
	  //'xxx.xxx.xxx.xxx',
	  //'xxx.xxx.xxx.xxx',
	  //'xxx.xxx.xxx.xxx',
	  // add as many ips as you want (they must be available in the server conf (ex: /etc/network/interfaces fro ubuntu/debian)
  ];
  
  // Debug mode
  #$debug = MODE_DEBUG; // debug mode  
  $debug = MODE_DEBUG; // debug mode  
  
  define('apiYT_config', $config);
/*
 * If multipleIPs mode is enabled, select randomly one IP from
 * the config IPs array and put it in $outgoing_ip variable.
 */
if ($config['multipleIPs'] === true) {
	// randomly select an ip from the $config['IPs'] array
	$outgoing_ip = $config['IPs'][mt_rand(0, count($config['IPs']) - 1)];
}

/*
 * function to get via cUrl 
 * From lastRSS 0.9.1 by Vojtech Semecky, webmaster @ webdot . cz
 * See      http://lastrss.webdot.cz/
 */
 
function curlGet($URL) {
	global $config; // get global $config to know if $config['multipleIPs'] is true
    $ch = curl_init();
    $timeout = 3;
    if ($config['multipleIPs'] === true) {
	    // if $config['multipleIPs'] is true set outgoing ip to $outgoing_ip
	    global $outgoing_ip;
	    curl_setopt($ch, CURLOPT_INTERFACE, $outgoing_ip);
	}
    curl_setopt( $ch , CURLOPT_URL , $URL );
    curl_setopt( $ch , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt( $ch , CURLOPT_CONNECTTIMEOUT , $timeout );
	/* if you want to force to ipv6, uncomment the following line */ 
	//curl_setopt( $ch , CURLOPT_IPRESOLVE , 'CURLOPT_IPRESOLVE_V6');
    $tmp = curl_exec( $ch );
    curl_close( $ch );
    return $tmp;
}  

/* 
 * function to use cUrl to get the headers of the file 
 */ 
function get_location($url) {
	global $config;
	$my_ch = curl_init();
	if ($config['multipleIPs'] === true) {
	    global $outgoing_ip;
	    curl_setopt($my_ch, CURLOPT_INTERFACE, $outgoing_ip);
	}
	curl_setopt($my_ch, CURLOPT_URL,$url);
	curl_setopt($my_ch, CURLOPT_HEADER,         true);
	curl_setopt($my_ch, CURLOPT_NOBODY,         true);
	curl_setopt($my_ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($my_ch, CURLOPT_TIMEOUT,        10);
	$r = curl_exec($my_ch);
	 foreach(explode("\n", $r) as $header) {
		if(strpos($header, 'Location: ') === 0) {
			return trim(substr($header,10)); 
		}
	 }
	return '';
}

function get_size($url) {
	global $config;
	$my_ch = curl_init();
	if ($config['multipleIPs'] === true) {
	    global $outgoing_ip;
	    curl_setopt($my_ch, CURLOPT_INTERFACE, $outgoing_ip);
	}
	curl_setopt($my_ch, CURLOPT_URL,$url);
	curl_setopt($my_ch, CURLOPT_HEADER,         true);
	curl_setopt($my_ch, CURLOPT_NOBODY,         true);
	curl_setopt($my_ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($my_ch, CURLOPT_TIMEOUT,        10);
	$r = curl_exec($my_ch);
	 foreach(explode("\n", $r) as $header) {
		if(strpos($header, 'Content-Length:') === 0) {
			return trim(substr($header,16)); 
		}
	 }
	return '';
}

function get_description($url) {
	$fullpage = curlGet($url);
	$dom = new DOMDocument();
	@$dom->loadHTML($fullpage);
	$xpath = new DOMXPath($dom); 
	$tags = $xpath->query('//div[@class="info-description-body"]');
	foreach ($tags as $tag) {
		$my_description .= (trim($tag->nodeValue));
	}	
	
	return utf8_decode($my_description);
}