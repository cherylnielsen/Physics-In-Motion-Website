<?php

abstract class DatabaseController
{
	private $tableName;
	
	/***
	Used to set the tableName of the database table used by that particular controller.
	**/
	abstract public function initialize();
 	
	/***
	Private helper function.
	Used to extract the rows of data from the query result returned from the database.
	Input: $db_result = the database query result set.
	Input/Output: $dataArray = the array of object models created from each result row.
		(The object type in the dataArray depends on the actual controller used,
		because the controller determines whitch database table is queried.)
	***/
	abstract private function getData($db_result, &$dataArray);
	
	/***
	Updates the database row for that particular data object.
	Input: $data = the object model that contains the row of data to be updated.
	Output: $sucess = true if database row was updated.
		(The object type in the data depends on the actual controller used,
		because the controller determines whitch database table is used.)
	***/
	abstract public function update($data);
	
	/***
	Creates a new database row from the data object.
	Input/Output: $data = the object model that contains the data to be save as a new row in the database table.
	The $data input is changed to include the new auto-generated data id from the database, if applicable for that data table.
	Output: $sucess = true if a database row added to the table.
		(The object type in the data depends on the actual controller used,
		because the controller determines whitch database table is used.)
	***/
	abstract public function saveNew(&$data);
	
	/***
	Private helper function
	Used to get a connection to the database as needed.
	**/
	private function get_db_connection()
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
		$table = $this->$getTableName();
		$db_connection = $this->$get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table where $attribute = '$value'";
		$result = mysqli_query($db_connection, $query);
		getData($result, &$dataArray);		
		mysqli_close($db_connection);
		
		return $dataArray;
	}
	
	/***
	Queries the database for an array of objects that all have $attribute = $value.
	Input: $attribute1, $attribute2 = the collumns of the database table to search.
	Input: $value1, $value2 = the values of the attributes to find.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getByAttributes($attribute1, $value1, $attribute1, $value2, $attribute2)
	{
		$table = $this->$getTableName();
		$db_connection = $this->$get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table where ($attribute1 = '$value1') AND ($attribute2 = '$value2')";
		$result = mysqli_query($db_connection, $query);
		getData($result, &$dataArray);			
		mysqli_close($db_connection);	
		
		return $dataArray;
	}
		
	/***
	Queries the database for an array of all rows in the database table.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getAllData()
	{
		$table = $this->$getTableName();
		$db_connection = $this->$get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table";		
		$result = mysqli_query($db_connection, $query);
		getData($result, &$dataArray);
		mysqli_close($db_connection);
		
		return $dataArray;
	}
	
	/***
	Protected helper function.
	Used to set the name of the database table used by that particular controller.
	**/
	protected function getTableName()
	{
		return $this->$tableName;
	}
	
	/***
	Protected helper function.
	Used to set the name of the database table used by that particular controller.
	**/
	protected function setTableName($tableName)
	{
		$this->$tableName = $tableName;
	}
	
	
}

?>