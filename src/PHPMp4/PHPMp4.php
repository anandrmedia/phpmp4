<?php
/*
 * PHPMP4
 *
 * (c) Anand S <anand@cloudfoyo.com>
 * For licence information, please view the LICENCE file distributed along with this source code
 */
 
namespace PHPMp4;
use \Exception;

class PHPMp4{
	
	/** @var InputFileName */
	private $inputFile;
	
	/** @var OutputFileName */
	private $outputFile;
	
	/** @var EncoderBinary */
	private $encoder = 'avconv';
	
	/** @var SupportedExtensions */
	private $supportedExtensions = array('avconv','ffmpeg');
	
	
	public function __construct($fileName,$encoder=NULL){
		
		if(file_exists($fileName)){
			$this->inputFile = $fileName;
		}else{
			throw new Exception("Input file not found");
		}
		if($encoder){
			$this->setEncoder($encoder);
		}
	
	}
	
	/**
	 * Sets output fileName
	 * @param string $fileName input filename
	 */
	public function setOutputFile($fileName){
		
		$this->outputFile = $fileName;
	
	}
	
	/**
	 * Sets EncoderType 
	 * @param $encoder Encoder Type. ffmpeg or avconv
	 * @throws Exception
	 */
	public function setEncoder($encoder){
		
		if(!in_array($this->supportedExtensions,$encoder)){
			throw new Exception("Invalid encoder specified. Use ffmpeg or avconv"); 
		}else{
			$this->encoder = $encoder;
		}
		
	}
	
	/**
	 * Convert video and save the file
	 * @return true|false
	 * @throws Exception
	 */
	 
	public function convertVideo(){
	
		if($this->outputFile != NULL){
			
			$saveFile = $this->outputFile;
			
		}else{
			
			$fileName = explode('.',$this->inputFile);
			
			$saveFile = $fileName[0].'.mp4';
		}
		
		exec("$this->encoder -i $this->inputFile -codec:v libx264 -profile:v high -preset slow -b:v 500k -maxrate 500k -bufsize 1000k -vf scale=-1:480 -threads 0 -codec:a libfdk_aac -b:a 128k $saveFile");
			
		if(file_exists($saveFile)){
			
			return true;
		
		}else{
			
			throw new Exception("Error occurred during video conversion.");
		
		}	
			
		
	}
}
?>