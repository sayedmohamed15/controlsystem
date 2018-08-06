<?php
include "db.php";
/**
 * 
 */
class Users
{
	public $username;
	public $password;
	public $email;
	public $address;
	public $image;
	public $information;
	public $phone;
	public $role;
	public $date_of_birth;
	public $gender;
	public $dbobject;

	
	function __construct()
	{
		$this->dbobject = new Database();
		 	
	}
	public function AddUser($usersdata = array()){
		$this->username = $usersdata["username"];
		$this->password = $usersdata["password"];
		$this->email = $usersdata["email"];
		$this->address = $usersdata["address"];
		$this->image = $usersdata["image"];
		$this->information = $usersdata["information"];
		$this->phone = $usersdata["telephone"];
		$this->role = $usersdata["role"];
		$this->date_of_birth = $usersdata["date_of_birth"];
		$this->gender = $usersdata["gender"];
		  $tblName = 'users';
                $userData = array(
                    'username' =>$this->username,
                    'password' => $this->password,
                    'email' => $this->email,
                    'address'=> $this->address,
                    'image'=> $this->image,
                    'info' => $this->information,
                    'phone' =>$this->phone,
                    'role' => $this->role,
                    'date_of_birth' => $this->date_of_birth,
                    'gender' => $this->gender

                );
                $insert_user = $this->dbobject->insert($tblName,$userData);

	}

}