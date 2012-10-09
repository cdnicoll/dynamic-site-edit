<?php
/*
@author:    cNicoll
@name:	    view.class.php
@date:      12-10-09_13|07

RELEASE NOTES:
==========================================================================================
@version 1.1 | 12-30-09_09|54
	- changed how the CSS and JS are handeld. They are now stored within an array that will
	change depedning on the page.
	- This will allow for specific CSS and JS to be loaded in special cases.

@version 1.0 | 12-10-09_13|07
    - Generates the files loaded into the header based off
    if the user is logged in or not.
    
HEADER:
==========================================================================================
public:
    View()
    setOptions($loggedIn, $deapth, $currentPage=null)
    getOptions()
    getCSS();
    getJS();
    cssEdit()
private:
    $controller
	$options = array();
	$css = array();
	$js = array();
	cssNormal()
	pageSpecificScript()
    jsNormal($currentPage)
    cssEdit()
    jsEdit()
	setBackground($deapth)

*/

include_once(LIB.'controller.class.php');
include_once(LIB.'login.class.php');
include_once(LIB.'cookie.class.php');

class View
{
	// Instance Variables
	private $controller;
	private $listingController;
    private $errors = array();
    private $options = array();		// Holds options for the view. IE what CSS/JS is to be loaded
    private $cssHead = array();
    private $jsHead = array();
    private $content = array();
    private $jsFoot = array();
    private $cookie;
    private $loggedIn;
    
    // @param loggedIn
    //		bool if the user is logged in or not
    // @param deapth
    //		the deapth of the breadcrumb trail. This is to set the page background
    // This funciton loads a view depending on what view is loaded.
    public function View()
    {   
        $this->controller = new Controller();
        $local_cookie = new Cookie();
        $this->cookie = $local_cookie->getCookieInfo();
        
        /*
        1. if there is a session
            - change the logged in status to TRUE
            - display a log out button (hide the login button)
        2. if there is not a session
            - show the login button
            - allow the user to login, test for cookie information
        */
        if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
            $this->setLogIn(true);
            FB::group("session_info", array('Collapsed' => true, 'Color' => '#00f'));	// Start Group
                FB::log($_SESSION['user_id'], 'user_id');
                FB::log($_SESSION['username'], 'username');
            FB::groupEnd();	// End group
        }
        
        
        
        if (isset($_REQUEST['action'])) 
		{
		    FB::group("cookie_login", array('Collapsed' => true, 'Color' => '#00f'));    // Start Group
		    switch ($_REQUEST['action'])
            {
                // ====================================================================================================
                // ====================================================================================================
                case 'login':
                    $login = new Login();
                    
                    $username = htmlspecialchars($_POST['username']);
                    FB::log($username, 'username');
                    
                    $passwordArr = array(
                        'form'=>htmlspecialchars(sha1($_POST['password'])),
                        'passkey'=>sha1($this->cookie['password']),
                        'db'=>$login->checkCookie($_POST['cookie_id'], $username)
                    );
                    FB::log($_POST['cookie_id'], '$_POST[cookie_id]');
                    FB::log($passwordArr, 'passwordArr');
                                        
                    $password = ($passwordArr['form'] != $passwordArr['passkey'] ? $passwordArr['form'] : $passwordArr['db']);
                    FB::log($password, 'password');
                    
                    $remember = (isset($_POST['remember']) ? true : false);
                    FB::log($remember, 'remember me');
                    
                    if ($username=="" || $password=="") {
                        $this->setError("empty username or password");
                    }
                    else if($login->userLogin($username, $password, $remember)) {
                        // LOGGED IN!! IF THIS IS TRUE GOOD THINGS HAVE JUST HAPPENED!
                        $this->setLogIn(true);
                    }
                    else {
                        $this->setError("username AND password do not match");
                    }
                    FB::log($this->getErrors(), 'errors');
                   
                break;
                
                // ====================================================================================================
                // ====================================================================================================
                
                case 'logout':
                    $logout = new Login();
                    $logout->userLogout();
                    $this->setLogIn(false);
                    FB::log($this->getIsLoggedIn(), "logout trigger'd");
                break;
                
                // ====================================================================================================
                // ====================================================================================================
                
                case 'update':
                    $this->controller->updateText($_POST['myeditor']);
                break;
                
                
            }
            FB::groupEnd();  // End group
		}
		else if (!isset($_SESSION['user_id']) && !isset($_SESSION['username'])) {
		    // There has been no attempt at login, don't set login to true.
		    $this->setLogIn(false);
		}
		
