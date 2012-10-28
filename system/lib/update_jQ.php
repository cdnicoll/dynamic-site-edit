<?php
if (!isset($_POST["action"])) {
	// no outside access
	exit;
}
include_once('model.jQModel.class.php');
$model = new jQModel();

switch ($_POST["action"]) {
    
    // ====================================================================================================
    // ====================================================================================================
    case "updatePanels":
        // decode JSON data received from AJAX POST request
        $data = $_POST['data'];
        $json = str_replace('\\','',$data);
        $decode = json_decode($json);
        // ===========================

        foreach($decode->items as $item)
        {
            $col = preg_replace('/[^\d\s]/', '', $item->column);

        	$table = $item->table;
        	$column_id = $column_id = ($col == 0 ? 1 : $col);       // check if column id has a value, if it doesnt set the value to 1
        	$panel_id = preg_replace('/[^\d\s]/', '', $item->id);
        	$sort_no = $item->order;
			
        	/*
             echo '<pre>';
                         echo ' || $table = '.$table;
                         echo ' || $column_id = '.$column_id;
                         echo ' || $panel_id = '.$panel_id;
                        echo ' || $sort_no = '.$sort_no;
             echo '</pre>';
			*/
        	
        	$model->updatePanels($table, $column_id, $panel_id, $sort_no);
        }

        echo "success";
    break;
    
    // ====================================================================================================
    // ====================================================================================================
    case "updateModText":
        
        $table =  $_POST['table'];
        $id = $_POST['id'];
        $col = $_POST['column'];
        
        $text = htmlentities($_POST['text']);
          
        // echo $table;
        // echo '|====|';
        // echo $id;
        // echo '|====|';
        // echo $col;
        // echo '|====|';
        // echo $text;  
                
        if ( $model->updateModText($table,$id, $col, $text) ) {
            echo "success";
        }
    break;
    
    // ====================================================================================================
    // ====================================================================================================
    case "updateImages":
        
        $table = $_POST['table'];
        
        $file_path = '../'.$_POST['file_path'].'/';
        $trash_path = '../../database/_trashed/';
        
        $oldFile = $_POST['oldFile'];
        $newFile = $_POST['newFile'];
        
        // 03-08-10_16|15|48__9.png.bak
        $backUpName = date("m-d-y_H|i|s")."__".$oldFile.".bak";
        
        $fileToDelete = $file_path.$oldFile;
        $fileToBackup = $trash_path.$backUpName;
        
        echo '$table: '.$table.PHP_EOL;
        echo '|====|'.PHP_EOL;
        echo '$oldFile: '.$oldFile.PHP_EOL;
        echo '|====|'.PHP_EOL;
        echo '$newFile: '.$newFile.PHP_EOL;
        echo '|====|'.PHP_EOL;
        echo '$file_path: '.$file_path.PHP_EOL;
        echo '|====|'.PHP_EOL;
        echo '$trash_path: '.$trash_path.PHP_EOL;
        echo '|====|'.PHP_EOL;
        echo '$fileToDelete: '.$fileToDelete.PHP_EOL;
        echo '|====|'.PHP_EOL;
        echo '$fileToBackup: '.$fileToBackup.PHP_EOL;
        
        
       if ( $model->updateImages($table, $oldFile, $newFile) ) {
           // copy, rename, and move the file
           copy($fileToDelete, $fileToBackup);
           // delete the file
           unlink($fileToDelete);           
           echo "success";
       }
    break;
    
    
}
?>