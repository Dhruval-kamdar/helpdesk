<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		<!-- Basic -->
		<meta charset="utf-8">
		<?php
			$itemId = $_REQUEST['itemId'];
			$uriAddy = $_SERVER['REQUEST_URI'];
			if(strpos($uriAddy, 'product-for-sale') == true && !empty($canonicalize)){
				echo "<link rel=\"alternate\" hreflang=\"en\" href=\"https://www.chulavistacoins.com$uriAddy\" />";
				echo "<link rel=\"canonical\" href=\"https://www.chulavistacoins.com$canonicalize\" />";
			} elseif(strpos($uriAddy, '&page=') == true){
				$uriAddy = strstr($uriAddy, '&page=', true);
				echo "<link rel=\"alternate\" hreflang=\"en\" href=\"https://www.chulavistacoins.com$uriAddy\" />";
				echo "<link rel=\"canonical\" href=\"https://www.chulavistacoins.com$uriAddy\" />";
			} else {
				echo "<link rel=\"alternate\" hreflang=\"en\" href=\"https://www.chulavistacoins.com$uriAddy\" />";
				echo "<link rel=\"canonical\" href=\"https://www.chulavistacoins.com$uriAddy\" />";
			}
		?>
		<title><?php echo $title; ?></title>
		<meta name="keywords" content="<?php echo $keywords; ?>"/>
		<meta name="description" content="<?php echo $description; ?>"/>
		<meta name="revisit-after" content="7 days">
		<meta name="robots" content="index, follow">
		<meta name="googlebot" content="noodp">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Favicons -->
		<link rel="shortcut icon" href="img/favicon.ico">
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png">
		<!-- Head Libs -->
		<!--[if IE]>
			<link rel="stylesheet" href="css/ie.css">
		<![endif]-->
		<!--[if lte IE 8]>
			<script src="vendor/respond.js"></script>
		<![endif]-->
		<?php echo $headerlinks; ?>
		<!-- Facebook Pixel Code -->
		<script type="text/javascript">
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1571784762854799'); // Insert your pixel ID here.
		//fbq('track', 'PageView');
		</script>
	<script>fbq('track', 'PageView', { });</script>
		<!-- Google Tracking -->
		<script type="text/javascript">
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-101648748-1', 'auto');
		  ga('send', 'pageview');

		</script>
		
		<!-- AMP
		`<script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "NewsArticle",
        "headline": "Open-source framework for publishing content",
        "datePublished": "2015-10-07T12:02:41Z",
        "image": [
          "images/Chula-Vista-Coin-Stamp-and-collectables-san-diego-logo.png"
        ]
      }
    </script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript> -->
  
		
		
	</head>