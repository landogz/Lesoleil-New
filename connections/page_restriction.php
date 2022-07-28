<?php ob_start(); error_reporting(0);
	if ($_SESSION['empID']==""){
		echo "<script type='text/javascript'>window.top.location='index';</script>";
	}
?>

 <?php ob_flush(); ?>