<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('REQ_URI', BASEURI.$_SERVER['REQUEST_URI']);
// public

define('CSS', URIPATH.'public/css/');					// DEFINE DIR: css

/* 
example:
    <img src="<?php echo IMG ?>my_image.jpg">
    http://localhost/public/images/
    <img src="http://localhost/public/images/my_image.jpg">
*/
// PUBLIC
define('IMG', URIPATH.'public/images/');				// DEFINE DIR: images	
define('JS', URIPATH.'public/scripts/');				// DEFINE DIR: scripts

// SYSTEM
define('INC', BASEPATH.'system/includes/');			    // DEFINE DIR: includes
define('LIB', BASEPATH.'system/lib/');			        // DEFINE DIR: lib
define('SQL', BASEPATH.'system/sql/');			        // DEFINE DIR: sql

// DATABASE
define('DB', BASEPATH.'database/');
define('DB_URI', URIPATH.'database/');

include_once(LIB.'FirePHPCore/fb.php');                 // include firephp class file.
$fb = new FirePHP();
$fb->setEnabled(false);
FB::setEnabled(false);

if (DEBUGGER) {
	$fb->setEnabled(true);       // enables or disables firephp
	FB::setEnabled(true);
	ini_set('log_errors',TRUE);
	ini_set("error_log", BASEPATH.'system/'."error_log.txt");
	
    $fb->registerExceptionHandler();
    $fb->registerErrorHandler();
}
else {
    $fb->setEnabled(false);       // enables or disables firephp
    FB::setEnabled(false);
	ini_set('log_errors',TRUE);
	ini_set("error_log", BASEPATH.'system/'."error_log.txt");
}

FB::group("config info", array('Collapsed' => true, 'Color' => '#00f'));	// Start Group
   FB::log(BASEPATH, 'BASEPATH');
   FB::log(URIPATH, 'URIPATH');
  FB::LOG(REQ_URI, 'REQ_URI');
 	FB::info("==== PUBLIC ====");
   FB::log(IMG, 'IMG');
   FB::log(JS, 'JS');
   FB::info("==== SYSTEM ====");
   FB::log(INC, 'INC');
   FB::log(LIB, 'LIB');
   FB::log(SQL, 'SQL');
	FB::info("==== DATABASE ====");
   FB::log(DB, 'DB');
   FB::log(DB_URI, 'DB_URI');
FB::groupEnd();	// End group

$db_info = array(
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'site_edit'
);


/*
to use:
    $db_info = unserialize(DB_INFO);
    echo $db_info['host'];
    echo $db_info['username'];
    echo $db_info['password'];
    echo $db_info['database'];

	$this->db = new Database($db_info['host'], $db_info['username'], $db_info['password'], $db_info['database']);
*/
define('DB_INFO', serialize($db_info));
?>