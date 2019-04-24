<?php

/**
	This file upload class is based on code from
	http://php.net/manual/en/function.move-uploaded-file.php
	and
	https://www.w3schools.com/php7/php7_file_upload.asp 
	as of 3/20/2019.	
**/	
class FileAction
{	
	public function __construct() {}
	
	
	// process multiple files uploaded at the same time from the same form input
	public function processFileUploads($attachment_type, $id_number, 
							$uploads_dir, $mdb_control, &$error_array)
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
							$success = $controller->saveNew($attachment);							
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
					if($error != UPLOAD_ERR_NO_FILE) 
					{ 	
						$error_array[] = "The file encountered an error and was not uploaded.";
						$success = false;
					}				
				}
				
			} // end for each loop		
		}
		
		return $success;
	}	
	
	
	// Returns an 2D array of the CSV comma separated file contents
	// with each line of file data forming a 1D array  
	// returns false on failure
	public function uploadCSVfile(&$error_array)
	{				
		if ($_FILES["attachments"]["error"] != UPLOAD_ERR_OK) 
		{	
			$error_array[] = "The file encountered an error, s it was not uploaded.";
			return false;
		}
		
		// the filename on the user's system
		$filename = basename($_FILES["attachments"]["name"]);		
		// the temporary file storage name
		$tmp_name = $_FILES["attachments"]["tmp_name"];	
		// Check file size is < 2MB max.
		$size = $_FILES["attachments"]["size"];	
		
		// test for possible file upload attack
		if (!is_uploaded_file($tmp_name))
		{	
			$error_array[] = "The file $filename could not be uploaded.";
			return false;
		}
		
		// Check file size is < 2MB max.
		if ($size > 2100000) 
		{	
			$error_array[] = "The file $filename is too large. 
								Files are limited to < 2MB.";
			return false;
		}		
		
		$uploads_dir = "temp";
		$fullFileName = "$uploads_dir/$filename";
		
		if(!file_exists($uploads_dir)) 
		{ 
			mkdir($uploads_dir, true); 
		}
			
		if (move_uploaded_file($tmp_name, $fullFileName)) 
		{	
			$result = array();
			
			// read the file into an array
			if (($csvFile = fopen($fullFileName, 'r')) != false)
			{
				while (!feof($csvFile))
				{
					// break line into an array of data at the comas,
					// as field separators and "quotes" as field enclosures
					if(($dataline = fgetcsv($csvFile))!= false)
					{
						$result[] = $dataline;
					}
				}
				
				fclose($csvFile);
			}
			else
			{
				$error_array[] = "The file $filename could not be opened.";
				return false;
			}	

			$this->deleteFile($uploads_dir, $filename);
		} 
		else 
		{	
			$error_array[] = "The file $filename could not be uploaded.";
			$success = false;
		}
				
		return $result;
	}	
	
	
	public function tutorialLabFileUpload($uploads_dir, 
					$attachment_type, $mdb_control, &$error_array)
	{		
		$success = true;	
		
		if(isset($_FILES[$attachment_type]))
		{
			if ($_FILES[$attachment_type]["error"] != UPLOAD_ERR_OK) 
			{						
				$error_array[] = "The file encountered an error, so it was not uploaded.";
				return false;				
			}
			
			// the temp storage name
			$tmp_name = $_FILES[$attachment_type]["tmp_name"];				
			// to prevent file system traversal attacks
			$filename = basename($_FILES[$attachment_type]["name"]);
			// get destination file path 					
			$fullFileName = "$uploads_dir/$filename";
			$size = $_FILES[$attachment_type]["size"];
			
			$success = $this->filterFileUpload($tmp_name, $filename, $size, $fullFileName, $error_array);
			
			if (!$success) 
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
					$success = true;							
				} 
				else 
				{	
					$error_array[] = "The file $filename could not be saved.";
					$success = false;
				}
			}										
		}
		
		if($success) 
		{ return $filename; }
		else 
		{ return ""; }
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
		if ($size > 8400000) 
		{	
			$error_array[] = "The file $filename is too large. Files are limited to < 7MB.";
			$success = false;
		}		
			
		return $success;
	}

	
	public function deleteFile($uploads_dir, $filename)
	{	
		$full_filename = "$uploads_dir/$filename";
		
		if(is_file($full_filename))
		{
			unlink($full_filename);
		}
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
	
	
	public function deleteDirectoryIfEmpty($uploads_dir)
	{	
		$fullpath = $uploads_dir . "/*";
		// get all the file names in that directory
		// if list returns false or empty array then delete directory
		if(($files = glob($fullpath)) || (count($files) == 0))
		{
			rmdir($uploads_dir);
		} 
		
	}
	
	
}

?>

