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
		<script type="text/javascript" src="js/jquery.Rut.js"></script>

		<script type="text/javascript" src="js/datatables/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/datatables/dataTables.bootstrap4.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="styles/jquery.dataTables.css">
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		
		
		<link rel="stylesheet" href="styles/bootstrap.min.css">
		<link rel="stylesheet" href="styles/style.css">
		<link rel="stylesheet" href="styles/all.css">
		<link rel="stylesheet" href="styles/dataTables.bootstrap4.min.css">

		<script type="text/javascript"  src="js/sweetalert2.min.js"></script>
		<link rel="stylesheet" href="styles/sweetalert2.min.css">
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
			<div class="container">
				<div id="imgSpinner"></div>
				<div class="row">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<h5>Usuarios</h5></br>
						<form id="myform" action="#" method="">
							<input type="hidden" name="p" id="p" value="<?php echo $_SESSION['idrol']; ?>">
							<input type="hidden" name="b" id="b" value="<?php echo $_SESSION['idbodega']; ?>">
							<input type="hidden" name="b_txt" id="b_txt" value="<?php echo $_SESSION['nombodega']; ?>">
							<input type="hidden" name="idusr" id="idusr" value="">
							<input type="hidden" name="nmusr" id="nmusr" value="">
							<div class="form-group row">
								<label for="rut" class="col-sm-1 col-form-label col-form-label-sm">RUT</label>
								<div class="col-sm-2">
									<input type="text" class="form-control form-control-sm rut" name="rut" id="rut">
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-primary btn-sm search_user"><i class="fas fa-search"></i></button>
									<button type="button" class="btn btn-primary btn-sm clean_user"><i class="fas fa-backspace"></i></button>
								</div>
								<label for="rol" class="col-sm-1 col-form-label col-form-label-sm">Rol</label>
								<div class="col-sm-3">
									<select id="rol" class="form-control form-control-sm rol" name="rol" disabled>
										<option value="">Seleccione el Rol</option>
									</select>
								</div>
								<label for="est" class="col-sm-1 col-form-label col-form-label-sm">Estado</label>
								<div class="col-sm-2">
									<select id="est" class="form-control form-control-sm est" name="est" disabled>
										<option value="">Seleccione el Estado</option>
										<option value="S">Activo</option>
										<option value="N">Inactivo</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="nombre" class="col-sm-1 col-form-label col-form-label-sm">Nombre</label>
								<div class="col-sm-5">
									<input type="text" class="form-control form-control-sm" name="nombre" id="nombre" disabled>
								</div>
								<label for="usuario" class="col-sm-1 col-form-label col-form-label-sm">Usuario</label>
								<div class="col-sm-5">
									<input type="text" class="form-control form-control-sm" name="usuario" id="usuario" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label for="bodega" class="col-sm-1 col-form-label col-form-label-sm">Ubicación</label>
								<div class="col-sm-3">
									<select id="bodega" class="form-control form-control-sm bodega" name="bodega" disabled>
										<option value="">Seleccione la Bodega</option>
									</select>
								</div>
								<div class="col-sm-4 offset-sm-4 text-right">
									<button type="button" class="btn btn-primary btn-md save_user" id="save_user" disabled><i class="fas fa-user-edit"></i> Guardar</button>
									<!--<button type="button" class="btn btn-primary btn-md delete_user" id="delete_user" disabled><i class="fas fa-user-times"></i> Eliminar</button>-->
								</div>
							</div>
						</form>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-1 col-sm-12"></div>
						<h5>Listado de Usuarios</h5>
						</br></br>
						<div class="table-responsive">
							<table id="users_table" class="table table-striped">
								<thead>
									<tr>
										<th>RUT</th>
										<th>Usuario</th>
										<th>Nombre</th>
										<th>Rol</th>
										<th>Ubicación</th>
										<th>Empresa</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var table;
			$(document).ready(function(){
				initiateTable();
				$.validator.addMethod("nombreRegex", function(value, element) {
					return this.optional(element) || /(?:[A-Za-záéíóúÁÉÍÓÚ]+\s){2}[A-Za-záéíóúÁÉÍÓÚ]+/.test(value);
				}, "Debe ingresar el Nombre y los Apellidos, ej: Nombre Apellido_Paterno Apellido_Materno.");
				
				$.validator.addMethod("usuarioRegex", function(value, element) {
					return this.optional(element) || /(?:[A-Za-z]+)[.][A-Za-z]+/.test(value);
				}, "Debe ingresar el nombre.apellido_paterno.");
				
				$.validator.addMethod("rut", function(value, element){
					return this.optional(element) || $.Rut.validar(value);
				}, "Debe ingresar un rut válido.");
                $('#rut').Rut({
					validation: false
				});
				$('#myform').validate({
					rules :{
						rut: {
							required: true
						},
						rol: {
							required: true
						},
						est: {
							required: true
						},
						nombre: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						usuario: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						}
					},
					messages : {
						rut: {
							required: "*Debe ingresar un RUT."
						},
						rol: {
							required: "*Debe seleccionar un Rol."
						},
						est: {
							required: "*Debe seleccionar un Estado."
						},
						nombre: {
							required: "*Debe ingresar un Nombre."
						},
						usuario: {
							required: "*Debe ingresar un Usuario."
						}
					}
				});
				var _url="vws/ajax_search_roles.php";
				$.ajax({
					url: _url,
					type: "GET",
					dataType: "JSON",
					success: function(data){
						if(data.status){
							$(".rol").html(data.selector_rol);
						}else {
							$("#rol").prop("disabled", true);
						}
					},
					error: function (){
						$("#rol").prop("disabled", true);
					}
				});
				var _url="vws/ajax_bodegas4.php";
				//console.log(_url);
				$.ajax({
					url: _url,
					type: "GET",
					dataType: "JSON",
					success: function(data){
						if(data.status){
							$(".bodega").html(data.selector_bod);
						}else {
							$("#bodega").prop("disabled", true);
						}
					},
					error: function (){
						$("#bodega").prop("disabled", true);
					}
				});
				
				function initiateTable(){
					var _url = 'vws/ajax_search_users.php';
					if(table){
						table.destroy();
					}
					table = $('#users_table').DataTable({
						"columns": [
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": true }
						 ],
						"order": [[ 2, "desc" ]],
						"ajax": {
							"url": _url,
							"type": "GET"
						},
						 'scrollX': false,
						 'paging':   true,
						 'info':     true,
						 processing: true,
						 /*autoWidth: true,*/
						 searching: true,
						 language: {
							"sProcessing":     "Procesando...",
							//"processing":		"<img src='images/load.gif' class='img-responsive' alt='Responsive image' height='42' width='42'>",
							//"sProcessing":     "<img src='images/load.gif' class='img-responsive' alt='Responsive image' height='42' width='42'>",
							"sLengthMenu":     "Mostrar _MENU_ registros",
							"sZeroRecords":    "No se encontraron resultados",
							"sEmptyTable":     "Sin entradas registradas",
							/*"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",*/
							"sInfo":           "Mostrando registros del _START_ al _END_, total _TOTAL_ registros",
							"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
							"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
							"sInfoPostFix":    "",
							"sSearch":         "Buscar:",
							"sUrl":            "",
							"sInfoThousands":  ",",
							"sLoadingRecords": "Cargando...",
							//"sLoadingRecords": "<img src='images/load.gif' class='img-responsive' alt='Responsive image' height='42' width='42'>",
							"oPaginate": {
								"sFirst":    "Primero",
								"sLast":     "Último",
								"sNext":     "Siguiente",
								"sPrevious": "Anterior"
							},    
							"oAria": {
								"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
								"sSortDescending": ": Activar para ordenar la columna de manera descendente"
							}
						}
					});
				};
            });
			function reload_table(){
				table.ajax.reload(null,false); //reload datatable ajax 
			}
			
			function search_user(){
				console.log('search_user funcion!!');
				var rut = String($('#rut').val());
				var rutt = rut.replace(/\./g,'');
				if($("#rut").valid() == true && rut){
					$(".search_user").prop("disabled", true);
					var _url="vws/ajax_search_user5.php?rut="+rutt;
					console.log(_url);
					$.ajax({
						url: _url,
						type: "GET",
						dataType: "JSON",
						success: function(data){
							$(".search_user").prop("disabled", false);
							$("#rut").prop("disabled", true);
							$("#nombre").prop("disabled", false);
							$("#usuario").prop("disabled", false);
							$("#save_user").prop("disabled", false);
							$("#bodega").prop("disabled", false);
							$("#est").prop("disabled", false);
							$("#rol").prop("disabled", false);
							if(data.status){
								$('#idusr').val(data.id);
								$('#nmusr').val(data.nombre);
								$("#nombre").val(data.nombre);
								$("#usuario").val(data.nomusr);
								$(".bodega").val(data.idbodega);
								$(".est").val(data.statusr);
								$(".rol").val(data.prfusr);
							}else {
								var b = $("#b").val();
								$(".bodega").val(b);
								$(".est").val('S');
								$(".rol").val('5');
								Swal.fire({
									title: 'Información',
									text: 'El RUT ingresado no se encuentra o ha sido ingresado de forma incorrecta.',
									type: 'warning',
									confirmButtonText: 'Aceptar',
									allowOutsideClick: false,
									allowEscapeKey: false,
									allowEnterKey: false
								});
							}
						},
						error: function (jqXHR, textStatus, errorThrown){
							var jq_msg;
							if (jqXHR.status === 0) {
								jq_msg = 'Not connect: Verify Network.';
							}else if (jqXHR.status == 404) {
								jq_msg = 'Requested page not found [404]';
							}else if (jqXHR.status == 500) {
								jq_msg = 'Internal Server Error [500].';
							}else if (textStatus === 'parsererror') {
								jq_msg = 'Requested JSON parse failed.';
							}else if (textStatus === 'timeout') {
								jq_msg = 'Time out error.';
							}else if (textStatus === 'abort') {
								jq_msg = 'Ajax request aborted.';
							}else {
								jq_msg = 'Uncaught Error: ' + jqXHR.status + ', ' + jqXHR.responseText;
							}
							var str_msg_swal = 'ERROR: '+ jq_msg + '. Status: '+ textStatus + '. ' + errorThrown;

							Swal.fire({
								title: 'Error',
								html: str_msg_swal,
								type: 'error',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: false,
								allowEscapeKey: false,
								allowEnterKey: false
							});
						}
					});
				}else{
					$('.rut').addClass("error");
					Swal.fire({
						title: 'Error',
						html: 'Debe ingresar un RUT válido',
						type: 'error',
						confirmButtonText: 'Aceptar',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false
					});
				}
			};

			$('.search_user').click(search_user);
			$('.rut').blur(search_user);
			$("#rut").on("paste", function(){
				//console.log('on paste!!');
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
			});

			$('#rut').on('input', function() {
				//console.log('on input!!');
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
			});

			$('#rut').keypress(function(e){
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
			});
			function clean_user(){
				console.log('clean!!');
				$('#rut').val('');
				$('#idusr').val('');
				$('#nmusr').val('');
				$("#nombre").val('');
				$("#usuario").val('');
				$(".bodega").val('');
				$(".est").val('');
				$(".rol").val('');

				$(".search_user").prop("disabled", false);
				$("#rut").prop("disabled", false);
				$("#nombre").prop("disabled", true);
				$("#usuario").prop("disabled", true);
				$("#save_user").prop("disabled", true);
				$("#bodega").prop("disabled", true);
				$("#est").prop("disabled", true);
				$("#rol").prop("disabled", true);
				
				$("label.error").hide();
				$(".error").removeClass("error");
			};

			$('.clean_user').click(clean_user);

			$(document).on("click", ".save_user", function(){
				if($("#myform").valid()){
					console.log('valid!!');
					$("#save_user").prop("disabled", true);
					var rut = String($('#rut').val());
					var rutt = rut.replace(/\./g,'')
					var idusr = $('#idusr').val();
					if (idusr == '' || typeof idusr === 'undefined') {
						idusr = ''; //usuario nuevo no tiene id
					}
					var nombre = $("#nombre").val();
					var usuario = $("#usuario").val();
					var bodega = $("#bodega").val();
					if (bodega == '' || typeof bodega === 'undefined') {
						bodega = '21'; //sin bodega asignada = 21
					}
					var est = $("#est").val();
					var rol = $("#rol").val();

					console.log('create or edit user!!');
					console.log('rutt: '+ rutt);
					console.log('idusr: '+ idusr);
					console.log('nombre: '+ nombre);
					console.log('usuario: '+ usuario);
					console.log('bodega: '+ bodega);
					console.log('est: '+ est);
					console.log('rol: '+ rol);

					var _url="vws/ajax_save_user.php";
					console.log(_url);
					$.ajax({
						url: _url,
						type: "GET",
						data: {
								rut: rutt,
								idusr: idusr,
								nombre: nombre,
								usuario: usuario,
								bodega: bodega,
								est: est,
								rol: rol
							},
						dataType: "JSON",
						success: function(data){
							if(data.status){
								reload_table();
								var str_msg_swal;
								var str_ttl_swal;
								if(idusr != ''){
									str_ttl_swal = 'Usuario actualizado';
									str_msg_swal = 'Se ha actualizado exitosamente el Usuario <b>'+rut+'</b>.</br>ID de Usuario <b>'+data.USU_NM_ID+'</b>.';
								}else{
									str_ttl_swal = 'Usuario creado';
									str_msg_swal = 'Se ha creado exitosamente el Usuario <b>'+rut+'</b>.</br>ID de Usuario <b>'+data.USU_NM_ID+'</b>.';
								}
								Swal.fire({
									title: str_ttl_swal,
									html: str_msg_swal,
									type: 'success',
									confirmButtonText: 'Aceptar',
									allowOutsideClick: false,
									allowEscapeKey: false,
									allowEnterKey: false
								});
							}else {
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
							clean_user();
						},
						error: function (jqXHR, textStatus, errorThrown){
							var jq_msg;
							if (jqXHR.status === 0) {
								jq_msg = 'Not connect: Verify Network.';
							}else if (jqXHR.status == 404) {
								jq_msg = 'Requested page not found [404]';
							}else if (jqXHR.status == 500) {
								jq_msg = 'Internal Server Error [500].';
							}else if (textStatus === 'parsererror') {
								jq_msg = 'Requested JSON parse failed.';
							}else if (textStatus === 'timeout') {
								jq_msg = 'Time out error.';
							}else if (textStatus === 'abort') {
								jq_msg = 'Ajax request aborted.';
							}else {
								jq_msg = 'Uncaught Error: ' + jqXHR.status + ', ' + jqXHR.responseText;
							}
							var str_msg_swal = 'ERROR: '+ jq_msg + '. Status: '+ textStatus + '. ' + errorThrown;
							Swal.fire({
								title: 'Error',
								html: str_msg_swal,
								type: 'error',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: false,
								allowEscapeKey: false,
								allowEnterKey: false
							});
							clean_user();
						}
					});
					return false;
				}else{
					Swal.fire({
						title: 'Error',
						html: 'Debe ingresar todos los datos para poder guardar.',
						type: 'error',
						confirmButtonText: 'Aceptar',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false
					});
					return false;
				}
			});
		</script>
	</body>
</html>