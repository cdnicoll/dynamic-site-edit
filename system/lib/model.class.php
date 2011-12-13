<?php

include_once('sql.class.php');

class Model
{
    private $db;    // Hold a database object
    
    public function Model()
    {
		$db_info = unserialize(DB_INFO);
	    $this->db = new Database($db_info['host'], $db_info['username'], $db_info['password'], $db_info['database']);
    }
    
    /*
    function showing a select where all conent is obtained and the
    city name is vancouver
    */
    public function getLinks()
	{
		$r = array();
		$this->db->connect();
		if($this->db->select('links', '*', 'active = "1"', 'id')) {
			$r = $this->db->getResult();
		}
		$this->db->disconnect();
		return $r;
	}
    
    public function getContent()
    {
        $this->db->connect();
        //($table, $rows, $where, $order, $limit)
	    if($this->db->select('content','id, title, content')) {
    	    $r = $this->db->getResult();
	    }
	    $this->db->disconnect();    // disconnect from DB
	    
	    return $r;    // return the results
    }
    
    public function getPanels()
    {
        $this->db->connect();
        //($table, $rows, $where, $order, $limit)
    	if ($this->db->select('widgets','*',null, 'sort_no')) {
            $r = $this->db->getResult();
    	}
    	$this->db->disconnect();    // disconnect from DB
	    return $r;    // return the results
    }
    
    public function getImages()
    {
        $this->db->connect();
        //($table, $rows, $where, $order, $limit)
    	if ($this->db->select('images','*', null, 'sort_no')) {
            $r = $this->db->getResult();
    	}
    	$this->db->disconnect();    // disconnect from DB
	    return $r;    				// return the results
    }

	public function getAllTemplatePages()
	{
		$this->db->connect();
        //($table, $rows, $where, $order, $limit)
    	if ($this->db->select('template_page','id, desc_title')) {
            $r = $this->db->getResult();
    	}
    	$this->db->disconnect();    // disconnect from DB
	    return $r;    				// return the results
	}
	
	public function getTemplatePage($id)
	{
		$this->db->connect();
        //($table, $rows, $where, $order, $limit)
    	if ($this->db->select('template_page','id, desc_title, descr, stats_title, stats','id = "'.$id.'"')) {
            $r = $this->db->getResult();
    	}
    	$this->db->disconnect();    // disconnect from DB
	    return $r;    				// return the results
	}
	
	public function getTemplateBox($id)
	{
		$this->db->connect();
        //($table, $rows, $where, $order, $limit)
    	if ($this->db->select('template_box','*', 'page_id = "'.$id.'"', 'sort_no', NULL)) {
            $r = $this->db->getResult();
    	}
    	$this->db->disconnect();    // disconnect from DB
	    return $r;    				// return the results
	}
	
	public function getTemplateContent($id)
	{
		$this->db->connect();
        //($table, $rows, $where, $order, $limit)
    	if ($this->db->select('template_content','*', 'page_id = "'.$id.'"', 'sort_no',null)) {
            $r = $this->db->getResult();
    	}
    	$this->db->disconnect();    // disconnect from DB
	    return $r;    				// return the results
	}
    
    // @param $u - username
    // @param $p - password
    // @return $user - array of the user (without password)
    // @return -1 - failed function
    // @comment:[1] connect to the database and get an array based off the user
    //          [2] check the size is greater than 1 (there is content in the array)
    //          [3] check if $p matches the password in the array if it does...
    //          [3.1] unset the password from the array and return the array with ID and username
    //          [4] passwords did not match, so return -1
 	public function checkLogin($u,$p)
    {
        $user = array();
    	$this->db->connect();
	    // === [1] ===
	    if($this->db->select('users','user_id, username, password', 'username="'.$u.'"', NULL, NULL)) {
	        $user = $this->db->getResult();
	    }
	    $this->db->disconnect();    // disconnect from DB
        FB::log($user, 'method->checkLogin()');
        
        // === [2] ===
	    if (sizeof($user) >= 1) {
	        // === [3] ===
            if ($p == $user['password']) {
                // === [3.1] ===
                unset($user['password']);
                return $user;
            }
	    }
	    // === [4] ===
	    return -1;
    }
    
    // @param username to retreive
    // @return array of the user (with password)
    public function checkCookie($u)
    {
        $user = array();
    	$this->db->connect();
    	if($this->db->select('users','user_id, password', 'username="'.$u.'"', NULL, NULL)) {
    	    $user = $this->db->getResult();
	    }
	    $this->db->disconnect();
	    return $user;
    }
    
    public function updateText($text)
    {
        echo $text;
    }
}
?>