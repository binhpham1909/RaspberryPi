<?php
require("../config/config.php");
 
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$type=$request->type;
$term=$request->term;

$term = "%".$term."%";
$table="pkn_".$type;
$reply = array();
$sql1="";
if($type=="user"){
	$sql1="SELECT * FROM pkn_user WHERE (name LIKE '{$term}') ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("label"=>$row1['name'],"id"=>$row1['id'],"name"=>$row1['name'],"username"=>$row1['username'],"password"=>$row1['password'],"email"=>$row1['email'],"phone"=>$row1['phone'],"address"=>$row1['address'],"birthday"=>date('Y-m-d',strtotime($row1['birthday'])),"joins"=>date('Y-m-d',strtotime($row1['joins'])),"quit"=>date('Y-m-d',strtotime($row1['quit'])),"school"=>$row1['school'],"branch"=>$row1['branch'],"position"=>$row1['position'],"description"=>$row1['description']);
		array_push($reply,$arr);
	}
}else if($type=="chemical"){
	$sql1="SELECT * FROM pkn_chemical WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1) or trigger_error(mysql_error()." in ".$sql1);;
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("id"=>$row1['id'],"name"=>$row1['name'],"properties"=>$row1['properties'],"typeid"=>$row1['type'],"type"=>get_col_val($row1['type'],"pkn_type","description"),"label"=>$row1['name']."<>".get_col_val($row1['type'],"pkn_type","description"));
		array_push($reply,$arr);
	}
}else if($type=="manufactor"){
	$sql1="SELECT * FROM pkn_manufactor WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("id"=>$row1['id'],"name"=>$row1['name'],"code"=>$row1['code'],"address"=>$row1['address'],"contact"=>$row1['contact'],"label"=>$row1['name']);
		array_push($reply,$arr);
	}
}else if($type=="units"){
	$sql1="SELECT * FROM pkn_units WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("id"=>$row1['id'],"name"=>$row1['name'],"symbol"=>$row1['symbol'],"label"=>$row1['name'].' ( '.$row1['symbol'].' ).');
		array_push($reply,$arr);
	}
}else if($type=="provider"){
	$sql1="SELECT * FROM pkn_provider WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("id"=>$row1['id'],"name"=>$row1['name'],"code"=>$row1['code'],"address"=>$row1['address'],"contact"=>$row1['contact'],"label"=>$row1['name']);
		array_push($reply,$arr);
	}
}else if($type=="purity"){
	$sql1="SELECT * FROM pkn_purity WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("id"=>$row1['id'],"name"=>$row1['name'],"label"=>$row1['name']);
		array_push($reply,$arr);
	}
}else if($type=="store"){
	$sql1="SELECT * FROM pkn_store WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("id"=>$row1['id'],"name"=>$row1['name'],"label"=>$row1['name']);
		array_push($reply,$arr);
	}	
	
}else if($type=="field"){
	$sql1="SELECT * FROM pkn_field WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("id"=>$row1['id'],"name"=>$row1['name'],"userid"=>$row1['user'],"username"=>get_obj_name("pkn_user",$row1['user']),"label"=>$row1['name']);
		array_push($reply,$arr);
	}		
}else if($type=="type"){
	$sql1="SELECT * FROM pkn_type WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("id"=>$row1['id'],"name"=>$row1['name'],"description"=>$row1['description'],"label"=>$row1['name']);
		array_push($reply,$arr);
	}	
}else if($type=="state"){
	$sql1="SELECT * FROM pkn_state WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("id"=>$row1['id'],"name"=>$row1['name'],"label"=>$row1['name']);
		array_push($reply,$arr);
	}
	
}else if($type=="content"){
	$sql1="SELECT * FROM pkn_chemical WHERE name LIKE '{$term}' ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$sql2="SELECT * FROM pkn_content WHERE chemical = '{$row1['id']}'";// lay id name
		$query2 = mysql_query($sql2);
		while ($row2 = mysql_fetch_assoc($query2)){
			$arr=array(
			"contentname"=>$row2['name'],
			"contentid"=>$row2['id'],
			"chemicalid"=>$row2['chemical'],
			"chemicalname"=>get_obj_name("pkn_chemical",$row2['chemical']),
			"unitsid"=>$row2['units'],
			"unitsname"=>get_obj_name("pkn_units",$row2['units']),
			"manufactorid"=>$row2['manufactor'],
			"manufactorname"=>get_obj_name("pkn_manufactor",$row2['manufactor']),
			"providerid"=>$row2['provider'],
			"providername"=>get_obj_name("pkn_provider",$row2['provider']),
			"purityid"=>$row2['purity'],
			"purityname"=>get_obj_name("pkn_purity",$row2['purity']),
			"storeid"=>$row2['store'],
			"storename"=>get_obj_name("pkn_store",$row2['store']),
			"fieldid"=>$row2['field'],
			"fieldname"=>get_obj_name("pkn_field",$row2['field']),
			"typeid"=>$row2['type'],
			"typename"=>get_obj_name("pkn_type",$row2['type']),
			"stateid"=>$row2['state'],
			"statename"=>get_obj_name("pkn_state",$row2['state']),
			"label"=>$row2['name']." <> ".get_obj_name("pkn_field",$row2['field'])." <> ".get_obj_name("pkn_manufactor",$row2['manufactor']));
			array_push($reply,$arr);
		}
	}
	

}else if($type=="name"){
	$sql1="SELECT * FROM pkn_name WHERE (name LIKE '{$term}') ORDER BY name ASC";
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$arr=array("label"=>$row1['name'],"id"=>$row1['id'],"name"=>$row1['name'],"type"=>$row1['type']);
		array_push($reply,$arr);
	}

}else if($type=="solution"){
	$type1=get_type_id($type);
	$sql1="SELECT * FROM pkn_name WHERE (type='{$type1}' AND name LIKE '{$term}') ORDER BY name ASC";// lay id name
	$query1 = mysql_query($sql1);
	while ($row1 = mysql_fetch_assoc($query1)){
		$sql2="SELECT * FROM {$table} WHERE name = '{$row1['id']}'";// lay id name
		$query2 = mysql_query($sql2);
		while ($row2 = mysql_fetch_assoc($query2)){
			$arr=array("label"=>getname($row2['name']),"id"=>$row2['id'],"name"=>getname($row2['name']),"units"=>get_formula_units($row2['id']),"unitsname"=>get_obj_name("pkn_units",get_formula_units($row2['id'])));
			array_push($reply,$arr);
		}
	}
}
echo json_encode($reply);
?>