# phpmp4
A simple lightweight php library for converting videos into HTML5 Mp4 video format

## Usage
Include src\PHPMp4\PHPMp4.php

```php

	$video = new \PHPMp4\PHPMp4('test.wmv');

	try{
		$video->convertVideo();
	}catch(Exception $e){
		echo 'error '.$e->getMessage();
	}

```