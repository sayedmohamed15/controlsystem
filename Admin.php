<?php

include "Users.php";
/**
 * 
 */
class Admin extends Users
{
	
	function __construct()
	{
		$this->dbobject = new Database();
	}


}