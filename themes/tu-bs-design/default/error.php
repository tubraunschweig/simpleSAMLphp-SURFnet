<?php
/**
 * Do not allow to frame simpleSAMLphp pages from another location.
 * This prevents clickjacking attacks in modern browsers.
 *
 * If you don't want any framing at all you can even change this to
 * 'DENY', or comment it out if you actually want to allow foreign
 * sites to put simpleSAMLphp in a frame. The latter is however
 * probably not a good security practice.
 */
header('X-Frame-Options: SAMEORIGIN');
?>
<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="HandheldFriendly" content="true" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noarchive, nofollow" />

	<title><?php
if(array_key_exists('header', $this->data)) {
        echo $this->data['header'];
} else {
        echo 'TU-Braunschweig';
}
?></title>

	<link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML_Module::getModuleURL('tu-bs-theme/resources/style.css'); ?>" />
        <link rel="stylesheet" media="screen and (max-width: 370px)" href="<?php echo SimpleSAML_Module::getModuleURL('tu-bs-theme/resources/style_320.css'); ?>" />
	<link rel="stylesheet" media="screen and (max-device-width: 480px), handheld" href="<?php echo SimpleSAML_Module::getModuleURL('tu-bs-theme/resources/style_480.css'); ?>" />
	<link rel="icon" type="image/icon" href="<?php echo SimpleSAML_Module::getModuleURL('tu-bs-theme/resources/favicon.ico'); ?>" />

</head>

<body class="storing">
	<div id="wrapper">

		<div id="header">
			<img id="logo" src="<?php echo SimpleSAML_Module::getModuleURL('tu-bs-theme/resources/logo.svg'); ?>" alt="TU-Braunschweig" />
			<h1 class="mainTitle"></h1>
			<ul class="langSelect">

<?php 
$includeLanguageBar = FALSE;
if (!empty($_POST)) 
	$includeLanguageBar = FALSE;
if (isset($this->data['hideLanguageBar']) && $this->data['hideLanguageBar'] === TRUE) 
	$includeLanguageBar = FALSE;

if ($includeLanguageBar) {
	$languages = $this->getLanguageList();
	$langnames = array();
	foreach($languages as $k => $v) {
		$langnames[$k] = strtoupper($k);
	}	
	$textarray = array();
	foreach ($languages AS $lang => $current) {
		$lang = strtolower($lang);
		if ($current) {
			$textarray[] = '<li class="active">' . $langnames[$lang] . "</li>";
		} else {
			$textarray[] = '<li><a href="' . htmlspecialchars(SimpleSAML_Utilities::addURLparameter(SimpleSAML_Utilities::selfURL(), array('language' => $lang))) . '">' .
				$langnames[$lang] . '</a></li>';
		}
	}
	echo join($textarray);
}

$url_current = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(isset($_GET['language'])){
	if($_GET['language']=='de'){
		echo   '<li class="active"><a href="#">DE</a>
				<li ><a href="'.$url_current.'&language=en">EN</a>';
	}elseif($_GET['language']=='en'){
		echo   '<li ><a href="'.$url_current.'&language=de">DE</a>
				<li class="active"><a href="#">EN</a>';
	}else{
		echo'<li ><a href="'.$url_current.'&language=de">DE</a>
			 <li ><a href="'.$url_current.'&language=en">EN</a>';
	}
}else{
	echo'<li ><a href="'.$url_current.'&language=de">DE</a>
		 <li ><a href="'.$url_current.'&language=en">EN</a>';
}
				?>


			</ul>
		</div>


		
		<div id="content">
			<div class="item">
				<h1><?php echo $this->t($this->data['dictTitle']); ?></h1>
				<p><?php
echo htmlspecialchars($this->t($this->data['dictDescr'], $this->data['parameters']));?></p>
				<p>
					Bei anhaltenden Problemen wenden Sie sich bitte an <a href="https://www.tu-braunschweig.de/it/service-desk" target="_blank">https://www.tu-braunschweig.de/it/service-desk</a>, Telefon (+49) 531/391-55555 
					oder per &#8209;mail&nbsp;<a href="mailto: it-service-desk@tu-braunschweig.de">it-service-desk@tu-braunschweig.de</a>
				</p>
				<p>

                    <?php echo $this->t('report_trackid'); ?>
                    <?php echo $this->data['error']['trackId']; ?>
				</p>
			</div>
		</div>

		<!-- FOOTER -->

        <div id="footer">
			<p style="color:blue;text-decoration: underline;" onclick="window.location='https://github.com/SURFnet/simpleSAMLphp-SURFnet'">&copy; 2012 Catharijne college</p>
		</div>

		<!-- EINDE FOOTER -->
	</div>
</body>
</html>
