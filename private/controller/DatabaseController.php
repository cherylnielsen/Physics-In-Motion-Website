 <?php


abstract class DatabaseController
{
	private $tableName; 	
	
	/***
	Protected helper function.
	Used to extract the rows of data from the query result returned from the database.
	Input: $db_result = the database query result set.
	Input/Output: $dataArray = the array of object models created from each result row.
		(The object type in the dataArray depends on the actual controller used,
		because the controller determines whitch database table is queried.)
	***/
	abstract protected function getData($db_result, $db_connection);
	
	
	/***
	Creates a new database row from the data object.
	The data_object input is changed to include the new auto-generated data id 
	from the database, if applicable for that data table.
	Input/Output: $data_object = the object model that contains the data to be 
			saved as a new row in the database table.
	Output: $success = true if a database row added to the table.
		(The object type in the data depends on the actual controller used,
		because the controller determines whitch database table is used.)
	***/
	abstract public function saveNew(&$data_object);
	
	
	/***
	Updates the database with the new value for the given key.
	Input: $data_object = the data object that needs updating in the database.
	Input: $key = the key that needs to be updated for that object.
	Input: $value = the new value to be set for that key.
	Output: $success = true if the key was able to be updated in the database.
	***/
	abstract public function updateAttribute($data_object, $key);
		
	
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
	abstract public function deleteFromDatabase($data_object);
		
		
	/***
	Queries the database for an array of objects that all have $key = $value.
	Input: $key = the column of the database table to search.
	Input: $value = the value of the key to find.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getByAttribute($key, $value)
	{
		$table = $this->getTableName();
		$db_connection = get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table where $key = '$value'";
		$result = mysqli_query($db_connection, $query);
		$dataArray = $this->getData($result, $db_connection);	
				
		mysqli_close($db_connection);
		
		return $dataArray;
	}
	
	
	/***
	Queries the database for an array of objects that all have $key = $value.
	Input: $key1, $key2 = the collumns of the database table to search.
	Input: $value1, $value2 = the values of the keys to find.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getByAttributes($key1, $value1, $key2, $value2)
	{
		$table = $this->getTableName();
		$db_connection = get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table where ($key1 = '$value1') AND ($key2 = '$value2')";
		$result = mysqli_query($db_connection, $query);
		$dataArray = $this->getData($result, $db_connection);	

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
		$db_connection = get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table";		
		$result = mysqli_query($db_connection, $query);
		$dataArray = $this->getData($result, $db_connection);
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

	/***
	Used to set the name of the database table used by that particular controller.
	**/
	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
	}
	
	
}

?>