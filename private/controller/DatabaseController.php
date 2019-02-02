<?php

abstract class DatabaseController
{
	protected $tableName;
	
	
	/***
	Sets the tableName of the database table used by that particular controller.
	**/
	abstract public function initialize();
 	
	
	/***
	Protected helper function.
	Used to extract the rows of data from the query result returned from the database.
	Input: $db_result = the database query result set.
	Input/Output: $dataArray = the array of object models created from each result row.
		(The object type in the dataArray depends on the actual controller used,
		because the controller determines whitch database table is queried.)
	***/
	abstract protected function getData($db_result, &$dataArray, $db_connection);
	
	
	/***
	Creates a new database row from the data object.
	Input/Output: $data = the object model that contains the data to be save as a new row in the database table.
	The $data input is changed to include the new auto-generated data id from the database, if applicable for that data table.
	Output: $success = true if a database row added to the table.
		(The object type in the data depends on the actual controller used,
		because the controller determines whitch database table is used.)
	***/
	abstract public function saveNew(&$data);
	
	
	/***
	Updates the attribute with the new value in both the database and in the data object
	to ensure that they are both the same.
	Input: $data_object = the data object that needs updating in the database.
	Input: $attribute = the attribute that needs to be updated for that object.
	Input: $value = the new value to be set for that attribute.
	Output: $success = true if the attribute was able to be updated in the database.
	***/
	abstract public function update_attribute(&$data_object, $attribute, $value);
		
	
	/*** 
	Deletes a data_object from the database.
	WARNING: This may not work if the data_object is currently referenced as a 
			foreign key by other tables in the database.  
			Unintended database or program side effects are possible due to
			cascading deletions in the database.  
	WARNING: It is left to the calling function to nullify all appropriate related 
			data_objects from the program, or program side effects may occur.
	Input: $data_object = the data object to be removed from the database.
	Output: $success = true if the object was removed.
	***/
	abstract public function delete_from_database($data_object);
	
	
	/***
	Used to get a connection to the database as needed.
	**/
	public function get_db_connection()
	{
		$db_connection = mysqli_connect('localhost', 'root', 'sfsu@2019Grad', 'physics_in_motion') 
					OR die (mysqli_connect_error());
		return $db_connection;
	}
		
		
	/***
	Queries the database for an array of objects that all have $attribute = $value.
	Input: $attribute = the collumn of the database table to search.
	Input: $value = the value of the attribute to find.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getByAttribute($attribute, $value)
	{
		$table = $this->getTableName();
		$db_connection = $this->get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table where $attribute = '$value'";
		$result = mysqli_query($db_connection, $query);
		$this->getData($result, $dataArray, $db_connection);	
				
		mysqli_close($db_connection);
		
		return $dataArray;
	}
	
	
	/***
	Queries the database for an array of objects that all have $attribute = $value.
	Input: $attribute1, $attribute2 = the collumns of the database table to search.
	Input: $value1, $value2 = the values of the attributes to find.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getByAttributes($attribute1, $value1, $attribute2, $value2)
	{
		$table = $this->getTableName();
		$db_connection = $this->get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table where ($attribute1 = '$value1') AND ($attribute2 = '$value2')";
		$result = mysqli_query($db_connection, $query);
		$this->getData($result, $dataArray, $db_connection);	
		mysqli_free_result($result);
		mysqli_close($db_connection);	
		
		return $dataArray;
	}
		
		
	/***
	Queries the database for an array of all rows in the database table.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getAllData()
	{
		$table = "";
		$table = $this->getTableName();
		$db_connection = $this->get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table";		
		$result = mysqli_query($db_connection, $query);
		$this->getData($result, $dataArray, $db_connection);
		mysqli_close($db_connection);
		
		return $dataArray;
	}
	
	
	/***
	Used to get the name of the database table used by that particular controller.
	**/
	public function getTableName()
	{
		return $this->tableName;
	}

	
	
}

?>