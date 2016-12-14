<?php
	header('Access-Control-Allow-Origin:*');
  	header('Access-Control-Allow-Methods:POST');
  	header('Access-Control-Allow-Headers:x-requested-with,content-type');
  	header("Content-type: text/html; charset=UTF-8");
	$conn = mysql_connect("localhost","root","");
  	if(!$conn){
    	die("false".mysql_error());
  	}else{
  		mysql_select_db("left_board") or die(mysql_error());
  		$result = mysql_query("select * from info order by id");
  		if($result){
    		while($rows = mysql_fetch_row($result)){
        		echo "<div class='li'><h3>" . "看官" . $rows[0] . "<div class='clr'></div></h3><dl><dt class='hfinfo'>" . $rows[1] . "</dt></dl></div>";
			}
  		}else{
    		die(mysql_error());
  		}
  	}
?>