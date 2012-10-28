<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);

session_start();
ob_start();
define('BASEPATH', $_SERVER['DOCUMENT_ROOT'].'/');      // CHANGE TO THE PATH OF THE SITE.

// ====================================================================================================

define('BASEURI', 'http://dynamicsiteedit.local');
define('URIPATH', 'http://dynamicsiteedit.local/');

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