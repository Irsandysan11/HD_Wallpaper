<?php include("includes/header.php");

	require("includes/function.php");
	$kwallpaper=new  k_wallpaper;
	
	if(isset($_POST['submit']) and isset($_GET['add']))
	{
	
		$_SESSION['msg']="Category added successfully";
		
		
		$kwallpaper->addCategory();
		
		 
		echo "<script>document.location='manage_category.php';</script>"; 
	    exit;
		
	}
	
	if(isset($_GET['cat_id']))
	{
			 
			$qry="SELECT * FROM tbl_category where cid='".$_GET['cat_id']."'";
			$result=mysql_query($qry);
			$row=mysql_fetch_assoc($result);

	}
	if(isset($_POST['submit']) and isset($_POST['edit']))
	{
		 
		$kwallpaper->editCategory();
		
		echo "<script>document.location='manage_category.php';</script>"; 
	    exit;
	}


?>
<script src="js/category.js" type="text/javascript"></script>  
                <!-- h2 stays for breadcrumbs -->
                <h2><a href="home.php">Dashboard</a> &raquo; <a href="#" class="active"></a></h2>
                
                <div id="main">
                	<form action="" name="addeditcategory" method="post" class="jNice" onsubmit="return checkValidation(this);">
					 
					<input  type="hidden" name="edit" value="<?php echo $_GET['cat_id'];?>" />
					                    	 
					<h3>Add Category</h3>
                    	<fieldset>
						 
                        	<p><label>Category Name:</label>
								<input type="text" name="category_name" id="category_name" value="<?php if(isset($_GET['cat_id'])){echo $row['category_name'];}?>" class="text-long" />
							</p>
                        	 
                             
                         
                            <input type="submit" name="submit" value="<?php if(isset($_GET['cat_id'])){?>Edit Category<?php }else {?>Add Category<?php }?>" onclick="return chk(this);"/>
                        </fieldset>
                    </form>
                </div>
                <!-- // #main -->
                
                <div class="clear"></div>
            </div>
            <!-- // #container -->
        </div>	
        <!-- // #containerHolder -->
        
<?php include("includes/footer.php");?>       
