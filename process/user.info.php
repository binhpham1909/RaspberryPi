<?php
require("../config/config.php");
require("../config/lang.ini.php");
session_start();
if ($_SESSION['user'])
{
$user_id=$_SESSION['user_id']; 

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$data['action']=$request->action;
$data['id']=$request->id;
$data['name']=$request->name;
$data['username']=$request->username;
$data['password']=md5($request->password);
$data['email']=$request->email;
$data['phone']=$request->phone;
$data['birthday']=$request->birthday;
$data['joins']=$request->joins;
$data['quit']=$request->quit;
$data['school']=$request->school;
$data['branch']=$request->branch;
$data['position']=$request->position;
$data['address']=$request->address;

$reply=array();

if($data['action']=='add'){
	$sql="INSERT INTO pkn_user (name,username,password,email,phone,birthday,joins,quit,school,branch,position,address) VALUE ('{$data['name']}','{$data['username']}','{$data['password']}','{$data['email']}','{$data['phone']}','{$data['birthday']}','{$data['joins']}','{$data['quit']}','{$data['school']}','{$data['branch']}','{$data['position']}','{$data['address']}')";
	if(mysql_query ($sql)){
		$reply['status']=__result;
		$reply['result']="ok";
		$reply['message']=__add_success;
	}else{
		$reply['status']=__result;
		$reply['result']="err";
		$reply['message']=__add_err;
	}
}elseif($data['action']=='edit'){
	$sql="UPDATE pkn_user SET name='{$data['name']}',username='{$data['username']}',phone='{$data['phone']}',email='{$data['email']}',birthday='{$data['birthday']}',joins='{$data['joins']}',quit='{$data['quit']}',school='{$data['school']}',branch='{$data['branch']}',position='{$data['position']}',address='{$data['address']}' WHERE id='{$data['id']}'";
	if(mysql_query ($sql)){
		$reply['status']=__result;
		$reply['result']="ok";
		$reply['message']=__edit_success;
	}else{
//		echo mysql_error();
		$reply['status']=__result;
		$reply['result']="err";
		$reply['message']=__edit_err;
	}
}elseif($data['action']=='del'){
	$sql="DELETE FROM pkn_user WHERE id='{$data['id']}'";
	if(mysql_query ($sql)){
		$reply['status']=__result;
		$reply['result']="ok";
		$reply['message']=__del_success;
	}else{
		$reply['status']=__result;
		$reply['result']="err";
		$reply['message']=__del_err;
	}
}elseif($data['action']=='change_pass'){
	$sql="UPDATE pkn_user SET password='{$data['password']}' WHERE id='{$data['id']}'";
	if(mysql_query ($sql)){
		$reply['status']=__result;
		$reply['result']="ok";
		$reply['message']=__edit_success;
	}else{
//		echo mysql_error();
		$reply['status']=__result;
		$reply['result']="err";
		$reply['message']=mysql_error();
	}
}
echo json_encode($reply);
}
?>