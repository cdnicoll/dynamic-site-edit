<?php
/*
@author:    cNicoll
@name:	    model.jQModel.class.php
@date:      02-03-10_15-30

RELEASE NOTES:
==========================================================================================
@version 1.0 | 02-03-10_15-30

HEADER:
==========================================================================================
public:

private:

*/

include_once("sql.class.php");

class JQModel
{
	private $db;

	public function jQModel()
	{
		$this->db = new Database('localhost','root','root','site_edit');
	}
	
	public function updatePanels($table, $column_id, $panel_id, $sort_no)
	{
		$this->db->connect();
		$this->db->update($table, array('column_id'=>$column_id, 'sort_no'=>$sort_no), array('id',$panel_id));
		$this->db->disconnect();
	}
	
	public function updateImages($table, $oldFile, $newFile)
	{
	    $this->db->connect();
		if ($this->db->update($table, array('image'=>$newFile), array('image',$oldFile))) {
	        $this->db->disconnect();
	        return true;
	    }
	    $this->db->disconnect();
	    return false;
		
	}
	
	public function updateModText($table, $id, $col, $text)
	{
	    $this->db->connect();
		if ($this->db->update($table, array($col=>$text), array('id',$id))) {
		    $this->db->disconnect();
		    return true;
		};
		$this->db->disconnect();
		return false;
	}
}



?>