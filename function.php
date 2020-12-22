<?php
require_once("thumbnail_images.class.php");
class k_wallpaper
{

//Category Query	
	function addCategory()
	{
		 
		
	
	$sql="select * from tbl_category";
	$res=mysql_query($sql);
	$row_id=mysql_num_rows($res);
	$disp_order=$row_id + 1;
		
	  
		$cat_result=mysql_query('INSERT INTO `tbl_category` (`category_name` , `display_order`) VALUES (  \''.addslashes($_POST['category_name']).'\',\''.$disp_order.'\')');
		

		
	}
	
	function editCategory()
	{
			 
			 
	$cat_result=mysql_query('UPDATE `tbl_category` SET `category_name`=\''.addslashes($_POST['category_name']).'\' WHERE cid=\''.$_GET['cat_id'].'\'');

			
	}
	
	function deleteCategory()
	{
		$cat_result=mysql_query('DELETE FROM `tbl_category` WHERE cid=\''.$_GET['cat_id'].'\'');
	}

 
//Image Gallery
	function addimage()
	{
		$count = count($_FILES['image']['name']);
		for($i=0;$i<$count;$i++)
		{ 
			$albumimgnm=rand(0,99999)."_".$_FILES['image']['name'][$i];
			 $pic1=$_FILES['image']['tmp_name'][$i];
			   
		
			   if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$albumimgnm;
				
				 copy($pic1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$albumimgnm;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 100;
						$obj_img->NewHeight = 100;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  else
						  {
						  		$date=date('Y-m-j');
								
							  
						  		$res=mysql_query('INSERT INTO `tbl_gallery` (`cat_id`,`image_name`,`image_date`,`image`) VALUES (\''.$_POST['category_id'].'\',\''.addslashes($_POST['image_name'][$i]).'\',\''.$date.'\',\''.$albumimgnm.'\')');
						  }
				}		  
	}
		
	function editimage()
	{
		$date=date('Y-m-j');
		
		 if($_FILES['image']['name']=="")
		 {
		
		$res=mysql_query('UPDATE `tbl_gallery` SET `cat_id`=\''.$_POST['category'].'\',`image_name`=\''.addslashes($_POST['image_name']).'\',`image_date`=\''.$date.'\' WHERE id=\''.$_GET['img_id'].'\'');
		}
		else
		{
		
			//Image Unlink
			
			$img_res=mysql_query('SELECT * FROM tbl_gallery WHERE id=\''.$_GET['img_id'].'\'');
			$img_row=mysql_fetch_assoc($img_res);
			
			if($img_row['image']!="")
			{
				unlink('images/'.$img_row['image']);
				unlink('images/thumbs/'.$img_row['image']);
			}	
		
			//Image Upload
			$albumimgnm=rand(0,99999)."_".$_FILES['image']['name'];
			 $pic1=$_FILES['image']['tmp_name'];
			   
		
			   if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$albumimgnm;
				
				 copy($pic1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$albumimgnm;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 100;
						$obj_img->NewHeight = 100;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  else
						  {
						  		$date=date('Y-m-j');
								
							  
						  		$res=mysql_query('UPDATE `tbl_gallery` SET `cat_id`=\''.$_POST['category'].'\',`image_name`=\''.addslashes($_POST['image_name']).'\',`image_date`=\''.$date.'\',`image`=\''.$albumimgnm.'\' WHERE id=\''.$_GET['img_id'].'\'');
						  }
		}
		
	}	
	
	function deleteImage()
	{
		//Image Unlink
			
			$img_res=mysql_query('SELECT * FROM tbl_gallery WHERE id=\''.$_GET['img_id'].'\'');
			$img_row=mysql_fetch_assoc($img_res);
			
			if($img_row['image']!="")
			{
				unlink('images/'.$img_row['image']);
				unlink('images/thumbs/'.$img_row['image']);
			}	
			
			$img_result=mysql_query('DELETE FROM `tbl_gallery` WHERE id=\''.$_GET['img_id'].'\'');
	}	
	
		
}

?>