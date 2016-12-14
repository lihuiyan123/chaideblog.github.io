<?php
  header('Access-Control-Allow-Origin:*');
  header('Access-Control-Allow-Methods:POST');
  header('Access-Control-Allow-Headers:x-requested-with,content-type');
  header("Content-type: text/html; charset=UTF-8");
  $data = $_POST;
  foreach($data as $key => $value){
  	$v = $value;
  }
  $temp = 0;
  $conn = mysql_connect("localhost","root","");
  if(!$conn){
    die("false".mysql_error());
  }else{
  	mysql_select_db("left_board") or die(mysql_error());
  	$result = mysql_query("select id from info");
  	if($result){
    	while($rows = mysql_fetch_row($result)){
    		for($i = 0; $i < count($rows); $i++)
        		if($temp < $rows[$i]){
        			$temp = $rows[$i];
        		}
		}
  	}else{
    	die(mysql_error());
  	}
  	$temp ++;
  	$result = mysql_query("insert into info values('$temp','$v')");
  	if($result){
    	echo "ok";
  	}else{
    	die(mysql_error());
  	}
  }	
?>
