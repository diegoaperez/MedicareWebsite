<?php
include("conecta.php");     
		$id_emp = mysqli_real_escape_string($dbconnection, $_GET['eid']);
		$id_dept = mysqli_real_escape_string($dbconnection, $_GET['did']);

	$query_delete_works = "delete from works where eid=$id_emp and did=$id_dept";
// 	print($query_insert);
// 	print "Edita $edita";
// 	exit();
	if (mysqli_query($dbconnection,$query_delete_works)) 
	{
		
		$query_delete_emp = "delete from emp where eid=$id_emp";
		mysqli_query($dbconnection,$query_delete_emp);
		
		header("Location: demo_struc.php");

	}	 
	else 
	{
		$error=mysqli_error($dbconnection);
		mysqli_close($dbconnection);
		header("Location: demo_struct.php?error=$error");
	}
?>
