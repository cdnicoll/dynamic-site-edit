<?php
session_start();
ob_start();
define('BASEPATH', $_SERVER['DOCUMENT_ROOT'].'/DynamicSiteEdit/www/');      // CHANGE TO THE PATH OF THE SITE.

// ====================================================================================================

define('BASEURI', 'http://localhost');
define('URIPATH', 'http://localhost/DynamicSiteEdit/www/');

// ====================================================================================================

// FOR HOSTING FROM AN IP ADDRESS UNCOMMENT BELOW AND ALSO EDIT THE FOLLOWING SCRIPTS:
// - jquery.runtime.images.js
// - jquery.runtime.upload.js
// - jquery.editField.js
// - jquery.panelGroup.js

//define('BASEURI', 'http://192.168.0.141');   
//define('URIPATH', 'http://192.168.0.141/DynamicSiteEdit/www/');

define ('DEBUGGER', true);  // CHANGE TO FALSE TO HIDE DEBUG MESSAGES

include(BASEPATH.'system/lib/config.lib.php');
include_once(LIB.'page.class.php');

$page = new Page();
?>