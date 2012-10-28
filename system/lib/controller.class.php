<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
@author:    cNicoll
@name:	    
@date:      DATE

RELEASE NOTES:
==========================================================================================
@version 1.0 | DATE

HEADER:
==========================================================================================
public:

private:

*/

include_once('model.class.php');
include_once(LIB.'urihandler.class.php');

class Controller
{
	// instance variables
    private $model;
    private $uri;
    private $uriOptions;
    
	// Constructor
	public function Controller()
	{
		$this->model = new Model();
		$this->uri = new URIhandler();
		
		$this->uriOptions = array (
		    'current_page' => $this->uri->getCurrentPage(),
		    'page_deapth' => $this->uri->getURIcount(),
		    'uri_link' => $this->uri->getURI(),
		    'bread_crumb' => $this->uri->getCrumbPath()
		);

	}
	
	// @return uri options array 
    public function getURIoptions()
	{
        return $this->uriOptions;
	}
	
	// @return links
    public function getLinks()
    {
        return $this->model->getLinks();
    }
    
	// @return content for home 
    public function getHomeContent()
    {
        return $this->model->getContent();
    }
    
	// @return panels for the panel page
    public function getPanels()
    {
        return $this->model->getPanels();
    }
    
    // @return images within the database
    public function getImages()
    {
        return $this->model->getImages();
    }
	
	public function getAllTemplatePages()
	{
		return $this->model->getAllTemplatePages();
	}
	
	public function getTemplatePage($id)
	{
		return $this->model->getTemplatePage($id);
	}
	
	public function getTemplateBox($id)
	{
		return $this->model->getTemplateBox($id);
	}
	
	public function getTemplateContent($id)
	{
		return $this->model->getTemplateContent($id);
	}
	
	public function updateText($text)
	{
	    $this->model->updateText($text);
	}
}
?>