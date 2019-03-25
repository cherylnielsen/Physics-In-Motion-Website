<?php


class ActionUtility
{
	public function __construct() {}
	
	
	// http://php.net/manual/en/function.move-uploaded-file.php
	public function processFileUploads()
	{
		$uploads_dir = '/uploads';
		
		foreach ($_FILES["attachment"]["error"] as $key => $error) 
		{
			if ($error == UPLOAD_ERR_OK) 
			{
				$tmp_name = $_FILES["attachment"]["tmp_name"][$key];
				// basename() may prevent filesystem traversal attacks;
				// further validation/sanitation of the filename may be appropriate
				$name = basename($_FILES["attachment"]["name"][$key]);
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
			}
		}		
	}
	

	/**
		This file upload function is based on code originally from
		https://www.w3schools.com/php7/php7_file_upload.asp as of 3/20/2019.
	**/
	public function processFileUploads2()
	{
		$filePath = "uploads/";
		$fullFileName = $filePath . basename($_FILES["attachment"]["name"]);
		$ok = true;
		$fileType = strtolower(pathinfo($fullFileName,PATHINFO_EXTENSION));
								
		// Check if file already exists
		if (file_exists($fullFileName)) 
		{
			echo "Sorry, file already exists.";
			$ok = false;
		}		
		
		// Check file size (10,000,000 in bytes = 10MB)
		if ($_FILES["attachment"]["size"] > 10000000) 
		{
			echo "Sorry, your file is too large.";
			$ok = false;
		}		
		
		// Allow certain file formats
		if($fileType != "jpg" && $fileType != "png" 
			&& $fileType != "jpeg" && $fileType != "gif" ) 
		{
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$ok = false;
		}
		
		// Check if $ok is set to false by an error
		if ($ok == false) 
		{
			echo "Sorry, your file was not uploaded.";
			
		} // if everything is ok, try to upload file
		else 
		{
			if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $fullFileName)) 
			{
				echo "The file ". basename( $_FILES["attachment"]["name"]). " has been uploaded.";
			} 
			else 
			{
				echo "Sorry, there was an error uploading your file.";
			}
		}
		
	}
	
	
	
	
}

?>

