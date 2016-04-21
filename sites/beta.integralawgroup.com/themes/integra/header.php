<?php
	global $base_path;
	$themePath = $base_path.path_to_theme();
?>
<?php $requestUri = $_SERVER['REQUEST_URI']; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
<?php if($requestUri == "/about") { ?>
	<title>Business Estate Planning & Bankruptcy Law</title>
	<meta name="keywords" content="lawyer, attorney, business planning, estate planning, elder law, Medicaid, foreclosure, bankruptcy" />
	<meta name="description" content="Our goal is to protect your financial future.  We also save you time and money" />
<? /* RYAn Edit */ ?>
<?php } else if( strpos($requestUri, "selling_a_business") ) { ?>
        <title>Selling a Business</title>
        <meta name="keywords" content="Selling a Business, business for sale, businesses for sale, business brokerage, exit strategy" />
        <meta name="description" content="We provide the professional help you need to sell your business." />

<? /* Ryan Edit End */ ?>
<?php } else if( strpos($requestUri, "business-planning-exit-strategies") ) { ?>
	<title>Business Planning & Exit Strategies</title>
	<meta name="keywords" content="business attorney, business lawyer, buying business, selling business, business for sale, exit strategy" />
	<meta name="description" content="We help clients with business planning, and buying & selling businesses." />
<?php } else if( strpos($requestUri, "estate-planning-asset-protection") ) { ?>
	<title>Estate Planning & Elder Law</title>
	<meta name="keywords" content="estate planning lawyer, estate planning attorney, will, trust, probate, avoid probate, Medicaid, VA benefits, elder law" />
	<meta name="description" content="We prepare wills and trusts and help with Medicaid planning and asset protection." />
<?php } else if( strpos($requestUri, "attorney-bankruptcy-debt-relief") ) { ?>
	<title>Bankruptcy Law</title>
	<meta name="keywords" content="foreclosure, bankruptcy, bankruptcy lawyer, bankruptcy attorney, debt collection, debt relief" />
	<meta name="description" content="We help people stop foreclosure stop debt collection and file bankruptcy." />
<?php } else if( strpos($requestUri, "healthcare-capital") ) { ?>
	<title>Healthcare Capital</title>
<?php } else { ?>
	<title><?php //print $head_title ?></title>
<?php } ?>
<?php print $head ?>
<?php // print $styles ?>
<?php // print $scripts ?>

<link rel="stylesheet" type="text/css" href="/sites/integralawgroup.com/themes/integra/style.css" />
<!--<script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */  ?> </script>
<script type="text/javascript" src="/sites/integralawgroup.com/themes/integra/javascripts/prototype.js"></script>
<script type="text/javascript" src="/sites/integralawgroup.com/themes/integra/javascripts/scriptaculous.js"></script>
 -->
<script type="text/javascript" src="/sites/integralawgroup.com/themes/integra/javascripts/swfobject.js"></script>
<script type="text/javascript" src="/sites/integralawgroup.com/themes/integra/javascripts/swfobject1.js"></script>
<script type="text/javascript" src="/sites/integralawgroup.com/themes/integra/javascripts/form.js"></script>
<script type="text/javascript" src="/sites/integralawgroup.com/themes/integra/accordion/script.js"></script>
<script type="text/javascript" src="/sites/integralawgroup.com/themes/integra/scroller/slider.js"></script>
<!--[if IE]>
<style type="text/css" media="all">.borderitem {border-style:solid;}</style>
<![endif]-->
</head>
<body onload="initialize()" onunload="GUnload()">
<div id="header">
<a href="/" class="logo"><img src="<?php echo $themePath; ?>/images/logo.gif" width="278" height="124" alt="Welcome to Integra Law Group" title="Welcome to Integra Law Group" /></a>

<div class="sloganPan">AFFORDABLE PROFESSIONAL <br  />LEGAL SERVICES</div>

<a href="/contact-us" class="contact"><img src="<?php echo $themePath; ?>/images/our_phone.gif" width="206" height="124" alt="Contact" title="Contact Us" /></a>


<!-- Old 1-14-10
<a href="/"><img src="<?php echo $themePath; ?>/images/logo.gif" width="330" height="124" alt="Welcome to Integra Law Group" title="Welcome to Integra Law Group" /></a><img src="<?php echo $themePath; ?>/images/slogan.gif" width="434" height="124" alt="INTEGRA IS A VIRTUAL LAW FIRM - We save you time and money." title="INTEGRA IS A VIRTUAL LAW FIRM - We save you time and money." /></a><img src="<?php echo $themePath; ?>/images/our_phone.gif" width="206" height="124" alt="Our Phone - (208) 368 9000" title="Our Phone - (208) 368 9000" />
-->

<!-- Really old 	<a href="/"><img src="<?php echo $themePath; ?>/images/logo.gif" width="330" height="140" alt="Welcome to Integra Law Group" title="Welcome to Integra Law Group" /></a><img src="<?php echo $themePath; ?>/images/slogan.gif" width="434" height="140" alt="INTEGRA IS A VIRTUAL LAW FIRM - We save you time and money." title="INTEGRA IS A VIRTUAL LAW FIRM - We save you time and money." /></a><img src="<?php echo $themePath; ?>/images/our_phone.gif" width="206" height="140" alt="Our Phone - (208) 368 9000" title="Our Phone - (208) 368 9000" /> -->
</div>
<div id="menu">
	<ul id="top-tabs">

                <li id="tab_purple"><a href="/about">About Us</a></li>
                <li id="tab_green"><a href="/business-planning-exit-strategies">Acquiring a Business <br />& Asset Protection</a></li>
                <li id="tab_orange"><a href="/selling_a_business">Exit Strategies &<br />Selling Your Business</a></li>
                <li id="tab_blue"><a href="/estate_planning">Estate Planning</a></li>
                <li id="tab_red"><a href="http://www.boise-bankruptcy-attorney.com/" target="_blank">Bankruptcy Protection<br /> &amp; Debt Relief</a></li>
                <li id="tab_yellow"><a href="/family-law">Family Law</a></li>


<!-- Old 1.14.10
                <li id="tab_purple"><a href="/about">About Us</a></li>
                <li id="tab_green"><a href="/business-planning-exit-strategies">Business Planning</a></li>
		<li id="tab_orange"><a href="/selling_a_business">Selling a Business</a></li>
                <li id="tab_blue"><a href="/estate-planning-asset-protection">Estate Planning<br />&amp; Long-Term Care</a></li>
                <li id="tab_red"><a href="http://www.boise-bankruptcy-attorney.com" target="_blank">Debt Reduction <br /> Strategies</a></li>
                <li id="tab_yellow"><a href="/contact-us">Contact Us</a></li>
-->

	</ul>
</div>
<div class="clear"></div>
