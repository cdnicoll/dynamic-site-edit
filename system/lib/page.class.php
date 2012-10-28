<?php
/*
@author:    cNicoll
@name:	    Page Class
@date:      12-10-09_13|52

RELEASE NOTES:
==========================================================================================
@version 1.0 | 12-10-09_13|52
    - create an html page

HEADER:
==========================================================================================
public:
	Page($l, $opt, $cp=null)
	getLinks()
	loadFile($file)
	createHead()
	createWPhead()
	createBanner()
	createNavBar()
	createBodyContent()
	createFoot()
	closeHTML()
	getPageTitle()
private:
    $currentPager;
    $links = array();
    $options = array();
    $controller;
    $listingControl;
	createPage()
	
*/

include_once('view.class.php'); // parent class


class Page extends View
{
    private $uri;
    private $currentPage;
    private $links = array();
    private $options = array();
    private $controller;
    private $listingControl;
    
    
    /*
	* @param
	*	
	* @return
	*	
	* @comment
	* 	
	* @time
	* 	12-31-09_09|56
	*/
    public function Page()
    {
        parent::View();

        $this->links = parent::getLinks();
        $this->options = parent::getOptions();
        $this->uri = parent::getURIoptions();
        $this->currentPage = $this->uri['current_page'];

        FB::group("Page Options", array('Collapsed' => true, 'Color' => '#00f'));	// Start Group
			FB::log($this->links, '$this->links');
			FB::log($this->options,'$this->options');
			FB::log($this->options['content'],'$this->options[content]');
			FB::log($this->uri,'$this->uri');
		FB::groupEnd();	// End group

        $this->createPage();
    }
    
    /*
    * @param
    *	
    * @return
    *	
    * @comment
    * 	
    * @time
    * 	12-30-09_12|47
    */
    public function getLinks()
    {
        return $this->links;
    }
    
    /*
	* @param
	*	
	* @return
	*	
	* @comment
	* 	
	* @time
	* 	12-31-09_09|56
	*/    
    private function createPage() 
    {
    	$this->createHead();
	        echo '<div id="head_container">';
	        	$this->createBanner();
	        echo '</div>';
	        
	        echo '<div id="body_container" class="body_bg">';
	            $this->createBodyContent();
	        echo '</div>';
	        
	        echo '<div id="foot_container">';
	        	$this->createFoot();
	        echo '</div>';
    	$this->closeHTML();
    }

    // @param string of a file to load into the template
    public function loadFile($file)
	{
		include_once(INC.$file);
	}

    // include the head
    public function createHead()
    {
    	include_once(INC."html.head.html");
    }

    // include the wordpress header
    public function createWPhead()
    {
		include_once(INC."html.head_wp.html");
	}
    
    // create the banner
    public function createBanner()
    {
        include_once(INC."head_banner.inc.html");
    }

    // display the bread crumbs
    private function displayBreadCrumbs()
    {
        if ($this->currentPage != 'home') {
            return $this->uri['bread_crumb'];
        }
    }
    
	// try to load a template for the body based off the current page
	// catch the error and load in the 404 page
    public function createBodyContent()
    {
    	try {
			include_once(INC."body_".$this->currentPage.".inc.html");
		} catch(Exception $e) {
			include_once(INC."body_"."404".".inc.html");
		}
    }
    
    // include the footer
    public function createFoot()
    {
        include_once(INC."foot.inc.html");
    }

    // [ 1 ] close the main container div
    // [ 2 ] output any js footer scripts
    // [ 3 ] close the body
    // [ 4 ] close the html
    // [ 5 ] output buffering end and flush
    public function closeHTML()
    {
        // === [ 1 ] ===
		echo '</div>';
        // === [ 2 ] ===
		echo $this->options['jsFoot'];
        // === [ 3 ] ===
		echo '</body>';
        // === [ 4 ] ===
		echo '</html>';
        // === [ 5 ] ===
		ob_end_flush();
    }
    
    // get the page title
    private function getPageTitle()
    {
        return ucwords(str_replace("_"," ", $this->currentPage));
    }    
}

?>