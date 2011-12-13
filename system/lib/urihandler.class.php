<?php
/*
@author:    cNicoll
@name:      URIhandler	    
@date:      12-11-09_10|11

RELEASE NOTES:
==========================================================================================
@version 1.0 | 12-11-09_10|11
    - generate the URI index.php/home/link1/link2/link3?var1=v1&var2=v2
    - get the last page and create a page based off the link
    - get the count of pages, how deep one might be in the site
    - create breadcrumb trail
    - hyperlink links to get back

HEADER:
==========================================================================================
public:
	URIhandler()
	getLevelOneURI()
	getURI()
	getCurrentPage()
	getURIcount()
	getCrumbPath()
	getNode($node)
private:
	$uri = array();
	$baseURI
	setSegments()
*/

class URIhandler
{
    private $uri = array();
    private $baseURI;
    
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
    public function URIhandler()
    {
        $this->baseURI = URIPATH.'index.php/';
        $this->setSegments();
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
    public function getLevelOneURI()
    {
        return $this->baseURI;
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
    public function getURI()
    {
        if ($this->getURICount() >= 1)
        {
            $uri = implode("/",$this->uri);
            return URIPATH.'index.php/'.$uri;
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
	* 	12-31-09_09|56
	*/
    private function setSegments()
    {
        $uri = explode('/',$_SERVER['REQUEST_URI']);
        for ($i=0; $i<sizeof($uri); $i++)
        {
            if ($uri[$i] === "index.php") {
                for ($j=$i+1; $j<sizeof($uri); $j++) {
                    $this->uri[] = $uri[$j];
                }
            }
        }
        
        if (
            sizeof($this->uri) == 0 
            || $this->uri[sizeof($this->uri)-1] == NULL 
            || strstr($this->uri[sizeof($this->uri)-1], "?")
            ) {
            	unset($this->uri[sizeof($this->uri)-1]);
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
	* 	12-31-09_09|56
	*/    
    public function getCurrentPage()
    {
        if(sizeof($this->uri) > 0) {
            return $this->uri[sizeof($this->uri)-1];
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
	* 	12-31-09_09|56
	*/    
    public function getURIcount()
    {
        return sizeof($this->uri);
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
    public function getCrumbPath()
    {
    	$crumb = "<a href='".$this->baseURI."'>HOME</a> | ";
        for ($i=0; $i<$this->getURIcount(); $i++) {
            $crumb .= "<a href='".URIPATH.$this->uri[$i]."'>".strtoupper($this->uri[$i])."</a> | ";
        }
        return $crumb;
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
    public function getNode($node)
    {
    	return null;
    }
    
}

?>