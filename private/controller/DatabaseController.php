<?php

abstract class DatabaseController
{
	abstract public function get_by_id($id_number, $id_type);
	abstract public function get_by_attribute($attribute, $attribute_type);
	abstract public function get_all();
	abstract public function update($db_type);
	abstract public function save_new($db_type);
	
}

?>