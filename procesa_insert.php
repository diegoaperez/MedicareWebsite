<?php


function genEid()
{
	$eid="";
	for($i=0;$i<9;$i++) $eid.=rand(0,9);
	return intval($eid);
}

// print_r($_POST);
// print "<br>";
// var_dump($_POST);
// 
// exit();

include("conecta.php");     
     $edita=0;
     if(isset($_POST['id_emp']))
     {
     	$edita=1;
     	$id_emp = mysqli_real_escape_string($dbconnection, $_POST['id_emp']);
     }
     else
	{
	    $id_dept = mysqli_real_escape_string($dbconnection, $_POST['departamento']);
		do
		{
			$id_emp=genEid();
			$query="SELECT count(eid) from emp where eid=$id_emp";
			$result = mysqli_query($dbconnection,$query);
			$esta=mysqli_fetch_array($result)[0];

		}while($esta);
	}	
    $nombre = mysqli_real_escape_string($dbconnection, $_POST['nombre']);
    $edad = mysqli_real_escape_string($dbconnection, $_POST['edad']);
    $salario = mysqli_real_escape_string($dbconnection, $_POST['salario']);
    $porciento = mysqli_real_escape_string($dbconnection, $_POST['porciento']);

	$query_insert = "insert into emp (`eid`,`ename`, `age`, `salary`) values ($id_emp,'$nombre',$edad,$salario) on duplicate key update ename='$nombre',age=$edad, salary=$salario";
// 	print($query_insert);
// 	print "Edita $edita";
// 	exit();
	if (mysqli_query($dbconnection,$query_insert)) 
	{
		if(!$edita)
		{
			$query_insert2 = "insert into works (`eid`,`did`, `pct_time`) values ($id_emp,'$id_dept',$porciento)";
			if (mysqli_query($dbconnection,$query_insert2)) 
			{
				mysqli_close($dbconnection);
				header("Location: demo_struc_get.php?id_dept=$id_dept");
			}
			else 
			{
				$error=mysqli_error($dbconnection);
				mysqli_close($dbconnection);
				header("Location: demo_insert.php?error=$error");
			}
		}
		else
		{
			mysqli_close($dbconnection);
			header("Location: demo_struc.php");		
		}	
	}	 
	else 
	{
		$error=mysqli_error($dbconnection);
		mysqli_close($dbconnection);
		header("Location: demo_insert.php?error=$error");
	}
?>
