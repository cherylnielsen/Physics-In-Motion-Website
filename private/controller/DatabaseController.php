<?php

abstract class DatabaseController
{

	abstract public function get_by_attribute($attribute_value, $attribute_type, $db_connection);
	abstract public function get_all($db_connection);
	abstract public function update($db_type, $db_connection);
	abstract public function save_new($db_type, $db_connection);
	
}

?>