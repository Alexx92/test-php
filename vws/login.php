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
		<script>
			$(function(){
				$('#myform').validate({			
					rules :{
						usuario: {
							required: true
						},						
						password: {
							required: true
						}	   
					},
					messages : {
						usuario: {
							required: "*Debe ingresar Usuario."
						},
						password: {
							required: "*Debe ingresar Password."
						}
					}
				}); 
			});
		</script>
	</head>
	<body>
		<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">
				<img src="images/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
				SAM - Sistema de Control de Seguridad de Acceso a Mina
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</nav>
		<div class="cotainer sam_content">
			<div class="row justify-content-center">
				<div class="col-md-5">
					<?php
					if(isset($pr) && $pr != ''){
						if($pr == 1){ //cierre sesion
							?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
							  <i class="fas fa-lock"></i> Su sesión ha sido cerrada con éxito
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<?php
						}else if($pr == 2){ //tiempo de sesion caducado
							?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  <i class="far fa-clock"></i> Su sesión ha superado el tiempo de espera
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
						<?php		
						}
					}?>
					<div class="card">
						<div class="card-header">Control de Acceso</div>
						<div class="card-body">
							<form name="find" action="index.php" method="post" id="myform">
								<input type="hidden" name="p" value="user_find"/>
								<div class="form-group row">
									<label for="usuario" class="col-md-4 col-form-label text-md-right">Usuario</label>
									<div class="col-md-6">
										<input type="text" id="usuario" class="form-control" name="usuario" placeholder="Ingrese Usuario">
									</div>
								</div>

								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
									<div class="col-md-6">
										<input type="password" id="password" class="form-control" name="password" placeholder="Ingrese Password">
									</div>
								</div>

								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										<i class="fas fa-sign-in-alt"></i> Ingresar
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>