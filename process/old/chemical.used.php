<?php
require("../config/config.php");
session_start();
if ($_SESSION['user'])
{
$user_id=$_SESSION['user_id']; 

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$data['action']=$request->action;
$data['id']=$request->id;
$data['table']=$request->table;
$data['weight']=$request->weight;

echo $data->weight;

$err="";
$cal=array();
$reply=array();

if(($data['table']=="content")&&($data['action']=="check")){
	$sql="SELECT * FROM pkn_content WHERE id = '{$data['id']}' ORDER BY id DESC";
	$result = mysql_query($sql)or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)){
	  $tmp=array("id"=>$row['id'],"name"=>get_name($row['name'],"pkn_name"),"units"=>get_obj_name("pkn_units",$row['units']),"manufactor"=>get_name($row['manufactor'],"pkn_manufactor"),"provider"=>get_name($row['provider'],"pkn_provider"),"purity"=>get_name($row['purity'],"pkn_purity"),"store"=>get_name($row['store'],"pkn_store"),"fields"=>get_name($row['fields'],"pkn_fields"),"weight"=>$data['weight']);
	array_push($reply,$tmp);
	}
}


if(($data['table']=="solution")&&($data['action']=="check")){
	// get sum total
	$sql1="SELECT * FROM pkn_formula WHERE (solution = '{$data['id']}') AND (total = TRUE)";
	$result1 = mysql_query($sql1)or die(mysql_error());
	while ($row1 = mysql_fetch_assoc($result1)){
		$tmp=array("id"=>$row1['solution'],"name"=>get_name($row1['solution'],"pkn_solution"),"units"=>get_name($row1['units'],"pkn_units"),"weight"=>$row1['weight'],"total"=>$row1['total']);
		array_push($cal,$tmp);
	}
	// get content / total
	$sql2="SELECT * FROM pkn_formula WHERE (solution = '{$data['id']}') AND (total = FALSE)";
	$result2 = mysql_query($sql2)or die(mysql_error());
	while ($row2 = mysql_fetch_assoc($result2)){
		$tmp=array("id"=>$row2['solution'],"name"=>get_content_name($row2['content']),"units"=>get_obj_name("pkn_units",$row2['units']),"weight"=>$row2['weight'],"total"=>$row2['total']);
		array_push($cal,$tmp);
	}
	// caculator
	for($i=1;$i<sizeof($cal);$i++){
		$tmpc=array();
		$tmpc['id']=$cal[$i]['id'];
		$tmpc['name']=$cal[$i]['name'];
		$tmpc['units']=$cal[$i]['units'];
		$tmpc['weight']=($cal[$i]['weight']*$data['weight'])/$cal[0]['weight'];
		array_push($reply,$tmpc);
		}
}
if(($data['table']=="content")&&($data['action']=="save")){
	$sql="";
	if($_SESSION['admin']>0){
		$sql="INSERT INTO pkn_used (content,weight,user,user_input,time,solution,description) VALUE ('{$data['id']}','{$data['weight']}','{$user_id}','{$user_id}','{$data['date']}','0','{$data['used']}')";
	}else if($_SESSION['admin']==0){
		$sql="INSERT INTO pkn_used (content,weight,user,user_input,time,solution,description) VALUE ('{$data['id']}','{$data['weight']}','{$data['user']}','{$user_id}','{$data['date']}','0','{$data['used']}')";		
	}
	if(mysql_query ($sql)){
		array_push($reply,array("result"=>"Thêm thành công"));
	}else{
		array_push($reply,array("result"=>"Thêm thất bại"));
	}
}
if(($data['table']=="solution")&&($data['action']=="save")){
	$sql1="SELECT * FROM pkn_formula WHERE (solution = '{$data['id']}') AND (total = TRUE)";
	$result1 = mysql_query($sql1)or die(mysql_error());
	while ($row1 = mysql_fetch_assoc($result1)){
		$tmp=array("solution"=>$row1['solution'],"name"=>get_obj_name("pkn_solution",$row1['solution']),"weight"=>$row1['weight']);
		array_push($cal,$tmp);
	}
	// get content / total
	$sql2="SELECT * FROM pkn_formula WHERE (solution = '{$data['id']}') AND (total = FALSE)";
	$result2 = mysql_query($sql2)or die(mysql_error());
	while ($row2 = mysql_fetch_assoc($result2)){
		$tmp=array("solution"=>$row2['solution'],"content"=>$row2['content'],"weight"=>$row2['weight']);
		array_push($cal,$tmp);
	}
	// caculator
	for($i=1;$i<sizeof($cal);$i++){
		$tmpc=array();
		$tmpc['solution']=$cal[$i]['solution'];
		$tmpc['content']=$cal[$i]['content'];
		$tmpc['weight']=($cal[$i]['weight']*$data['weight'])/$cal[0]['weight'];
		$tmpc['description']=$cal[0]['name']."<p>".$data['used']."</p>";
		$sql="";
		if($_SESSION['admin']>0){
			$sql="INSERT INTO pkn_used (content,weight,user,user_input,time,solution,description) VALUE ('{$tmpc['content']}','{$tmpc['weight']}',{$user_id},{$user_id},'{$data['date']}','{$tmpc['solution']}','{$tmpc['description']}')";
		}else if($_SESSION['admin']==0){
			$sql="INSERT INTO pkn_used (content,weight,user,user_input,time,solution,description) VALUE ('{$tmpc['content']}','{$tmpc['weight']}','{$data['user']}',{$user_id},'{$data['date']}','{$tmpc['solution']}','{$tmpc['description']}')";	
		}
	if(mysql_query ($sql)){
		array_push($reply,array("result"=>"Thêm thành công"));
	}else{
		array_push($reply,array("result"=>"Thêm Thất bại"));
	}
}
}
echo json_encode($reply);
}
?>