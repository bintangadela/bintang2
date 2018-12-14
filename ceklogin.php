<?php
$mysqli = new mysqli("localhost","root","","girlee");
session_start();


$user=($_POST['user']);
$pass=md5($_POST['pass']);

$res="SELECT User,Password FROM tbluser where User='$user3'";
$result =$mysqli-> query($res);
$row=$result->fetch_array();


if(!empty($user) and !empty($pass)){
	if($user=='admin' and $pass=='admin'){
		$_SESSION['login']=true;
		$_SESSION['user']=$user;
		header('Location:admin.php');
	}
	else{
		
		if($user==$row['User'] and  $pass==$row['Password']){
		$_SESSION['login']=true;
		$_SESSION['user']=$user;
		header('Location:index.php');
		}

}}


?> 