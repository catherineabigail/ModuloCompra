<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$rncError = null;
		$nombreError = null;
		$estadoError = null;
		$contactoError = null;
		$telefonoError = null;
		
		// keep track post values
		$rnc = $_POST['rnc'];
		$nombre = $_POST['nombre'];
		$estado = $_POST['estado'];
		$contacto = $_POST['contacto'];
		$telefono = $_POST['telefono'];
		
		// validate input
		$valid = true;
		if (empty($rnc)) {
			$rncError = 'Introduzca un RNC';
			$valid = false;
		}
		
		if (empty($nombre)) {
			$nombreError = 'Introduzca un nombre Comercial';
			$valid = false;
		} //else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			//$emailError = 'Please enter a valid Email Address';
			//$valid = false;
		//}
		
		if (empty($estado)) {
			$estadoError = 'Introduzca el estatus';
			$valid = false;
		}
			if (empty($contacto)) {
			$contactoError = 'Introduzca un contacto';
			$valid = false;
		}
			if (empty($telefono)) {
			$telefonoError = 'Introduzca un telefono';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO proveedores (rnc,nombre,estado,contacto, telefono) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($rnc,$nombre,$estado,$contacto,$telefono));
			Database::disconnect();
			header("Location: mantenimientoProveedores.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a Proveedor</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($rncError)?'error':'';?>">
					    <label class="control-label">Rnc</label>
					    <div class="controls">
					      	<input name="rnc" type="text"  placeholder="Rnc" value="<?php echo !empty($rnc)?$rnc:'';?>">
					      	<?php if (!empty($rncError)): ?>
					      		<span class="help-inline"><?php echo $rncError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="nombre" type="text" placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
					      	<?php if (!empty($nombreError)): ?>
					      		<span class="help-inline"><?php echo $nombreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($estadoError)?'error':'';?>">
					    <label class="control-label">Estado</label>
					    <div class="controls">
					      	<input name="estado" type="text"  placeholder="estado" value="<?php echo !empty($estado)?$estado:'';?>">
					      	<?php if (!empty($estadoError)): ?>
					      		<span class="help-inline"><?php echo $estadoError;?></span>
					      	<?php endif;?>
					    </div>
					   </div>
					   <div class="control-group <?php echo !empty($contactoError)?'error':'';?>">
					    <label class="control-label">Contacto</label>
					    <div class="controls">
					      	<input name="contacto" type="text"  placeholder="Contacto" value="<?php echo !empty($contacto)?$contacto:'';?>">
					      	<?php if (!empty($contactoError)): ?>
					      		<span class="help-inline"><?php echo $contactoError;?></span>
					      	<?php endif;?>
					    	</div>
						</div>
						<div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
					    <label class="control-label">Telefono</label>
					    <div class="controls">
					      	<input name="telefono" type="text"  placeholder="Telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
					      	<?php if (!empty($telefonoError)): ?>
					      		<span class="help-inline"><?php echo $telefonoError;?></span>
					      	<?php endif;?>
					    	</div>
						</div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="mantenimientoProveedores.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>