<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: mantenimientoProveedores.php");
	}
	
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
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE proveedores  set rnc = ?, nombre = ?, estado =?, contacto =?, telefono =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($rnc,$nombre,$estado,$contacto, $telefono,$id));
			Database::disconnect();
			header("Location: mantenimientoProveedores.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM proveedores where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$rnc = $data['rnc'];
		$nombre = $data['nombre'];
		$estado = $data['estado'];
		$contacto = $data['contacto'];
		$telefono = $data['telefono'];
		Database::disconnect();
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
		    			<h3>Update a Proveedor</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($rncError)?'error':'';?>">
					    <label class="control-label">RNC</label>
					    <div class="controls">
					      	<input name="rnc" type="text"  placeholder="rnc" value="<?php echo !empty($rnc)?$rnc:'';?>">
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
					      	<input name="estado" type="text"  placeholder="Estado" value="<?php echo !empty($estado)?$estado:'';?>">
					      	<?php if (!empty($estadoError)): ?>
					      		<span class="help-inline"><?php echo $estadoError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($contactoError)?'error':'';?>">
					    <label class="control-label">Contacto</label>
					    <div class="controls">
					      	<input name="contacto" type="text"  placeholder="contacto" value="<?php echo !empty($contacto)?$contacto:'';?>">
					      	<?php if (!empty($contactoError)): ?>
					      		<span class="help-inline"><?php echo $contactoError;?></span>
					      	<?php endif;?>
					    	</div>
						</div>
						<div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
					    <label class="control-label">Telefono</label>
					    <div class="controls">
					      	<input name="telefono" type="text"  placeholder="telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
					      	<?php if (!empty($telefonoError)): ?>
					      		<span class="help-inline"><?php echo $telefonoError;?></span>
					      	<?php endif;?>
					    	</div>
						</div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="mantenimientoProveedores.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>