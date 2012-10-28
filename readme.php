<?php
exit('No direct script access allowed');
/*


@author:    cNicoll
@title:     CMS

Release Notes
==========================================================================================
@version 2.3.2 | 01-08-10_11-51
    - Added FirePHP for debugging
        - see http://www.firephp.org/ on how to use
    - removed header debug message

@version 2.3.1 | 01-04-10_15|30
    - Added a error log. This _ALWAYS_ will take place, even if the debugger is set to false
        - The file is located within the system folder.

@version 2.3 | 12-31-09_12|14
    - Added database information to the config file.
    - Modified controller, it no longer displays the page, rather is the bridge between model and view classes
    - Added URI class which checks the current URI for various attributes
    - Added a view class that will generate the css/js/content depending on the current page
    - Added page class in which will now create the page
    

@version 2.2 | 12-10-09_11|57
    - removed script to check directory for security
        - replaced this with .htaccess file
        # disable directory browsing
        Options All -Indexes

@version 2.1 | 12-01-09_14|56
    - Removed header from index.php. Moved to head_main.inc.html in the includes
    - Modified the debug php to better suit a debug message
    - added global modifers for BASEURL, URIPATH and DEBUGGER
        - BASEPATH: path to the system folders 
        - URIPATH:  used to retrive everything from the public folder
        - DEBUGGER: bool statement. true if debug and error messages are to be shown,
                    false if wanting to hide
    - Added Model Class
        - This will talk to the Database and send information to the controller
    - Added Controller Class
        - This will be the bridge between the website and the database, information is to be
        passed to and from this class.
        - Website should never talk to the database without accessing the controller.
    - Removed pre from zeroOut.css

@version 2.0 | 12-01-09_14|27
    - BASEPATH is now definded in one location (index.php) and passed into config.lib.php
    - Added switch statements to index.php
    - Added security index.php pages through out the site to precent outside script access
    
@version 1.1 | 11-23-09_10|43
    

@version 1.0 | 07-15-09_13|08

 
*/
?>