<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>SAM - PUCOBRE</title>
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="chrome=1"><![endif]-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="format-detection" content="telephone=no"/>
		<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
		
		<script type="text/javascript" src="js/jquery/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="js/jquery/popper.min.js"></script>
		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery_validate/jquery.validate.js"></script>

		<link rel="stylesheet" href="styles/bootstrap.min.css">
		<link rel="stylesheet" href="styles/style.css">
		<link rel="stylesheet" href="styles/all.css">
		<!-- Adobe Fonts -->
		<!--<script src="http://use.edgefonts.net/didact-gothic:n4:all.js"></script>	-->
		<!--[if gte IE 9]>
		<style type="text/css">
		.gradient {
		   filter: none;
		}
		</style>
		<![endif]-->
	</head>
	<body>
		<?php
			include('navbar.php');
		?>
		<div class="container-fluid sam_content">
			<div class="box">
				<div class="container">
					<?php
					if($tip == 1){ //1 creacion
						?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <i class="fas fa-check"></i> La Bodega ha sido agregada correctamente, Si desea modificarla, debe dirigirse al Menú "Perfil".
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<?php
					}else if($tip == 2){ //2 modificacion
						?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <i class="fas fa-check"></i> La Bodega ha sido modificada exitosamente.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php		
					}
					?>
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<a href="index.php?p=imina" class="sam_menu">
								<div class="box-part text-center">
									<i class="fas fa-sign-in-alt fa-3x"></i>
									<div class="title">
										<h4>Ingreso a Mina / Entrega EPP</h4>
									</div>
								</div>
							</a>
						</div>	 
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<a href="index.php?p=smina" class="sam_menu">
								<div class="box-part text-center">
								<i class="fas fa-sign-out-alt fa-3x"></i>
									<div class="title">
										<h4>Salida de Mina / Retorno EPP</h4>
									</div>
								</div>
							 </a>
						</div>	 
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>