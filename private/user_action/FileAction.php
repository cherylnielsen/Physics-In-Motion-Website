<?php

class FileAction
{	
	public function __construct() {}
	
	
	/**
		This file upload function is based on code from
		http://php.net/manual/en/function.move-uploaded-file.php
		and
		https://www.w3schools.com/php7/php7_file_upload.asp 
		as of 3/20/2019.	
	**/	
	public function processFileUploads($attachment_type, $id_number, $uploads_dir, 
										$mdb_control, &$error_array)
	{		
		$success = true;
		$controller;
		$attachment;
		
		if ($attachment_type == "notice")
		{
			$controller = $mdb_control->getController("notice_attachment");
			$attachment = new Notice_Attachment();
		}
		
		if ($attachment_type == "assignment")
		{
			$controller = $mdb_control->getController("assignment_attachment");
			$attachment = new Assignment_Attachment();
		}
		

		if(isset($_FILES["attachments"]))
		{
			foreach ($_FILES["attachments"]["error"] as $key => $error) 
			{
				if ($error == UPLOAD_ERR_OK) 
				{
					// the temp storage name
					$tmp_name = $_FILES["attachments"]["tmp_name"][$key];				
					// to prevent file system traversal attacks
					$filename = basename($_FILES["attachments"]["name"][$key]);
					// get destination file path 					
					$fullFileName = "$uploads_dir/$filename";
					$size = $_FILES["attachments"]["size"][$key];
					
					$success = $this->filterFileUpload($tmp_name, $filename, $size, $fullFileName, $error_array);
					
					// Check if $success is set to false by any errors
					if ($success == false) 
					{	
						$error_array[] = "The file $filename could not be uploaded.";					
					}			 
					else // if everything is success, try to upload file
					{
						if(!file_exists($uploads_dir)) 
						{ 
							mkdir($uploads_dir, true); 
						}
							
						if (move_uploaded_file($tmp_name, $fullFileName)) 
						{	
							$attachment->initialize(null, $id_number, $filename, $uploads_dir);
							$sucess = $controller->saveNew($attachment);							
						} 
						else 
						{	
							$error_array[] = "The file $filename could not be uploaded.";
							$success = false;
						}
					}						
				} 
				else // if error
				{						
					if($error == UPLOAD_ERR_INI_SIZE || $error == UPLOAD_ERR_FORM_SIZE)
					{
						$filename = basename($_FILES["attachments"]["filename"][$key]);
						$error_array[] = "The file $filename is too large. Files are limited to < 7MB.";
						$success = false;
					}
					else if($error != UPLOAD_ERR_NO_FILE) 
					{ 	
						// if error is not too large, and error is not no file
						// technical errors, not user errors
						$success = false;
					}					
				}
				
			} // end for each loop		
			
		}
		
		return $success;
	}	
	
	
	public function filterFileUpload($tmp_name, $filename, $size, $fullFileName, &$error_array)
	{		
		$success = true;
		
		// test for possible file upload attack
		if (!is_uploaded_file($tmp_name))
		{	
			$error_array[] = "An error was encountered while uploading the file $filename.";
			$success = false;
		}
		
		// Check if file already exists
		if (file_exists($fullFileName)) 
		{	
			$error_array[] = "The file $filename already exists.";
			$success = false;
			//unlink($fullFileName);
		}		
		
		// Check file size, the standard limit for PHP post is 8MB.
		// 8,000,000 < 1024 * 1024 * 8 = 8,388,608
		if ($size > 8000000) 
		{	
			$error_array[] = "The file $filename is too large. Files are limited to < 7MB.";
			$success = false;
		}		
			
		return $success;
	}
	
	
	public function deleteDirectory($uploads_dir)
	{	
		// get all the file names in that directory
		$fullpath = "$uploads_dir/*";
		$files = glob($fullpath); 
		
		// loop over all the files in the directory
		foreach($files as $file)
		{ 
			unlink($file);
		}
		
		rmdir($uploads_dir);
	}
	
	
	public function deleteFile($uploads_dir, $filename)
	{	
		$full_filename = "$uploads_dir/$filename";
		
		if(is_file($full_filename))
		{
			unlink($full_filename);
		}
	}
	
}

?>

