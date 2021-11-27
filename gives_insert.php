<?php
 include("conecta.php");

	$edita =0;
    if(isset($_GET['edita']) and isset($_GET['eid']) and isset($_GET['did']))
    {
    	$edita = mysqli_real_escape_string($dbconnection, $_GET['edita']);
		$id_emp = mysqli_real_escape_string($dbconnection, $_GET['eid']);
		$id_dept = mysqli_real_escape_string($dbconnection, $_GET['did']);
		$query="SELECT * from emp natural join works where eid=$id_emp and did=$id_dept";

		$result = mysqli_query($dbconnection,$query);
		$datos_usuario=mysqli_fetch_array($result, MYSQLI_ASSOC);
		//mysqli_affected_rows($dbconnection);

    }


	$query="SELECT * from dept";

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
	<h2 align="center"><?php if($edita)print "Edita"; else print "Crear";?> entrada de empleado</h2>

<form action="procesa_insert.php" method="post">
  <div class="form-group">
    <label for="nombre">Nombre Empleado</label>
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Entre nombre" value="<?php if($edita)print $datos_usuario['ename'];?>" required>
  </div>
  <div class="form-group">
    <label for="edad">Edad</label>
    <input type="number" min=16 max=150 class="form-control" name="edad" id="edad" placeholder="Entre edad" value="<?php if($edita)print $datos_usuario['age'];?>" required>
  </div>

  <div class="form-group">
    <label for="salario">Salario</label><br>
  <div class="input-group">
   <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
   <input type="number" class="form-control" name="salario" id="salario" placeholder="Entre salario" value="<?php if($edita)print $datos_usuario['salary'];?>" required>
  </div>
  </div>
    <div class="form-group">
    <label for="exampleFormControlSelect2">Seleccione departamento</label>
    <select class="form-control" name="departamento" id="departamento" required <?php if($edita)print  'disabled';?>>
      <option></option>
    <?php
    	while($dept = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
	?>
      <option value="<?php print $dept['did'];?>" <?php if(isset($id_dept) and $dept['did']==$id_dept)print 'selected';?>><?php print $dept['dname'];?></option>
    <?php
    	}
    	?>
    </select>
  </div>

  <div class="form-group">
    <label for="nombre">Porciento</label>
    <input type="number" class="form-control" min=0 max=100 name="porciento" id="porciento" placeholder="Entre porciento" value="<?php if($edita)print $datos_usuario['pct_time'];?>" required>
  </div>
<?php if($edita)print '<input type="hidden" name="id_emp" value='.$id_emp.'>';

?>

  <input type="submit" class="btn btn-primary" value="<?php if($edita)print "Edita"; else print "Inserta";?>">
</form>

</div>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
 	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"</script>
 	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"</script>

</body>
</html>
