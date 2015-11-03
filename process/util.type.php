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
$data['description']=$request->description;

$reply=array();

if($data['action']=='add'){
	$sql="INSERT INTO pkn_type (name,description) VALUE ('{$data['name']}','{$data['description']}')";
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
	$sql="UPDATE pkn_type SET name='{$data['name']}',description='{$data['description']}' WHERE id='{$data['id']}'";
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
	$sql="DELETE FROM pkn_type WHERE id='{$data['id']}'";
	if(mysql_query ($sql)){
		$reply['status']=__result;
		$reply['result']="ok";
		$reply['message']=__del_success;
	}else{
		$reply['status']=__result;
		$reply['result']="err";
		$reply['message']=__del_err;
	}
}
echo json_encode($reply);
}
?>