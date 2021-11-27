<?php
include("conecta.php");     
    //demo_struc_get.php?id_dept=1
    if(isset($_GET['id_dept']))$id_dept= mysqli_real_escape_string($dbconnection, $_GET['id_dept']);
	else $id_dept=1;
	$query_dept = "select dname from dept where did=$id_dept";
// 	print($query_dept);print "<br>";
	$result_dept = mysqli_query($dbconnection,$query_dept);
	$nombre_dept = mysqli_fetch_array($result_dept)[0];
	
	$query="SELECT * from emp natural join works where did=$id_dept";
	$result = mysqli_query($dbconnection,$query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   </head>
	<body>
	<div id="wrap" class="container">
	<h2 align="center">Lista de empleados que trabajan en el Departamento <br> <?php print $nombre_dept;?></h2>
	<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
	  <thead class="thead-light">
		<tr>
		  <th scope="col">Nombre</th>
		  <th scope="col">Edad</th>
		  <th scope="col">Salario</th>
		  <th scope="col">% en departamento</th>
		</tr>
	  </thead>
	  <tbody>

<?php
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		print "<tr><td>";
		print $row['ename'];
		print "</td><td>";
		print $row['age'];
		print "</td><td>";
		setlocale(LC_MONETARY, 'en_US');
		print money_format("%n", $row['salary']);
		print "</td><td>";
		print $row['pct_time'];
		print "</td></tr>";			
	}

?>


  	</tbody>


</div>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
 	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"</script>
 	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"</script>
 
 <script>
  $(document).ready(function () {
$('#dtBasicExample').DataTable({
"lengthMenu": [ [-1, 50, 10], ["Todes", 50, 10] ]
});
$('.dataTables_length').addClass('bs-select');
});
</script>

</body>
</html>
<?php
mysqli_close($dbconnection);
?>
