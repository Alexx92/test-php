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
						<h5>EPPs</h5></br>
						<form id="myform" action="#" method="">
							<input type="hidden" name="p" id="p" value="<?php echo $_SESSION['idrol']; ?>">
							<input type="hidden" name="b" id="b" value="<?php echo $_SESSION['idbodega']; ?>">
							<input type="hidden" name="b_txt" id="b_txt" value="<?php echo $_SESSION['nombodega']; ?>">
							<input type="hidden" name="idusr" id="idusr" value="<?php echo $_SESSION['idusr']; ?>">
							<input type="hidden" name="rutusr" id="rutusr" value="<?php echo $_SESSION['rutusr']; ?>">
							<input type="hidden" name="nmusr" id="nmusr" value="<?php echo $_SESSION['nomusr']; ?>">
							<input type="hidden" name="idepp" id="idepp" value="">
							<input type="hidden" name="estepp" id="estepp" value="">
							<div class="form-group row">
								<label for="codigo" class="col-sm-1 col-form-label col-form-label-sm">Código</label>
								<div class="col-sm-2">
									<input type="text" class="form-control form-control-sm codigo" name="codigo" id="codigo">
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-primary btn-sm search_epp"><i class="fas fa-search"></i></button>
									<button type="button" class="btn btn-primary btn-sm clean_epp"><i class="fas fa-backspace"></i></button>
								</div>
								<label for="tipo" class="col-sm-1 col-form-label col-form-label-sm">Tipo</label>
								<div class="col-sm-3">
									<select id="tipo" class="form-control form-control-sm tipo" name="tipo" disabled>
										<option value="">Seleccione el tipo</option>
									</select>
								</div>
								<label for="est" class="col-sm-1 col-form-label col-form-label-sm">Estado</label>
								<div class="col-sm-2">
									<select id="est" class="form-control form-control-sm est" name="est" disabled>
										<option value="">Seleccione el Estado</option>
										<option value="0">Disponible</option>
										<option value="1">Asignado</option>
										<option value="2">Dado de Baja</option>
										<option value="3">Inactivo</option>
										<option value="4">En Reparaciòn</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="bodega" class="col-sm-1 col-form-label col-form-label-sm">Bodega</label>
								<div class="col-sm-3">
									<select id="bodega" class="form-control form-control-sm bodega" name="bodega" disabled>
										<option value="">Seleccione la Bodega</option>
									</select>
								</div>
								<label for="mactag" class="col-sm-2 col-form-label col-form-label-sm">MAC TAG</label>
								<div class="col-sm-3">
									<input type="text" class="form-control form-control-sm mactag" name="mactag" id="mactag" disabled>
								</div>
								<div class="col-sm-3 text-right">
									<button type="submit" class="btn btn-primary btn-sm save_epp" id="save_epp" disabled><i class="fas fa-file-signature"></i> Guardar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<h5>Listado de EPPs</h5>
						<form id="myform2" action="#" method="">
							<div class="form-group row">
								<label for="tipoe" class="col-md-1 col-sm-1 col-form-label col-form-label-sm">Tipo EPP</label>
								<div class="col-md-2 col-sm-2">
									<select id="tipoe" class="form-control tipoe" name="tipoe">
										<option value="">Seleccione el Tipo</option>
									</select>
								</div>
								<label for="bodega2" class="col-sm-1 col-form-label col-form-label-sm">Bodega</label>
								<div class="col-sm-2">
									<select id="bodega2" class="form-control form-control-sm bodega2" name="bodega2">
										<option value="">Seleccione la Bodega</option>
									</select>
								</div>
								<label for="est2" class="col-sm-1 col-form-label col-form-label-sm">Estado</label>
								<div class="col-sm-2">
									<select id="est2" class="form-control form-control-sm est2" name="est2">
										<option value="">Seleccione el Estado</option>
										<option value="0">Disponible</option>
										<option value="1">Asignado</option>
										<option value="2">Dado de Baja</option>
										<option value="3">Inactivo</option>
										<option value="4">En Reparaciòn</option>
									</select>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-primary btn-sm add-tbl" id="btn_tbl"><i class="fas fa-clipboard-list"></i> Generar Tabla</button>
									<button type="button" class="btn btn-primary btn-sm rld-tbl" id="btn_rld"><i class="fas fa-redo-alt"></i> </button>
								</div>
							</div>
						</form>
						<div class="table-responsive">
							<table id="epps_table" class="table table-striped">
								<thead>
									<tr>
										<th>Tipo</th>
										<th>Código</th>
										<th>MAC TAG</th>
										<th>Estado</th>
										<th>Bodega</th>
										<th>Asignado a</th>
										<th>Fecha Asignación</th>
										<th>Hora Asignación</th>
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
				$.validator.addMethod("rut", function(value, element){
					return this.optional(element) || $.Rut.validar(value);
				}, "Debe ingresar un rut válido.");
                $('#rut').Rut({
					validation: false
				});
				$('#myform').validate({
					rules :{
						codigo: {
							required: true
						},
						tipo: {
							required: true
						},
						est: {
							required: true
						},
						bodega: {
							required: true
						}
					},
					messages : {
						codigo: {
							required: "*Debe ingresar el Código."
						},
						tipo: {
							required: "*Debe seleccionar el Tipo."
						},
						est: {
							required: "*Debe seleccionar un Estado."
						},
						bodega: {
							required: "*Debe seleccionar la Ubicación."
						}
					}
				});
				
				$('#myform2').validate({
					rules :{
						tipoe: {
							required: true
						}
					},
					messages : {
						tipoe: {
							required: "*Debe seleccionar el Tipo de EPP"
						}
					}
				});
				var _url="vws/ajax_tipoe.php";
				$.ajax({
					url: _url,
					type: "GET",
					dataType: "JSON",
					success: function(data){
						if(data.status){
							$(".tipoe").html(data.selector_te);
							$(".tipo").html(data.selector_te);
						}else {
							$("#tipoe").prop("disabled", true);
							$("#tipo").prop("disabled", true);
						}
					},
					error: function (){
						$("#tipoe").prop("disabled", true);
						$("#tipo").prop("disabled", true);
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
							//$("#bodega").prop("disabled", false);
							$(".bodega").html(data.selector_bod);
							$(".bodega2").html(data.selector_bod);
							$("#bodega option[value=21]").val("");
							$("#bodega2 option[value=21]").val("");
						}else {
							//alert("fail!!");
							$("#bodega").prop("disabled", true);
							$("#bodega2").prop("disabled", true);
						}
					},
					error: function (){
						$("#bodega").prop("disabled", true);
						$("#bodega2").prop("disabled", true);
					}
				});
            });
			
			function initiateTable(tipo, bod, est){
				var _url = 'vws/ajax_search_epps.php?tipoe='+tipo+'&bod='+bod+'&est='+est;
				console.log('url: '+_url);		
				if(table){
					table.destroy();
				}
				table = $('#epps_table').DataTable({
					"columns": [
						{ "orderable": true },
						{ "orderable": true },
						{ "orderable": true },
						{ "orderable": true },
						{ "orderable": true },
						{ "orderable": true },
						{ "orderable": true },
						{ "orderable": true }
					 ],
					"order": [[ 1, "asc" ]],
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
			
			function reload_table(){
				table.ajax.reload(null,false); //reload datatable ajax 
			};
			
			function search_epp(){
				console.log('search_epp funcion!!');
				var codigo = $('#codigo').val();
				if($("#codigo").valid() == true && codigo){
					$(".search_user").prop("disabled", true);
					var _url="vws/ajax_search_epp2.php?cod="+codigo;
					console.log(_url);
					$.ajax({
						url: _url,
						type: "GET",
						dataType: "JSON",
						success: function(data){
							$(".search_epp").prop("disabled", false);
							$("#codigo").prop("disabled", true);
							$("#tipo").prop("disabled", false);
							$("#est").prop("disabled", false);
							$("#bodega").prop("disabled", false);
							$("#mactag").prop("disabled", false);
							$("#save_epp").prop("disabled", false);
							if(data.status){
								$('#codigo').val(data.STO_TX_BARRA);
								$('#idepp').val(data.STO_NM_ID);
								$('#tipo').val(data.PRO_NM_ID);
								$("#estepp").val(data.STO_NM_STATUS);
								$(".est").val(data.STO_NM_STATUS);
								$(".bodega").val(data.BOG_NM_ID);
								$("#mactag").val(data.STO_TX_TAG);
							}else {
								$("#codigo").prop("disabled", false);
								Swal.fire({
									title: 'Información',
									text: 'El EPP ingresado no se encuentra o ha sido ingresado de forma incorrecta.',
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
					$('.codigo').addClass("error");
					Swal.fire({
						title: 'Error',
						html: 'Debe ingresar un Código',
						type: 'error',
						confirmButtonText: 'Aceptar',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false
					});
				}			
			};

			$('.search_epp').click(search_epp);
			$('.codigo').blur(search_epp);

			function clean_epp(){
				console.log('clean!!');
				$('#codigo').val('');
				$('#idepp').val('');
				$('#estepp').val('');
				$('#mactag').val('');
				$(".bodega").val('21');
				$(".tipo").val('');
				$(".est").val('');

				$(".search_epp").prop("disabled", false);
				$("#codigo").prop("disabled", false);
				$("#mactag").prop("disabled", true);
				$("#tipo").prop("disabled", true);
				$("#save_epp").prop("disabled", true);
				$("#bodega").prop("disabled", true);
				$("#est").prop("disabled", true);
				
				$("label.error").hide();
				$(".error").removeClass("error");
			};

			$('.clean_epp').click(clean_epp);

			$(document).on("click", ".save_epp", function(){
				if($("#myform").valid()){
					console.log('valid!!');
					$("#save_epp").prop("disabled", true);
					var idusr = $('#idusr').val();
					var rutusr = $('#rutusr').val();
					var nmusr = $('#nmusr').val();
					var idepp = $('#idepp').val();
					var estepp = $('#estepp').val();
					var codigo = $('#codigo').val();
					var tipo = $("#tipo").val();
					var est = $("#est").val();
					var bodega = $("#bodega").val();
					if (bodega == '' || typeof bodega === 'undefined') {
						bodega = '21'; //sin bodega asignada = 21
					}
					var mactag = $("#mactag").val();

					console.log('edit epp!!');
					console.log('idusr: '+ idusr);
					console.log('rutusr: '+ rutusr);
					console.log('nmusr: '+ nmusr);
					console.log('idepp: '+ idepp);
					console.log('estepp: '+ estepp);
					console.log('codigo: '+ codigo);
					console.log('tipo: '+ tipo);
					console.log('est: '+ est);
					console.log('bodega: '+ bodega);
					console.log('mactag: '+ mactag);

					var _url="vws/ajax_save_epp.php";
					console.log(_url);					
					$.ajax({
						url: _url,
						type: "GET",
						data: {
								idusr: idusr,
								rutusr: rutusr,
								nmusr: nmusr,
								idepp: idepp,
								estepp: estepp,
								codigo: codigo,
								tipo: tipo,
								est: est,
								bodega: bodega,
								mactag: mactag
							},
						dataType: "JSON",
						success: function(data){
							if(data.status){
								if(table){
									reload_table();
								}
								var str_ttl_swal = 'EPP actualizado';
								if(data.error_msg == '' || typeof data.error_msg === 'undefined')
									var str_msg_swal = 'Se ha actualizado exitosamente el EPP <b>'+codigo+'</b>.</br>ID de EPP <b>'+data.STO_NM_ID+'</b>.';
								else
									var str_msg_swal = 'Se ha actualizado exitosamente el EPP <b>'+codigo+'</b>.</br>ID de EPP <b>'+data.STO_NM_ID+'</b>.</br>. ERROR ICA: '+data.error_msg;
								Swal.fire({
									title: str_ttl_swal,
									html: str_msg_swal,
									type: 'success',
									confirmButtonText: 'Aceptar',
									allowOutsideClick: false,
									allowEscapeKey: false,
									allowEnterKey: false
								});
								if(table){
									reload_table();
								}								
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
							clean_epp();
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

			$('#epps_table').on('processing.dt', function ( e, settings, processing ){
				$('#btn_tbl').prop( 'disabled', processing ? true : false );
				$('#btn_rld').prop( 'disabled', processing ? true : false );
			});
			
			$(document).on("click", ".rld-tbl", function(){
				var tipoe = $('#tipoe').val();
				if(table){
					reload_table();
				}
			});
			$(document).on("click", ".add-tbl", function(){
				console.log($("#myform2").valid());
				if($("#myform2").valid()){
					console.log('valid!!');
					var tipoe = $('#tipoe').val();
					var bodega = $('#bodega2').val();
					if (bodega == '' || typeof bodega === 'undefined') {
						bodega = '';
					}
					var est = $('#est2').val();
					if (est == '' || typeof est === 'undefined') {
						est = '';
					}
					console.log('tipoe: '+ tipoe);
					console.log('bodega: '+ bodega);
					console.log('est: '+ est);
					initiateTable(tipoe, bodega, est);
					return false;
				}else{
					Swal.fire({
						title: 'Error',
						html: 'Debe seleccionar algún dato para poder generar la Tabla.',
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