<?php

if($_SERVER['HTTP_HOST']=="localhost")
	{
		$host="localhost"; //replace with your hostname
		$username="root"; //replace with your username
		$password=""; //replace with your password
		$db_name="wallpaper"; //replace with your database
	}else{
		
		$host="localhost"; //replace with your hostname
		$username="viaviw56_ILTS"; //replace with your username
		$password="Admin@2013"; //replace with your password
		$db_name="viaviw56_wallpaper"; //replace with your database

	}
	


$con=mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");


   // $table_first = 'radio';
    //$query = "SELECT * FROM tbl_gallery where cat_id='1'";
	
	
	if(isset($_GET['cat_id']))
	{
		
		$cat_id=$_GET['cat_id'];		
	
			$query="SELECT tbl_gallery.id,tbl_gallery.cat_id,tbl_gallery.image,tbl_category.category_name FROM tbl_gallery
		LEFT JOIN tbl_category ON tbl_gallery.cat_id= tbl_category.cid 
		where tbl_gallery.cat_id='".$cat_id."'";
		
	}
	else if(isset($_GET['latest']))
	{
		$limit=$_GET['latest'];	 	
		$query="SELECT tbl_gallery.id,tbl_gallery.cat_id,tbl_gallery.image,tbl_category.category_name FROM tbl_gallery
		LEFT JOIN tbl_category ON tbl_gallery.cat_id= tbl_category.cid 
		ORDER BY tbl_gallery.id DESC LIMIT $limit";
	}
	else
	{
		$query="SELECT cid,category_name FROM tbl_category";
			
	}
	
	
     
	$resouter = mysql_query($query, $con);
     
    $set = array();
     
    $total_records = mysql_numrows($resouter);
    if($total_records >= 1){
     
      while ($link = mysql_fetch_array($resouter, MYSQL_ASSOC)){
	  
	  	/*$cat_id=$link['cat_id'];
		$qry="select * from tbl_category where id='".$cat_id."'";
		$res=mysql_query($qry);
		$row=mysql_fetch_assoc($res);
	  	
		$set['category'][]=$row['category_name'];*/
        $set['wallpaper'][] = $link;
      }
    }
     
    echo $val= json_encode($set);
	 	 
	 
?>