		$this->cssNormal();
		$this->jsNormal();
		$this->setOptions($this->getURIoptions());
    }
    
    
    
	// @return error array
	public function getErrors()
	{
	    return $this->errors;
	}
	
	// @param error to put in error array
	public function setError($e)
	{
	    $this->errors[] = $e;
	}
	
	/*
	* @param
	*	
	* @return
	*	
	* @comment
	* 	
	* @time
	* 	12-30-09_09|53
	*/    
    public function setOptions($uri)
    {   
        // If the bool is set to true, load additional scripts.
        if ($this->getIsLoggedIn()) {
            $this->userLoggedInGlobal();
        }
        
        $this->pageSpecificScript($uri['current_page']);
        $this->options = array(
        	'logged_in' => $this->getIsLoggedIn(),
        	'error' => $this->getErrors(),
        	'cookieInfo' => $this->getCookie(),
            'cssHead' => $this->getCSShead(),
            'jsHead' => $this->getJShead(),
            'content' => $this->getContent(),
            'jsFoot' => $this->getJSfoot()
        );
    }
    
    // @return array of cookie information
    public function getCookie()
    {
        return $this->cookie;
    }
    
	// @return options
    public function getOptions()
    {
        return $this->options;
    }
    
    // return uri options array
    public function getURIoptions()
    {
        return $this->controller->getURIoptions();   
    }
    
	// @return css 
    public function getCSShead()
    {
    	return implode($this->cssHead);
    }
    
    // @return javascript
    public function getJShead()
    {
    	return implode($this->jsHead);
    }
    
    // @return content
    public function getContent()
    {
        return ($this->content);
    }
    
    // @return JS in footer
    public function getJSfoot()
    {
        return implode($this->jsFoot);
    }
    
   //@param bool for login
    public function setLogIn($login)
    {
        $this->loggedIn = $login;
    }
    
    // @return logged in status
    public function getIsLoggedIn()
    {
        return $this->loggedIn;
    }
    
    /*
    * @param
    *	
    * @return
    *	
    * @comment
    *   if the user is logged in, this funnction is called. It loads the scripts needed to edit pages.
    *   _NOTE_: when connecting to the database, or editing there _HAS_ to be constant checks on the status.	
    * @time
    * 	01-21-10_13-32
    */
    public function userLoggedInGlobal()
    {
        $this->cssHead[] = '<link rel="stylesheet" type="text/css" href="'.CSS.'loggedIn.css"/>';
       
        $this->jsHead[] = '<script type="text/javascript" src="'.JS.'windowget.js"></script>';
 		$this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.json-2.2.min.js"></script>';
        $this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery-ui-1.7.2.custom.min.js"></script>';
        $this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.metadata.js"></script>';
        
        //$this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.editField.js"></script>';
        
   

	}
    
	/*
	* @param
	*	
	* @return
	*	
	* @comment
	* 	
	* @time
	* 	12-30-09_09|53
	*/
    private function cssNormal()
    {
        $this->cssHead[] = '<link rel="stylesheet" type="text/css" href="'.CSS.'zeroOut.css"/>';
        $this->cssHead[] = '<link rel="stylesheet" type="text/css" href="'.CSS.'main.css"/>';
        $this->cssHead[] = '<link rel="stylesheet" type="text/css" href="'.CSS.'head.css"/>';
        $this->cssHead[] = '<link rel="stylesheet" type="text/css" href="'.CSS.'body.css"/>';
        $this->cssHead[] = '<link rel="stylesheet" type="text/css" href="'.CSS.'foot.css"/>';
    }
    
    /*
	* @param
	*	
	* @return
	*	
	* @comment
	* 	
	* @time
	* 	12-30-09_09|53
	*/
    private function jsNormal()
    {
        //$this->jsHead[] = '<script type="text/javascript" src="'.JS.'YOUR_FILE"></script>';
        $this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.js"></script>';					// used all over the place
        // Block UI
        $this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.blockUI.js"></script>';
		$this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.preload.js"></script>';
        
        // JS First Load
        $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jq.runtime.main.js"></script>';
        $this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.imagecrop.js"></script>';
        
    }
    
    /*
	* @param
	*	
	* @return
	*	
	* @comment
	* 	- checks the current page and generates the css and JS needed for that page
	*	- content is passed as an option and can be retrieved in 1 ways
	            1. $var2 = $this->options['content']['content_name'];
	*   _ISSUE_: the problem here is that the links are not dynamic... if for
	*			whatever reason the link name changes, it will need to change
	*			here too.	
	* @time
	* 	12-30-09_10|02
	*/
    private function pageSpecificScript($currentPage)
    {
        switch($currentPage)
    	{
    	    case 'home':
    	        $this->content['info'] = $this->controller->getHomeContent();
                if ($this->getIsLoggedIn()) {
    	            // add content if the user is logged in
    	            $this->jsHead[] = '<script type="text/javascript" src="'.JS.'ckeditor/ckeditor.js"></script>';
    	            
    	            $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jquery.editText.js"></script>';
    	            $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jq.runtime.home.js"></script>';
    	        }
    	    break;
	        
	        case 'panels':
                $this->content['panels'] = $this->controller->getPanels();
                if ($this->getIsLoggedIn()) {
    	            // add content if the user is logged in
    	            $this->jsHead[] = '<script type="text/javascript" src="'.JS.'ckeditor/ckeditor.js"></script>';
    	            $this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.panelGroup.js"></script>';
    	            
    	            $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jquery.editText.js"></script>';
    	            $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jq.runtime.panels.js"></script>';
    	        }
    	    break;
    	    
    	    case 'images':
    	        $this->content['images'] = $this->controller->getImages();
    	        if ($this->getIsLoggedIn()) {
    	            // add content if the user is logged in
    	            $this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.panelGroup.js"></script>';
    	            // uploadify
    	            $this->jsHead[] = '<script type="text/javascript" src="'.JS.'uploadify/swfobject.js"></script>';
                    $this->jsHead[] = '<script type="text/javascript" src="'.JS.'uploadify/swfobject.js"></script>';
                    $this->jsHead[] = '<script type="text/javascript" src="'.JS.'uploadify/jquery.uploadify.v2.1.0.min.js"></script>';
    	            
    	            
    	            $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jq.runtime.images.js"></script>';
    	            $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jq.imageSwap.js"></script>';
    	        }
    	    break;
    	    
    	    case 'upload':
    	        
    	         if ($this->getIsLoggedIn()) {
    	             // add content if the user is logged in
            		$this->cssHead[] = '<link rel="stylesheet" type="text/css" href="'.CSS.'jquery.uploadify.css"/>';

                    $this->jsHead[] = '<script type="text/javascript" src="'.JS.'uploadify/swfobject.js"></script>';
                    $this->jsHead[] = '<script type="text/javascript" src="'.JS.'uploadify/jquery.uploadify.v2.1.0.min.js"></script>';

                    $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jq.runtime.upload.js"></script>';
                }
    	    break;

			case 'template_page':
				$this->content['pages'] = $this->controller->getAllTemplatePages();
				if ($this->getIsLoggedIn()) {
    	            // add content if the user is logged in
    	        }
			break;
			
			case 'template_page_detail':
				$this->content['page'] = $this->controller->getTemplatePage($_GET['id']);
				$this->content['box'] = $this->controller->getTemplateBox($_GET['id']);
				$this->content['content'] = $this->controller->getTemplateContent($_GET['id']);
				if ($this->getIsLoggedIn()) {
    	            // add content if the user is logged in
    	            $this->cssHead[] = '<link rel="stylesheet" type="text/css" href="'.CSS.'jquery.uploadify.css"/>';

                    $this->jsHead[] = '<script type="text/javascript" src="'.JS.'uploadify/swfobject.js"></script>';
                    $this->jsHead[] = '<script type="text/javascript" src="'.JS.'uploadify/swfobject.js"></script>';
                    $this->jsHead[] = '<script type="text/javascript" src="'.JS.'uploadify/jquery.uploadify.v2.1.0.min.js"></script>';
    	            
    	            $this->jsHead[] = '<script type="text/javascript" src="'.JS.'ckeditor/ckeditor.js"></script>';
    	            $this->jsHead[] = '<script type="text/javascript" src="'.JS.'jquery.panelGroup.js"></script>';
    	            
    	            $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jquery.editText.js"></script>';
    	            $this->jsFoot[] = '<script type="text/javascript" src="'.JS.'jq.runtime.template.js"></script>';
    	        }
			break;
    	}
    }
    
    /*
    * @param
    *	
    * @return
    *	
    * @comment
    * 	
    * @time
    * 	12-30-09_12|44
    */
    public function getLinks()
    {
        return $this->controller->getLinks();
    }
    
    
}

?>