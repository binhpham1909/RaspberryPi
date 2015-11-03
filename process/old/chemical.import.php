<?php
require("../config/config.php");
require("../config/lang.ini.php");
session_start();
if ($_SESSION['user'])
{
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$data['content']=$request->content;
$data['weight']=$request->weight;
$data['code']=$request->code;
$data['lot']=$request->lot;
$data['receive']=$request->receive;
$data['expired']=$request->expired;
$data['open_date']=$request->open_date;
$data['user_receive']=$request->user_receive;
$data['user_open']=$request->user_open;
$data['description']=$request->description;

$data['user_input']=$_SESSION['user_id'];
$data['valid']=FALSE;

$reply=array();

$sql="INSERT INTO pkn_import (content,weight,code,lot,receive,expired,open_date,user_receive,user_open,description,user_input,date_input,valid) 
VALUE (	'{$data['content']}',
		'{$data['weight']}',
		'{$data['code']}',
		'{$data['lot']}',
		'{$data['receive']}',
		'{$data['expired']}',
		'{$data['open_date']}',
		'{$data['user_receive']}',
		'{$data['user_open']}',
		'{$data['description']}',
		'{$data['user_input']}',
		CURRENT_TIMESTAMP,
		'{$data['valid']}')";
if(mysql_query ($sql)){
	$reply['status']=__result;
	$reply['result']="ok";
	$reply['message']=__add_success;
}else{
	$reply['status']=__result;
	$reply['result']="err";
	$reply['message']=__add_err;
}

echo json_encode($reply);
}
?>