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
			if($tip == '2'){ //1 creacion
				include('navbar.php');
			}
		?>
		<div class="container-fluid sam_content">
			<div class="row justify-content-center">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<?php
						if($tip == '1'){ //1 creacion
							?>
							<h5>Para poder continuar en el Sistema debe seleccionar una Bodega.</br>Si posteriormente desea modificarla, debe dirigirse al Menú "Perfil".</h5>
							<?php
						}else{
							?>
							<h5>Actualización de Bodega.</h5>
							<?php
						}
					?>
					</br></br>
					<form name="find" action="index.php" method="post" id="myform">
						<input type="hidden" name="p" value="user_find2"/>
						<input type="hidden" name="tip" value="<?php if($tip == '1') echo 1; else echo 2;?>"/>								
						<input type="hidden" name="b_text" id="b_text" value=""/>								
						<div class="form-group row">
						<label for="bodega" class="col-sm-4">Bodega de Entrega</label>
							<div class="col-sm-5">
								<select id="bodega" class="form-control bodega" name="bodega" disabled>
									<option value="">Seleccione la Bodega</option>
								</select>
							</div>
						</div>
						<div class="col-md-3 offset-md-5">
							<button type="submit" class="btn btn-primary">
								<i class="fas fa-sign-in-alt"></i> Ingresar
							</button>
						</div>
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
		<script>
		$(document).ready(function(){
			$('#myform').validate({			
				rules :{
					bodega: {
						required: true
					}	   
				},
				messages : {
					bodega: {
						required: "*Debe seleccionar una Bodega para continuar en el Sistema."
					}
				}
			}); 
			
			var _url="vws/ajax_bodegas3.php";
			//console.log(_url);
			$.ajax({
				url: _url,
				type: "GET",
				dataType: "JSON",
				success: function(data){
					if(data.status){
						$("#bodega").prop("disabled", false);							
						$(".bodega").fadeOut(300, function(){
							$(".bodega").html(data.selector_bod);
							$(".bodega").fadeIn(400);
						});
					}else {
						//alert("fail!!");
						Swal.fire({
							title: 'Error',
							html: data.error_msg,
							type: 'error',
							confirmButtonText: 'Aceptar',
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false
						});
					}
				},
				error: function (){
					Swal.fire({
						title: 'Error',
						text: 'No se encontró información relacionada',
						type: 'error',
						confirmButtonText: 'Aceptar',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false
					});
				}
			});
			$('#bodega').change(function(){
				var bodega_text = $("#bodega option:selected").text();
				$('#b_text').val(bodega_text);				
			}); 
			
		}); 
		</script>
	</body>
</html>