<?php

require 'PHPMp4/PHPMp4.php';

$video = new \PHPMp4\PHPMp4('test.wmv');

try{
	$video->convertVideo();
	echo 'done';
	
}catch(Exception $e){
	echo 'error '.$e->getMessage();
}

?>