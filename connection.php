<?php 
    session_start();
 
	//local db 
	
	if($_SERVER['HTTP_HOST']=="localhost")
	{
	$serverIp="localhost";
	$userName="root";
	$password="";
	$dbname="wallpaper";
	
	}else
	{
	//Live
	 
	$serverIp="localhost";
	$userName="abac";
	$password="pass";
	$dbname="dbname";
	}
	$cn=mysql_connect($serverIp,$userName,$password) OR Die("Couldn't Connect - ".mysql_error());
	$link=mysql_select_db($dbname,$cn)or Die("Couldn't SELCECT - ".mysql_error()); 
	

?> 
	 
 