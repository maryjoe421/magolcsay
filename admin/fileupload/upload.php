<?php
	@extract($_GET);
	
	$filename	= $_FILES["Filedata"]["name"];
	$temp_name	= $_FILES["Filedata"]["tmp_name"];
	$error		= $_FILES["Filedata"]["error"];
	$size		= $_FILES["Filedata"]["size"];

	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	if($extension == "mp3") {
		$uploadPath = "../../file/";
	} else {
		$uploadPath = "../../picture/";
	}
	
	/* NOTE: Some server setups might need you to use an absolute path to your "dropbox" folder
	(as opposed to the relative one I've used below).  Check your server configuration to get
	the absolute path to your web directory*/
	if(!$error)
		move_uploaded_file($temp_name, $uploadPath . $filename);
	echo "1";
	createFile("file");
	createFile("picture");
?>