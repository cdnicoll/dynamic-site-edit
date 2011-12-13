<?php
include_once('model.jQModel.class.php');
$model = new jQModel();

$oldFile = $_POST['oldFile'];
$newFile = $_POST['newFile'];

$model->updateImages($oldFile, $newFile);

?>