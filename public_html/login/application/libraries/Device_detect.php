<?php
class Device_detect {
	protected $userAgent = '';
	protected $httpHeaders = array();
	const VER                       = '([\w._\+]+)';
	const VERSION_TYPE_STRING       = 'text';
    const VERSION_TYPE_FLOAT        = 'float';
    protected static $properties = array(

        // Build
        'Mobile'        => 'Mobile/[VER]',
        'Build'         => 'Build/[VER]',
        'Version'       => 'Version/[VER]',
        'VendorID'      => 'VendorID/[VER]',

        // Devices
        'iPad'          => 'iPad.*CPU[a-z ]+[VER]',
        'iPhone'        => 'iPhone.*CPU[a-z ]+[VER]',
        'iPod'          => 'iPod.*CPU[a-z ]+[VER]',
        'BlackBerry'    => array('BlackBerry[VER]', 'BlackBerry [VER];'),
        'Kindle'        => 'Kindle/[VER]',

        // Browser
        'Chrome'        => array('Chrome/[VER]', 'CriOS/[VER]', 'CrMo/[VER]'),
        'Coast'         => array('Coast/[VER]'),
        'Dolfin'        => 'Dolfin/[VER]',
		'Edge'       	=> 'Edge/[VER]',
        'Firefox'       => 'Firefox/[VER]',
        'Fennec'        => 'Fennec/[VER]',

        'IE'      => array('IEMobile/[VER];', 'IEMobile [VER]', 'MSIE [VER];', 'Trident/[0-9.]+;.*rv:[VER]'),
        'Internet Explorer'      => array('IEMobile/[VER];', 'IEMobile [VER]', 'MSIE [VER];', 'Trident/[0-9.]+;.*rv:[VER]'),
        
        'NetFront'      => 'NetFront/[VER]',
        'NokiaBrowser'  => 'NokiaBrowser/[VER]',
        'Opera'         => array( ' OPR/[VER]', 'Opera Mini/[VER]', 'Version/[VER]' ),
        'Opera Mini'    => 'Opera Mini/[VER]',
        'Opera Mobi'    => 'Version/[VER]',
        'UC Browser'    => 'UC Browser[VER]',
        'UBrowser'      => 'UBrowser/[VER]',
        'MQQBrowser'    => 'MQQBrowser/[VER]',
        'MicroMessenger' => 'MicroMessenger/[VER]',
        'baiduboxapp'   => 'baiduboxapp/[VER]',
        'baidubrowser'  => 'baidubrowser/[VER]',
        'Iron'          => 'Iron/[VER]',
        
        'Safari'        => array( 'Version/[VER]', 'Safari/[VER]' ),
        'Skyfire'       => 'Skyfire/[VER]',
        'Tizen'         => 'Tizen/[VER]',
        'Webkit'        => 'webkit[ /][VER]',
		'PaleMoon'         => 'PaleMoon/[VER]',

        // Engine
        'Gecko'         => 'Gecko/[VER]',
        'Trident'       => 'Trident/[VER]',
        'Presto'        => 'Presto/[VER]',
		'Goanna'           => 'Goanna/[VER]',

        // OS
        'iOS'              => ' \bi?OS\b [VER][ ;]{1}',
        'Android'          => 'Android [VER]',
        'BlackBerry'       => array('BlackBerry[\w]+/[VER]', 'BlackBerry.*Version/[VER]', 'Version/[VER]'),
        'BREW'             => 'BREW [VER]',
        'Java'             => 'Java/[VER]',

        'Windows Phone OS' => array( 'Windows Phone OS [VER]', 'Windows Phone [VER]'),
        'Windows Phone'    => 'Windows Phone [VER]',
        'Windows CE'       => 'Windows CE/[VER]',
        
        'Windows NT'       => 'Windows NT [VER]',
        'Symbian'          => array('SymbianOS/[VER]', 'Symbian/[VER]'),
        'webOS'            => array('webOS/[VER]', 'hpwOS/[VER];'),

        'Handheld Browser' => 'Version/[VER]',
    );
	function __construct($user_agent = ''){
		if($user_agent) $this->setCUserAgent($user_agent);
		else $this->setHttpHeaders();
	}
	public function getInfo(){
	    $device_info = array();
	    if($this->isMobile()){
    		$device_info['is'] = 'Mobile';
    		$device_info['os'] = $this->getMobileOs();
    		$device_info['version'] = $this->mobileOS();
    		$device_info['browser'] = $this->getmbrowsers();
	    }else{
    		$device_info['is'] = 'PC';
    		$device_info['os'] = $this->getBrowserOs();
    		$device_info['browser'] = $this->getBrowserName();
    		$device_info['version'] = $this->version($device_info['browser']);
	    }
    	$device_info['device'] = $this->getMobileDevice();
    	$device_info['ip'] = $this->getIp();
    	$device_info['useragent'] = $this->userAgent;

    	return $device_info;
	}
	protected function setHttpHeaders($httpHeaders = array()){
        $this->httpHeaders = array();
        if (!$httpHeaders) $httpHeaders = $_SERVER;
        foreach ($httpHeaders as $key => $value) if (substr($key, 0, 5) === 'HTTP_') $this->httpHeaders[$key] = $value;
		$this->setUserAgent();
    }
    protected function setUserAgent(){
        $this->userAgent = '';
        foreach ($this->httpHeaders as $altHeader) $this->userAgent .= $altHeader . " ";
        $this->userAgent = trim($this->userAgent);
    }
    protected function setCUserAgent($user_agents){
        $this->userAgent = '';
        if(is_array($user_agents)) foreach ($user_agents as $user_agent) $this->userAgent .= $user_agent . " ";
        else $this->userAgent = $user_agents;
        $this->userAgent = trim($this->userAgent);
    }
    protected function match($regex, $userAgent = false){
		$pattern = sprintf('#%s#is', $regex);
		$userAgent = ($userAgent ? $userAgent : $this->userAgent);
        //$match = (bool)preg_match($pattern,$userAgent,$matches);
        $match = preg_match($pattern,$userAgent);
        return $match;
    }
	protected function isMobile(){
	    /*$aMobileUA = array('iphone' => 'iPhone','ipod' => 'iPod','ipad' => 'iPad','android' => 'Android','blackberry' => 'BlackBerry','webos' => 'Mobile');
		foreach($aMobileUA as $sMobileKey => $sMobileOS) if($this->match($sMobileKey)) return $sMobileOS;*/
		$pattern = 'iPhone|iPod|iPad|Android|BlackBerry|Mobile';
	    return $this->match($pattern);
	}
	protected function getmbrowsers(){
	    $browsers = array(
	        'Dolfin'          => '\bDolfin\b',
	        'Opera'           => 'Opera.*Mini|Opera.*Mobi|Android.*Opera|Mobile.*OPR/[0-9.]+|Coast/[0-9.]+',
	        'Skyfire'         => 'Skyfire',
	        'Edge'             => 'Mobile Safari/[.0-9]* Edge',
	        'IE'              => 'IEMobile|MSIEMobile',
	        'Firefox'         => 'fennec|firefox.*maemo|(Mobile|Tablet).*Firefox|Firefox.*Mobile|FxiOS',
	        'Bolt'            => 'bolt',
	        'TeaShark'        => 'teashark',
	        'Blazer'          => 'Blazer',
	        'UCBrowser'       => 'UC.*Browser|UCWEB',
	        'baiduboxapp'     => 'baiduboxapp',
	        'baidubrowser'    => 'baidubrowser',
	        'DiigoBrowser'    => 'DiigoBrowser',
	        'Puffin'            => 'Puffin',
	        'Mercury'          => '\bMercury\b',
	        'ObigoBrowser' => 'Obigo',
	        'NetFront' => 'NF-Browser',
	        'GenericBrowser'  => 'NokiaBrowser|OviBrowser|OneBrowser|TwonkyBeamBrowser|SEMC.*Browser|FlyFlow|Minimo|NetFront|Novarra-Vision|MQQBrowser|MicroMessenger',
	        'PaleMoon'        => 'Android.*PaleMoon|Mobile.*PaleMoon',
	        'Vivaldi'         => 'Vivaldi',
	        'Midori'          => 'midori',
	        'Tizen'           => 'Tizen',
			'Edge'			 => 'Edge',
			'Maxthon'			 => 'Maxthon',
			'Konqueror'			 => 'Konqueror',
			'Handheld Browser' => 'Version.*Chrome.*Mobile Safari',
	        'Safari'          => 'Version.*Mobile.*Safari|Safari.*Mobile|MobileSafari',
	        'Chrome'          => '\bCrMo\b|CriOS|Android.*Chrome/[.0-9]* (Mobile)?',
			'Internet Explorer' => 'MSIE|Trident/7',
	    );
	    foreach($browsers as $browser => $pattern) if($this->match($pattern)) return $browser;
	    return false;
	}
	protected function getMobileOs($os = ''){
	    $operatingSystems = array(
	        'AndroidOS'         => 'Android',
	        'BlackBerryOS'      => 'blackberry|\bBB10\b|rim tablet os',
	        'PalmOS'            => 'PalmOS|avantgo|blazer|elaine|hiptop|palm|plucker|xiino',
	        'SymbianOS'         => 'Symbian|SymbOS|Series60|Series40|SYB-[0-9]+|\bS60\b',
	        'WindowsMobileOS'   => 'Windows CE.*(PPC|Smartphone|Mobile|[0-9]{3}x[0-9]{3})|Window Mobile|Windows Phone [0-9.]+|WCE;',
	        'WindowsPhoneOS'    => 'Windows Phone 10.0|Windows Phone 8.1|Windows Phone 8.0|Windows Phone OS|XBLWP7|ZuneWP7|Windows NT 6.[23]; ARM;',
	        'iOS'               => '\biPhone.*Mobile|\biPod|\biPad',
	        'MeeGoOS'           => 'MeeGo',
	        'MaemoOS'           => 'Maemo',
	        'JavaOS'            => 'J2ME/|\bMIDP\b|\bCLDC\b',
	        'webOS'             => 'webOS|hpwOS',
	        'badaOS'            => '\bBada\b',
	        'BREWOS'            => 'BREW',
	    );
	    if($os && isset($operatingSystems[$os])) return $this->match($operatingSystems[$os]);
	    foreach($operatingSystems as $os => $pattern) if($this->match($pattern)) return $os;
	    return false;
	}
	protected function getMobileDevice(){
	    $aMobileUA = array(
	        'iPhone'        => '\biPhone\b|\biPod|\biTunes\b',
	        'BlackBerry'    => 'BlackBerry|\bBB10\b|rim[0-9]+',
	        'HTC'           => 'HTC|HTC.*(Sensation|Evo|Vision|Explorer|6800|8100|8900|A7272|S510e|C110e|Legend|Desire|T8282)|APX515CKT|Qtek9090|APA9292KT|HD_mini|Sensation.*Z710e|PG86100|Z715e|Desire.*(A8181|HD)|ADR6200|ADR6400L|ADR6425|001HT|Inspire 4G|Android.*\bEVO\b|T-Mobile G1|Z520m',
	        'Nexus'         => 'Nexus One|Nexus S|Galaxy.*Nexus|Android.*Nexus.*Mobile|Nexus 4|Nexus 5|Nexus 6',
	        'Dell'          => 'Dell.*Streak|Dell.*Aero|Dell.*Venue|DELL.*Venue Pro|Dell Flash|Dell Smoke|Dell Mini 3iX|XCD28|XCD35|\b001DL\b|\b101DL\b|\bGS01\b',
	        'Motorola'      => 'Motorola|DROIDX|DROID BIONIC|\bDroid\b.*Build|Android.*Xoom|HRI39|MOT-|A1260|A1680|A555|A853|A855|A953|A955|A956|Motorola.*ELECTRIFY|Motorola.*i1|i867|i940|MB200|MB300|MB501|MB502|MB508|MB511|MB520|MB525|MB526|MB611|MB612|MB632|MB810|MB855|MB860|MB861|MB865|MB870|ME501|ME502|ME511|ME525|ME600|ME632|ME722|ME811|ME860|ME863|ME865|MT620|MT710|MT716|MT720|MT810|MT870|MT917|Motorola.*TITANIUM|WX435|WX445|XT300|XT301|XT311|XT316|XT317|XT319|XT320|XT390|XT502|XT530|XT531|XT532|XT535|XT603|XT610|XT611|XT615|XT681|XT701|XT702|XT711|XT720|XT800|XT806|XT860|XT862|XT875|XT882|XT883|XT894|XT901|XT907|XT909|XT910|XT912|XT928|XT926|XT915|XT919|XT925|XT1021|\bMoto E\b',
	        'Samsung'       => '\bSamsung\b|SM-G9250|GT-19300|SGH-I337|BGT-S5230|GT-B2100|GT-B2700|GT-B2710|GT-B3210|GT-B3310|GT-B3410|GT-B3730|GT-B3740|GT-B5510|GT-B5512|GT-B5722|GT-B6520|GT-B7300|GT-B7320|GT-B7330|GT-B7350|GT-B7510|GT-B7722|GT-B7800|GT-C3010|GT-C3011|GT-C3060|GT-C3200|GT-C3212|GT-C3212I|GT-C3262|GT-C3222|GT-C3300|GT-C3300K|GT-C3303|GT-C3303K|GT-C3310|GT-C3322|GT-C3330|GT-C3350|GT-C3500|GT-C3510|GT-C3530|GT-C3630|GT-C3780|GT-C5010|GT-C5212|GT-C6620|GT-C6625|GT-C6712|GT-E1050|GT-E1070|GT-E1075|GT-E1080|GT-E1081|GT-E1085|GT-E1087|GT-E1100|GT-E1107|GT-E1110|GT-E1120|GT-E1125|GT-E1130|GT-E1160|GT-E1170|GT-E1175|GT-E1180|GT-E1182|GT-E1200|GT-E1210|GT-E1225|GT-E1230|GT-E1390|GT-E2100|GT-E2120|GT-E2121|GT-E2152|GT-E2220|GT-E2222|GT-E2230|GT-E2232|GT-E2250|GT-E2370|GT-E2550|GT-E2652|GT-E3210|GT-E3213|GT-I5500|GT-I5503|GT-I5700|GT-I5800|GT-I5801|GT-I6410|GT-I6420|GT-I7110|GT-I7410|GT-I7500|GT-I8000|GT-I8150|GT-I8160|GT-I8190|GT-I8320|GT-I8330|GT-I8350|GT-I8530|GT-I8700|GT-I8703|GT-I8910|GT-I9000|GT-I9001|GT-I9003|GT-I9010|GT-I9020|GT-I9023|GT-I9070|GT-I9082|GT-I9100|GT-I9103|GT-I9220|GT-I9250|GT-I9300|GT-I9305|GT-I9500|GT-I9505|GT-M3510|GT-M5650|GT-M7500|GT-M7600|GT-M7603|GT-M8800|GT-M8910|GT-N7000|GT-S3110|GT-S3310|GT-S3350|GT-S3353|GT-S3370|GT-S3650|GT-S3653|GT-S3770|GT-S3850|GT-S5210|GT-S5220|GT-S5229|GT-S5230|GT-S5233|GT-S5250|GT-S5253|GT-S5260|GT-S5263|GT-S5270|GT-S5300|GT-S5330|GT-S5350|GT-S5360|GT-S5363|GT-S5369|GT-S5380|GT-S5380D|GT-S5560|GT-S5570|GT-S5600|GT-S5603|GT-S5610|GT-S5620|GT-S5660|GT-S5670|GT-S5690|GT-S5750|GT-S5780|GT-S5830|GT-S5839|GT-S6102|GT-S6500|GT-S7070|GT-S7200|GT-S7220|GT-S7230|GT-S7233|GT-S7250|GT-S7500|GT-S7530|GT-S7550|GT-S7562|GT-S7710|GT-S8000|GT-S8003|GT-S8500|GT-S8530|GT-S8600|SCH-A310|SCH-A530|SCH-A570|SCH-A610|SCH-A630|SCH-A650|SCH-A790|SCH-A795|SCH-A850|SCH-A870|SCH-A890|SCH-A930|SCH-A950|SCH-A970|SCH-A990|SCH-I100|SCH-I110|SCH-I400|SCH-I405|SCH-I500|SCH-I510|SCH-I515|SCH-I600|SCH-I730|SCH-I760|SCH-I770|SCH-I830|SCH-I910|SCH-I920|SCH-I959|SCH-LC11|SCH-N150|SCH-N300|SCH-R100|SCH-R300|SCH-R351|SCH-R400|SCH-R410|SCH-T300|SCH-U310|SCH-U320|SCH-U350|SCH-U360|SCH-U365|SCH-U370|SCH-U380|SCH-U410|SCH-U430|SCH-U450|SCH-U460|SCH-U470|SCH-U490|SCH-U540|SCH-U550|SCH-U620|SCH-U640|SCH-U650|SCH-U660|SCH-U700|SCH-U740|SCH-U750|SCH-U810|SCH-U820|SCH-U900|SCH-U940|SCH-U960|SCS-26UC|SGH-A107|SGH-A117|SGH-A127|SGH-A137|SGH-A157|SGH-A167|SGH-A177|SGH-A187|SGH-A197|SGH-A227|SGH-A237|SGH-A257|SGH-A437|SGH-A517|SGH-A597|SGH-A637|SGH-A657|SGH-A667|SGH-A687|SGH-A697|SGH-A707|SGH-A717|SGH-A727|SGH-A737|SGH-A747|SGH-A767|SGH-A777|SGH-A797|SGH-A817|SGH-A827|SGH-A837|SGH-A847|SGH-A867|SGH-A877|SGH-A887|SGH-A897|SGH-A927|SGH-B100|SGH-B130|SGH-B200|SGH-B220|SGH-C100|SGH-C110|SGH-C120|SGH-C130|SGH-C140|SGH-C160|SGH-C170|SGH-C180|SGH-C200|SGH-C207|SGH-C210|SGH-C225|SGH-C230|SGH-C417|SGH-C450|SGH-D307|SGH-D347|SGH-D357|SGH-D407|SGH-D415|SGH-D780|SGH-D807|SGH-D980|SGH-E105|SGH-E200|SGH-E315|SGH-E316|SGH-E317|SGH-E335|SGH-E590|SGH-E635|SGH-E715|SGH-E890|SGH-F300|SGH-F480|SGH-I200|SGH-I300|SGH-I320|SGH-I550|SGH-I577|SGH-I600|SGH-I607|SGH-I617|SGH-I627|SGH-I637|SGH-I677|SGH-I700|SGH-I717|SGH-I727|SGH-i747M|SGH-I777|SGH-I780|SGH-I827|SGH-I847|SGH-I857|SGH-I896|SGH-I897|SGH-I900|SGH-I907|SGH-I917|SGH-I927|SGH-I937|SGH-I997|SGH-J150|SGH-J200|SGH-L170|SGH-L700|SGH-M110|SGH-M150|SGH-M200|SGH-N105|SGH-N500|SGH-N600|SGH-N620|SGH-N625|SGH-N700|SGH-N710|SGH-P107|SGH-P207|SGH-P300|SGH-P310|SGH-P520|SGH-P735|SGH-P777|SGH-Q105|SGH-R210|SGH-R220|SGH-R225|SGH-S105|SGH-S307|SGH-T109|SGH-T119|SGH-T139|SGH-T209|SGH-T219|SGH-T229|SGH-T239|SGH-T249|SGH-T259|SGH-T309|SGH-T319|SGH-T329|SGH-T339|SGH-T349|SGH-T359|SGH-T369|SGH-T379|SGH-T409|SGH-T429|SGH-T439|SGH-T459|SGH-T469|SGH-T479|SGH-T499|SGH-T509|SGH-T519|SGH-T539|SGH-T559|SGH-T589|SGH-T609|SGH-T619|SGH-T629|SGH-T639|SGH-T659|SGH-T669|SGH-T679|SGH-T709|SGH-T719|SGH-T729|SGH-T739|SGH-T746|SGH-T749|SGH-T759|SGH-T769|SGH-T809|SGH-T819|SGH-T839|SGH-T919|SGH-T929|SGH-T939|SGH-T959|SGH-T989|SGH-U100|SGH-U200|SGH-U800|SGH-V205|SGH-V206|SGH-X100|SGH-X105|SGH-X120|SGH-X140|SGH-X426|SGH-X427|SGH-X475|SGH-X495|SGH-X497|SGH-X507|SGH-X600|SGH-X610|SGH-X620|SGH-X630|SGH-X700|SGH-X820|SGH-X890|SGH-Z130|SGH-Z150|SGH-Z170|SGH-ZX10|SGH-ZX20|SHW-M110|SPH-A120|SPH-A400|SPH-A420|SPH-A460|SPH-A500|SPH-A560|SPH-A600|SPH-A620|SPH-A660|SPH-A700|SPH-A740|SPH-A760|SPH-A790|SPH-A800|SPH-A820|SPH-A840|SPH-A880|SPH-A900|SPH-A940|SPH-A960|SPH-D600|SPH-D700|SPH-D710|SPH-D720|SPH-I300|SPH-I325|SPH-I330|SPH-I350|SPH-I500|SPH-I600|SPH-I700|SPH-L700|SPH-M100|SPH-M220|SPH-M240|SPH-M300|SPH-M305|SPH-M320|SPH-M330|SPH-M350|SPH-M360|SPH-M370|SPH-M380|SPH-M510|SPH-M540|SPH-M550|SPH-M560|SPH-M570|SPH-M580|SPH-M610|SPH-M620|SPH-M630|SPH-M800|SPH-M810|SPH-M850|SPH-M900|SPH-M910|SPH-M920|SPH-M930|SPH-N100|SPH-N200|SPH-N240|SPH-N300|SPH-N400|SPH-Z400|SWC-E100|SCH-i909|GT-N7100|GT-N7105|SCH-I535|SM-N900A|SGH-I317|SGH-T999L|GT-S5360B|GT-I8262|GT-S6802|GT-S6312|GT-S6310|GT-S5312|GT-S5310|GT-I9105|GT-I8510|GT-S6790N|SM-G7105|SM-N9005|GT-S5301|GT-I9295|GT-I9195|SM-C101|GT-S7392|GT-S7560|GT-B7610|GT-I5510|GT-S7582|GT-S7530E|GT-I8750|SM-G9006V|SM-G9008V|SM-G9009D|SM-G900A|SM-G900D|SM-G900F|SM-G900H|SM-G900I|SM-G900J|SM-G900K|SM-G900L|SM-G900M|SM-G900P|SM-G900R4|SM-G900S|SM-G900T|SM-G900V|SM-G900W8|SHV-E160K|SCH-P709|SCH-P729|SM-T2558|GT-I9205|SM-G9350|SM-J120F|SM-G920F|SM-G920V|SM-G930F|SM-N910C',
	        'LG'            => '\bLG\b;|LG[- ]?(C800|C900|E400|E610|E900|E-900|F160|F180K|F180L|F180S|730|855|L160|LS740|LS840|LS970|LU6200|MS690|MS695|MS770|MS840|MS870|MS910|P500|P700|P705|VM696|AS680|AS695|AX840|C729|E970|GS505|272|C395|E739BK|E960|L55C|L75C|LS696|LS860|P769BK|P350|P500|P509|P870|UN272|US730|VS840|VS950|LN272|LN510|LS670|LS855|LW690|MN270|MN510|P509|P769|P930|UN200|UN270|UN510|UN610|US670|US740|US760|UX265|UX840|VN271|VN530|VS660|VS700|VS740|VS750|VS910|VS920|VS930|VX9200|VX11000|AX840A|LW770|P506|P925|P999|E612|D955|D802|MS323)',
	        'Sony'          => 'SonyST|SonyLT|SonyEricsson|SonyEricssonLT15iv|LT18i|E10i|LT28h|LT26w|SonyEricssonMT27i|C5303|C6902|C6903|C6906|C6943|D2533',
	        'Asus'          => 'Asus.*Galaxy|PadFone.*Mobile',
	        'NokiaLumia'    => 'Lumia [0-9]{3,4}',
	        'Micromax'      => 'Micromax.*\b(A210|A92|A88|A72|A111|A110Q|A115|A116|A110|A90S|A26|A51|A35|A54|A25|A27|A89|A68|A65|A57|A90)\b',
	        'Palm'          => 'PalmSource|Palm',
	        'Vertu'         => 'Vertu|Vertu.*Ltd|Vertu.*Ascent|Vertu.*Ayxta|Vertu.*Constellation(F|Quest)?|Vertu.*Monika|Vertu.*Signature',
	        'Pantech'       => 'PANTECH|IM-A850S|IM-A840S|IM-A830L|IM-A830K|IM-A830S|IM-A820L|IM-A810K|IM-A810S|IM-A800S|IM-T100K|IM-A725L|IM-A780L|IM-A775C|IM-A770K|IM-A760S|IM-A750K|IM-A740S|IM-A730S|IM-A720L|IM-A710K|IM-A690L|IM-A690S|IM-A650S|IM-A630K|IM-A600S|VEGA PTL21|PT003|P8010|ADR910L|P6030|P6020|P9070|P4100|P9060|P5000|CDM8992|TXT8045|ADR8995|IS11PT|P2030|P6010|P8000|PT002|IS06|CDM8999|P9050|PT001|TXT8040|P2020|P9020|P2000|P7040|P7000|C790',
	        'Fly'           => 'IQ230|IQ444|IQ450|IQ440|IQ442|IQ441|IQ245|IQ256|IQ236|IQ255|IQ235|IQ245|IQ275|IQ240|IQ285|IQ280|IQ270|IQ260|IQ250',
	        'Wiko'          => 'KITE 4G|HIGHWAY|GETAWAY|STAIRWAY|DARKSIDE|DARKFULL|DARKNIGHT|DARKMOON|SLIDE|WAX 4G|RAINBOW|BLOOM|SUNSET|GOA(?!nna)|LENNY|BARRY|IGGY|OZZY|CINK FIVE|CINK PEAX|CINK PEAX 2|CINK SLIM|CINK SLIM 2|CINK +|CINK KING|CINK PEAX|CINK SLIM|SUBLIM',
	        'iMobile'        => 'i-mobile (IQ|i-STYLE|idea|ZAA|Hitz)',
	        'SimValley'     => '\b(SP-80|XT-930|SX-340|XT-930|SX-310|SP-360|SP60|SPT-800|SP-120|SPT-800|SP-140|SPX-5|SPX-8|SP-100|SPX-8|SPX-12)\b',
	        'Wolfgang'      => 'AT-B24D|AT-AS50HD|AT-AS40W|AT-AS55HD|AT-AS45q2|AT-B26D|AT-AS50Q',
	        'Alcatel'       => 'Alcatel',
	        'Nintendo' => 'Nintendo 3DS',
	        'Amoi'          => 'Amoi',
	        'INQ'           => 'INQ',
	        'GenericPhone'  => 'Tapatalk|PDA;|SAGEM|\bmmp\b|pocket|\bpsp\b|symbian|Smartphone|smartfon|treo|up.browser|up.link|vodafone|\bwap\b|nokia|Series40|Series60|S60|SonyEricsson|N900|MAUI.*WAP.*Browser',
	    );
	    foreach($aMobileUA as $sMobileKey => $sMobileOS) if($this->match($sMobileOS)) return $sMobileKey;
	    return false;
	}
	protected function getBrowserOs(){
		$platform = array(
			'Windows 10' => 'Windows NT 10',
			'Windows 8.1' => 'windows nt 6.3',
			'Windows 8' => 'windows nt 6.2',
			'Windows 7' => 'windows nt 6.1',
			'Windows Vista' => 'windows nt 6.0',
			'Windows Server 2003/XP x64' => 'windows nt 5.2',
			'Windows XP' => 'windows nt 5.1',
			'Windows XP' => 'windows xp',
			'Windows 2000' => 'windows nt 5.0',
			'Windows ME' => 'windows me',
			'Windows 98' => 'win98',
			'Windows 95' => 'win95',
			'Windows 3.11' => 'win16',
			'Mac OS X' => 'macintosh|mac os x',
			'Mac OS 9' => 'mac_powerpc',
			'Linux' => 'linux',
			'Ubuntu' => 'ubuntu',
			'iPhone' => 'iphone',
			'iPod' => 'ipod',
			'iPad' => 'ipad',
			'Android' => 'android',
			'BlackBerry' => 'blackberry',
			'Mobile' =>'webos',
			'Linux' => 'linux',
			'Unix' => 'Unix',
			'Mac' => 'macintosh|mac os x',
			'Windows' => 'windows|win32',
		);
		foreach($platform as $os => $pattern) if($this->match($pattern)) return $os;
	    return false;
	}
	protected function getBrowserName(){
		$browsers = array(
			'Internet Explorer' => 'MSIE|Trident\/7',
			'UBrowser' => 'UBrowser',
			'Firefox' => 'Firefox',
			'Chrome' => 'Chrome',
			'Safari' => 'Safari',
			'Opera' => 'Opera|OPR',
			'Netscape' => 'Netscape',
			'Edge' => 'Edge',
			'Maxthon' => 'Maxthon',
			'Konqueror' => 'Konqueror',
			'Handheld Browser' => 'mobile',
		);
		foreach($browsers as $browser => $pattern) if($this->match($pattern)) return $browser;
	    return false;
	}
	protected function mobileOS(){
		//$agent = $this->userAgent;
		$version = $os = '';
		$device_os =  $this->getMobileOs();
		if ('AndroidOS' == $device_os){
			$androidVersion = $this->version('Android');
			if ($androidVersion !== false) {
				$version = ' ' . $androidVersion;
				switch (true) {
					case $androidVersion >= 8.0: $codeName = ' (Oreo)'; break;
					case $androidVersion >= 7.0: $codeName = ' (Nougat)'; break;
					case $androidVersion >= 6.0: $codeName = ' (Marshmallow)'; break;
					case $androidVersion >= 5.0: $codeName = ' (Lollipop)'; break;
					case $androidVersion >= 4.4: $codeName = ' (KitKat)'; break;
					case $androidVersion >= 4.1: $codeName = ' (Jelly Bean)'; break;
					case $androidVersion >= 4.0: $codeName = ' (Ice Cream Sandwich)'; break;
					case $androidVersion >= 3.0: $codeName = ' (Honeycomb)'; break;
					case $androidVersion >= 2.3: $codeName = ' (Gingerbread)'; break;
					case $androidVersion >= 2.2: $codeName = ' (Froyo)'; break;
					case $androidVersion >= 2.0: $codeName = ' (Eclair)'; break;
					case $androidVersion >= 1.6: $codeName = ' (Donut)'; break;
					case $androidVersion >= 1.5: $codeName = ' (Cupcake)'; break;
					default: $codeName = ''; break;
				}
			}
			$os = $version . $codeName;
		}elseif ($this->match('Mac OS X')){
			$mac_os = array(
				'OS X (El Capitan)' => 'Mac OS X 10_11|OS 10_11|Mac OS X 10.11|OS 10.11',
				'OS X (Yosemite)' => 'Mac OS X 10_10|OS 10_10|Mac OS X 10.10|OS 10.10',
				'OS X (Mountain Lion)' => 'Mac OS X 10_8|OS 10_8|Mac OS X 10.8|OS 10.8',
				'Mac OS X (Lion)' => 'Mac OS X 10_8|OS 10_8|Mac OS X 10.8|OS 10.8',
				'Mac OS X (Snow Leopard)' => 'Mac OS X 10_7|OS 10_7|Mac OS X 10.7|OS 10.7',
				'Mac OS X (Leopard)' => 'Mac OS X 10_6|OS 10_6|Mac OS X 10.6|OS 10.6',
				'Mac OS X (Tiger)' => 'Mac OS X 10_4|OS 10_4|Mac OS X 10.4|OS 10.4',
				'Mac OS X (Panther)' => 'Mac OS X 10_3|OS 10_3|Mac OS X 10.3|OS 10.3',
				'Mac OS X (Jaguar)' => 'Mac OS X 10_2|OS 10_2|Mac OS X 10.2|OS 10.2',
				'Mac OS X (Puma)' => 'Mac OS X 10_1|OS 10_1|Mac OS X 10.1|OS 10.1',
				'Mac OS X (Cheetah)' => 'Mac OS X 10|OS 10'
			);
			foreach ($mac_os as $mos => $pattern) if($this->match($pattern)){
				$os = $mos;
				break;
			}
		} elseif ('WindowsMobileOS' == $device_os || 'WindowsPhoneOS' == $device_os) {
			if ($this->version('WindowsPhone') !== false) $version = ' ' . $this->version('WindowsPhoneOS');
			$os = $version;
		}
		return $os;
	}
	protected function version($propertyName, $type = self::VERSION_TYPE_STRING){
        if (empty($propertyName)) return false;
        if ($type !== self::VERSION_TYPE_STRING && $type !== self::VERSION_TYPE_FLOAT) $type = self::VERSION_TYPE_STRING;
        $properties = self::$properties;
        if (isset($properties[$propertyName])) {
            $properties[$propertyName] = (array)$properties[$propertyName];
            foreach ($properties[$propertyName] as $propertyMatchString) {
                $propertyPattern = str_replace('[VER]', self::VER, $propertyMatchString);
                preg_match(sprintf('#%s#is', $propertyPattern), $this->userAgent, $match);
                if (false === empty($match[1])) {
                    $version = ($type == self::VERSION_TYPE_FLOAT ? $this->prepareVersionNo($match[1]) : $match[1]);
                    return $version;
                }
            }
        }
        return false;
    }
    protected function getIp(){
    	$ipAddress= '';
    	$httpHeaders = $_SERVER;
		if (isset($httpHeaders['HTTP_CLIENT_IP']) && !empty($httpHeaders['HTTP_CLIENT_IP'])) $ipAddress = $httpHeaders['HTTP_CLIENT_IP'];
		elseif (isset($httpHeaders['HTTP_X_FORWARDED_FOR']) && !empty($httpHeaders['HTTP_X_FORWARDED_FOR'])) $ipAddress = $httpHeaders['HTTP_X_FORWARDED_FOR'];
		else $ipAddress = $httpHeaders['REMOTE_ADDR'];

		if (in_array($ipAddress, array('::1', '127.0.0.1'))) $ipAddress = 'localhost';
		return $ipAddress;
	}
}