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
$data['chemical']=$request->chemical;
$data['manufactor']=$request->manufactor;
$data['provider']=$request->provider;
$data['units']=$request->units;
$data['purity']=$request->purity;
$data['store']=$request->store;
$data['field']=$request->field;
$data['type']=$request->type;
$data['state']=$request->state;

$reply=array();

if($data['action']=='add'){
	$sql="INSERT INTO pkn_content (name,chemical,manufactor,provider,units,purity,store,field,type,state) VALUE ('{$data['name']}','{$data['chemical']}','{$data['manufactor']}','{$data['provider']}','{$data['units']}','{$data['purity']}','{$data['store']}','{$data['field']}','{$data['type']}','{$data['state']}')";
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
	$sql="UPDATE pkn_content SET name='{$data['name']}',chemical='{$data['chemical']}',manufactor='{$data['manufactor']}',provider='{$data['provider']}',units='{$data['units']}',purity='{$data['purity']}',store='{$data['store']}',field='{$data['field']}',type='{$data['type']}',state='{$data['state']}' WHERE id='{$data['chemical']}'";
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
	$sql="DELETE FROM pkn_content WHERE id='{$data['id']}'";
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