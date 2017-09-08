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

	<script type="text/javascript">
	function initiate(){
		document.getElementById('username').focus();
	}
	</script>

</head>

<body class="index" onload="initiate()">
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
				<h1><?php echo $this->t('{login:user_pass_header}'); ?></h1>
				<p class="info"><?php echo $this->t('{login:user_pass_text}'); ?></p>

<?php
if ($this->data['errorcode'] !== NULL) {
?>

				<p class="error"><?php echo $this->t('{errors:descr_' . $this->data['errorcode'] . '}'); ?></p>

<?php
}
?>				
				<form id="login" method="POST" action="?" name="f">
					<label for="username"><?php echo $this->t('{login:username}'); ?>
					<input type="text" name="username" id="username" value="<?php echo htmlspecialchars($this->data['username']); ?>" autocomplete= "off" />
					<label for="password"><?php echo $this->t('{login:password}'); ?></label>
					<input type="password" name="password" id="password" autocomplete= "off" />
					<input onclick="this.value='Processing...';this.disabled=true;this.form.submit();return true;" type="submit" value="<?php echo $this->t('{login:login_button}'); ?>" />

<?php
foreach ($this->data['stateparams'] as $name => $value) {
	echo('<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />');
}
?>

				</form>

			</div>
			<div class="subitem">

			  <div class="createIndex">
                <h2><?php echo $this->t('{login:help_header}');?></h2>
                <p><?php echo $this->t('{login:help_text}');?></p>

			 </div>
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
