<?php
include "Admin.php";

if (isset($_POST['submit'])) {
     
     $username = $_POST['firstname'].' '.$_POST['lastname'];
     $password = sha1($_POST['password']);
     $email = $_POST['email'];
     $address = $_POST['address'].'-'.$_POST['city'];
     $information = $_POST['information'];
     $telephone = $_POST['telephone'];
     $role = $_POST['role'];
     $gender = $_POST['gender'];

     $date_of_birth = '';
     $image = '';

     $addusers =array('username' => $username,
 				'password' => $password,
 				'email' => $email,
 				'address' => $address,
 				'information' => $information,
 				'telephone' => $telephone,
 				'role' => $role,
 				'gender' => $gender,
 				'date_of_birth' => $date_of_birth,
 				'image' => $image		);
     
     $admin = new Admin();

$admin->AddUser($addusers);

	}