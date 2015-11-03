<?php
$db_host = "localhost"; // Giữ mặc định là localhost
$db_name    = 'iot';// Can thay doi
$db_username    = 'root'; //Can thay doi
$db_password    = '!()(!(*(';//Can thay doi
$conn=mysql_connect("{$db_host}", "{$db_username}", "{$db_password}") or die("Không thể kết nối database");
mysql_select_db("{$db_name}") or die("Không thể chọn database");
mysql_set_charset('utf8',$conn);
$locahost = "../pkn/";
$tb_prefix="pkn_";

function get_col_val($__id,$__table,$__col){
	$trave="";
	$sql="SELECT {$__col} FROM {$__table} WHERE id = '{$__id}'";
		$results = mysql_query($sql)or die(mysql_error());
		while ($row = mysql_fetch_assoc($results)){$trave=$row[$__col];}
	return $trave;
}
function get_obj_name($__tab,$__objid){
	$trave="";
	$sql="SELECT name FROM {$__tab} WHERE id = '{$__objid}' ORDER BY name ASC";
	$result = mysql_query($sql)or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)){$trave=$row['name'];}
	return $trave;
}



function getname($__id){
	$trave="";
	$sql="SELECT name FROM pkn_name WHERE id = '{$__id}'";
		$results = mysql_query($sql)or die(mysql_error());
		while ($row = mysql_fetch_assoc($results)){$trave=$row['name'];}
	return $trave;
}
function get_type_id($__tab){
	$trave="";
	$sql="SELECT id FROM pkn_type WHERE name = '{$__tab}'";
		$results = mysql_query($sql)or die(mysql_error());
		while ($row = mysql_fetch_assoc($results)){$trave=$row['id'];}
	return $trave;
}
function get_type_name($__id){
	$trave="";
	$sql="SELECT name FROM pkn_type WHERE id = '{$__id}'";
		$results = mysql_query($sql)or die(mysql_error());
		while ($row = mysql_fetch_assoc($results)){$trave=$row['name'];}
	return $trave;
}
function get_id($__tab,$__nameid){
	$trave="";
	$sql="SELECT id FROM {$__tab} WHERE name = '{$__nameid}'";
		$results = mysql_query($sql)or die(mysql_error());
		while ($row = mysql_fetch_assoc($results)){$trave=$row['id'];}
	return $trave;
}


function get_col_id($__name,$__table,$__col){
	$trave="";
	$sql="SELECT {$__col} FROM {$__table} WHERE name = '{$__name}'";
		$results = mysql_query($sql)or die(mysql_error());
		while ($row = mysql_fetch_assoc($results)){$trave=$row[$__col];}
	return $trave;
}
function get_formula_units($__solution){
	$trave="";
	$sql="SELECT units FROM pkn_formula WHERE (solution = '{$__solution}') AND (total=TRUE)";
		$results = mysql_query($sql)or die(mysql_error());
		while ($row = mysql_fetch_assoc($results)){$trave=$row['units'];}
	return $trave;
}
function set_valid($_table,$_user,$_id){	// valid content
	$trave=FALSE;
	$sql="UPDATE {$_table} SET valid = TRUE,user_valid='{$_user}',pending=FALSE,date_valid=CURRENT_TIMESTAMP WHERE id = '{$_id}'";
	if (mysql_query($sql))
		$trave=TRUE;
	else
		$trave=FALSE;
	return $trave;
}
function set_pending($_table,$_id){
	$trave=FALSE;
	$sql="UPDATE {$_table} SET valid = FALSE,pending=TRUE,date_valid='0' WHERE id = '{$_id}'";
	if (mysql_query($sql))
		$trave=TRUE;
	else
		$trave=FALSE;
	return $trave;
}




function get_name($__id,$__table){
	$trave="";
	$sql="SELECT name FROM ".$__table." WHERE id = '{$__id}'";
		$results = mysql_query($sql)or die(mysql_error());
		while ($row = mysql_fetch_assoc($results)){$trave=$row['name'];}
	return $trave;
}
function get_content_name($__id){
	$tmp="";
	$sql="SELECT name FROM pkn_content WHERE id = '{$__id}'";
	$results = mysql_query($sql)or die(mysql_error());
	while ($row = mysql_fetch_assoc($results)){$tmp=$row['name'];}
	return get_name($tmp,"pkn_name");
}
function get_content_remain($__id,$__date){
	$nhap=0;
	$xuat=0;
	$sql1="";
	$sql2="";
	$sql1="SELECT * FROM pkn_import WHERE (valid=TRUE) AND (content = '{$__id}') AND (receive < '{$__date}')";	
	$results1 = mysql_query($sql1)or die(mysql_error());
	while ($row1 = mysql_fetch_assoc($results1)){ $nhap+=$row1['weight'];}
	
	$sql2="SELECT * FROM pkn_used WHERE (valid=TRUE) AND (content = '{$__id}') AND (time < '{$__date}')";	
	$results2 = mysql_query($sql2)or die(mysql_error());
	while ($row2 = mysql_fetch_assoc($results2)){$xuat+=$row2['weight'];}
	return ($nhap-$xuat);
}
function get_content_import($__id,$__from,$__to){
	$tmp=0;
	$sql="";
	if(($__from==0)&&($__to==0)){
	$sql="SELECT * FROM pkn_import WHERE (valid=TRUE) AND (content = '{$__id}')";	
	}else{
	$sql="SELECT * FROM pkn_import WHERE (valid=TRUE) AND (content = '{$__id}') AND (receive >= '{$__from}') AND (receive <= '{$__to}')";	
	}
	$results = mysql_query($sql)or die(mysql_error());
	while ($row = mysql_fetch_assoc($results)){
		$tmp+=$row['weight'];
		}
	return $tmp;
}
function get_content_used($__id,$__from,$__to){
	$tmp=0;
	$sql="";
	if(($__from==0)&&($__to==0)){
	$sql="SELECT * FROM pkn_used WHERE (valid=TRUE) AND (content = '{$__id}')";	
	}else{
	$sql="SELECT * FROM pkn_used WHERE (valid=TRUE) AND (content = '{$__id}') AND (time >= '{$__from}') AND (time <= '{$__to}')";	
	}
	$results = mysql_query($sql)or die(mysql_error());
	while ($row = mysql_fetch_assoc($results)){
		$tmp+=$row['weight'];
		}
	return $tmp;
}
function stripslashes_deep($value)
{
	$value = is_array($value) ?array_map('stripslashes_deep', $value):stripslashes($value);
    return $value;
}
?>