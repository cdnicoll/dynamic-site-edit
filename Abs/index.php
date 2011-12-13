<?php include("lib/Bootstrap.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title ?> | Advanced Backup System</title>
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<script src="js/jquery.js" type="text/javascript" language="javascript"></script>
<script src="js/default.js" type="text/javascript" language="javascript"></script>
<meta content="Wim Mostmans (Sitebase)" name="author" />
<meta content="2009 Sitebase.be" name="copyright" />
<meta content="Wim Mostmans" name="publisher" />
<meta name="robots" content="noindex, nofollow" />
<meta content="English" name="language" />
</head>
<body>
<div id="wrapper">

<div id="header">
 <a href="index.php"><img src="images/icon.png" alt="plus icon" width="128" height="128" border="0"/></a>
 <div class="content">
   <h1>Advanced Backup System</h1>
   <p>Manage backups and website versions with this PHP application</p>
 </div>


</div>
<div id="shadow"><!----></div>
<div id="maincontent">
	<?php if($current_page != "home" && $current_page != "login"){ ?>
		<a href="index.php" id="back">back</a>
    <?php } ?>
 <?php include($current_page_path); ?>
</div>

</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2072779-17");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html> 