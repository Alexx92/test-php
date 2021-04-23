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
		<script type="text/javascript" language="javascript" src="js/datatables/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="js/datatables/dataTables.buttons.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/datatables/buttons.print.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/datatables/buttons.html5.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/datatables/pdfmake.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/datatables/vfs_fonts.js"></script>
		<script type="text/javascript" language="javascript" src="js/datatables/jszip.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/datatables/buttons.flash.min.js"></script>
		
		
		<link rel="stylesheet" href="styles/bootstrap.min.css">
		<link rel="stylesheet" href="styles/style.css">
		<link rel="stylesheet" href="styles/all.css">
		<link rel="stylesheet" href="styles/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="styles/buttons.dataTables.min.css">

		<script type="text/javascript" src="js/sweetalert2.min.js"></script>
		<link rel="stylesheet" href="styles/sweetalert2.min.css">
		
		<script type="text/javascript" src="js/datepicker/gijgo.js"></script>
		<script type="text/javascript" src="js/datepicker/messages/messages.es-es.js"></script>
		<link rel="stylesheet" href="styles/gijgo.css">
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
						<h5>Informes</h5></br>
						<input type="hidden" name="p" id="p" value="<?php echo $_SESSION['idrol']; ?>">
						<input type="hidden" name="b" id="b" value="<?php echo $_SESSION['idbodega']; ?>">
						<input type="hidden" name="b_txt" id="b_txt" value="<?php echo $_SESSION['nombodega']; ?>">
						<input type="hidden" name="idusr" id="idusr" value="<?php echo $_SESSION['idusr']; ?>">
						<input type="hidden" name="rutusr" id="rutusr" value="<?php echo $_SESSION['rutusr']; ?>">
						<input type="hidden" name="nmusr" id="nmusr" value="<?php echo $_SESSION['nomusr']; ?>">
						<input type="hidden" name="idepp" id="idepp" value="">
						<div class="form-group row">
							<label for="inf" class="col-sm-2 col-form-label col-form-label-sm">Seleccione el Informe</label>
							<div class="col-sm-4">
								<select id="inf" class="form-control form-control-sm inf" name="inf">
									<option value="">Seleccione el Informe</option>
									<option value="1">Listado de Equipos</option>
									<option value="2">Listado de Personal en Interior Mina</option>
									<option value="3">Listado de Consolidación de Término de Turno</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div id="l_1">
							<h5>Listado de Equipos</h5>
							<form id="myform1" action="#" method="">
								<div class="form-group row">
								<label for="fae" class="col-md-1 col-sm-1 col-form-label col-form-label-sm">Faena/Mina</label>
									<div class="col-md-3 col-sm-3">
										<select id="fae" class="form-control form-control-sm fae" name="fae">
											<option value="">Seleccione Mina</option>
										</select>
									</div>
									<label for="tipoe" class="col-md-1 col-sm-1 col-form-label col-form-label-sm">Tipo EPP</label>
									<div class="col-md-2 col-sm-2">
										<select id="tipoe" class="form-control form-control-sm tipoe" name="tipoe">
											<option value="">Seleccione el Tipo</option>
										</select>
									</div>
									<label for="est2" class="col-sm-1 col-form-label col-form-label-sm">Estado</label>
									<div class="col-sm-2">
										<select id="est2" class="form-control form-control-sm est2" name="est2">
											<option value="">Seleccione el Estado</option>
											<option value="0">Disponible</option>
											<option value="1">Asignado</option>
											<option value="2">Dado de Baja</option>
											<option value="4">En Reparaciòn</option>
										</select>
									</div>
									<div class="col-sm-2">
										<button type="button" class="btn btn-primary btn-sm add-tbl" id="btn_tbl"><i class="fas fa-clipboard-list"></i> Generar Tabla</button>
										<button type="button" class="btn btn-primary btn-sm rld-tbl" id="btn_rld"><i class="fas fa-redo-alt"></i> </button>
									</div>
								</div>
							</form>
						</div>
						<div id="l_2">
							<h5>Listado de Personal en Interior Mina</h5>
							<form id="myform2" action="#" method="">
								<div class="form-group row">
									<label for="fae2" class="col-md-1 col-sm-1 col-form-label col-form-label-sm">Faena/Mina</label>
									<div class="col-md-2 col-sm-2">
										<select id="fae2" class="form-control fae2" name="fae2">
											<option value="">Seleccione Mina</option>
										</select>
									</div>
									<div class="col-sm-3">
										<button type="button" class="btn btn-primary btn-sm add-tbl" id="btn_tbl"><i class="fas fa-clipboard-list"></i> Generar Tabla</button>
										<button type="button" class="btn btn-primary btn-sm rld-tbl" id="btn_rld"><i class="fas fa-redo-alt"></i> </button>
									</div>
								</div>
							</form>
						</div>
						<div id="l_3">
							<h5>Listado de Consolidación de Término de Turno</h5>
							<form id="myform3" action="#" method="">
								<div class="form-group row">
									<label for="fae3" class="col-md-1 col-sm-1 col-form-label col-form-label-sm">Faena/Mina</label>
									<div class="col-md-2 col-sm-2">
										<select id="fae3" class="form-control fae3" name="fae3">
											<option value="">Seleccione Mina</option>
										</select>
									</div>
									<label for="f_des" class="col-md-1 col-sm-1 col-form-label col-form-label-sm">Fecha Inicial</label>
									<div class="input-group col-md-2 col-sm-2">
										<input type="text" class="form-control form-control-sm" name="f_des" id="f_des">
										<label id="f_des-error" class="error" for="f_des"></label>
									</div>
									<label for="f_has" class="col-md-1 col-sm-1 col-form-label col-form-label-sm">Fecha Final</label>
									<div class="input-group col-md-2 col-sm-2">
										<input type="text" class="form-control form-control-sm" name="f_has" id="f_has">
										<label id="f_has-error" class="error" for="f_has"></label>
									</div>
									<div class="col-sm-2">
										<button type="button" class="btn btn-primary btn-sm add-tbl" id="btn_tbl"><i class="fas fa-clipboard-list"></i> Generar Tabla</button>
										<button type="button" class="btn btn-primary btn-sm rld-tbl" id="btn_rld"><i class="fas fa-redo-alt"></i> </button>
									</div>
								</div>
							</form>
						</div>
						<div class="table-responsive" id="t_1">
							<table id="inf_table_1" class="table table-striped">
								<thead>
									<tr>
										<th>Mina</th>
										<th>Nombre Equipo</th>
										<th>Código Equipo</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
						<div class="table-responsive" id="t_1_a">
							<table id="inf_table_1_a" class="table table-striped">
								<thead>
									<tr>
										<th>Faena/Mina</th>
										<th>ID Operación</th>
										<th>RUT</th>
										<th>Nombre</th>
										<th>ID Detalle</th>
										<th>Fecha Solicitud</th>
										<th>Fecha Retorno</th>
										<th>Nombre Equipo</th>
										<th>Código Equipo</th>
										<th>Estado</th>
										<th>Atraso</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
						<div class="table-responsive" id="t_2">
							<table id="inf_table_2" class="table table-striped">
								<thead>
									<tr>
										<th>RUT</th>
										<th>Nombre</th>
										<th>Fecha Ingreso</th>
										<th>EPP</th>
										<th>Faena/Mina</th>
										<th>Nivel</th>
										<th>Destino</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
						<div class="table-responsive" id="t_3">
							<table id="inf_table_3" class="table table-striped">
								<thead>
									<tr>
										<th>Fecha Turno</th>
										<th>Turno</th>
										<th>Faena/Mina</th>
										<th>Nombre</th>
										<th>RUT</th>
										<th>Nivel</th>
										<th>Destino</th>
										<th>Fecha de Entrada</th>
										<th>Fecha de Salida</th>										
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
								
				jQuery.validator.addMethod("greaterThan", function(value, element, params) {
					var fecha_str = value;
					var fecha = fecha_str.substring(3, 5)+'-'+fecha_str.substring(0, 2)+'-'+fecha_str.substring(6);
					var fecha_str2 = $(params).val();
					var fecha2 = fecha_str2.substring(3, 5)+'-'+fecha_str2.substring(0, 2)+'-'+fecha_str2.substring(6);			
					if (!/Invalid|NaN/.test(new Date(fecha))) {
						return new Date(fecha) >= new Date(fecha2);
					}
					return isNaN(fecha) && isNaN(fecha2) || (Number(fecha) > Number(fecha2)); 
				},'Must be greater than {0}.');
				
				$.validator.addMethod("dateFormat", function(value, element) {
					return value.match(/((0[1-9]|[12]\d|3[01])-(0[1-9]|1[0-2])-[12]\d{3})/);
				}, "Please enter a date in the format dd-mm-yyyy.");
				
                $('#rut').Rut({
					validation: false
				});
				$('#myform1').validate({
					rules :{
						fae: {
							required: true
						}
					},
					messages : {
						fae: {
							required: "*Debe seleccionar la Mina."
						}
					}
				});
				$('#myform2').validate();
				$('#myform3').validate({
					rules :{
						fae3: {
							required: true
						},
						f_des: { 
							required: true,
							dateFormat: true
						},
						f_has: { 
							required: true,
							greaterThan: "#f_des",
							dateFormat: true
						}
					},
					messages : {
						fae3: {
							required: "*Debe seleccionar la Mina."
						},
						f_des: { 
							required: "*Debe ingresar la Fecha inicial.",
							dateFormat: "Debe ingresar un formato de fecha correcto dd-mm-aaaa"
						},
						f_has: {
							required: "*Debe ingresar la Fecha final.",
							greaterThan: "*La Fecha final no puede ser mayor a la Fecha inicial.",
							dateFormat: "Debe ingresar un formato de fecha correcto dd-mm-aaaa"
						}
					}
				});
				
				var today;
				today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
				$('#f_des').datepicker({
					uiLibrary: 'bootstrap4',
					format: 'dd-mm-yyyy',
					locale: 'es-es',
					maxDate: today
				});
				
				$('#f_has').datepicker({
					uiLibrary: 'bootstrap4',
					format: 'dd-mm-yyyy',
					locale: 'es-es',
					maxDate: today
				});
				
				$("#l_1, #l_2, #l_3, #t_1, #t_1_a, #t_2, #t_3").hide();				
				$('#inf').change(function(){
					if(table){
						table.clear().draw();
						table.destroy();
						
						$("#t_1").empty();
						$("#t_1_a").empty();
						$("#t_2").empty();
						$("#t_3").empty();
						
						$("#t_1").append('<table id="inf_table_1" class="table table-striped"><thead><tr><th>Mina</th><th>Nombre Equipo</th><th>Código Equipo</th><th>Estado</th></tr></thead><tbody></tbody></table>');
						$("#t_1_a").append('<table id="inf_table_1_a" class="table table-striped"><thead><tr><th>Mina</th><th>ID Operación</th><th>RUT</th><th>Nombre</th><th>ID Detalle</th><th>Fecha Solicitud</th><th>Fecha Retorno</th><th>Nombre Equipo</th><th>Código Equipo</th><th>Estado</th><th>Atraso</th></tr></thead><tbody></tbody></table>');
						$("#t_2").append('<table id="inf_table_2" class="table table-striped"><thead><tr><th>RUT</th><th>Nombre</th><th>Fecha Ingreso</th><th>EPP</th><th>Faena/Mina</th><th>Nivel</th><th>Destino</th></tr></thead><tbody></tbody></table>');
						$("#t_3").append('<table id="inf_table_3" class="table table-striped"><thead><tr><th>Fecha Turno</th><th>Turno</th><th>Faena/Mina</th><th>Nombre</th><th>RUT</th><th>Nivel</th><th>Destino</th><th>Fecha de Entrada</th><th>Fecha de Salida</th></tr></thead><tbody></tbody></table>');	
					}
					$('#fae').val('');
					$('#tipoe').val('');
					$('#est2').val('');
					
					$('#fae2').val('');
					
					$('#fae3').val('');
					$('#f_des').val('');
					$('#f_has').val('');
					var inf = $(this).val();
					if(inf){
						if(inf == 1){
							$("#l_1").show();
							$("#l_2, #l_3").hide();							
						}else if(inf == 2){
							$("#l_1, #l_3").hide();
							$("#l_2").show();							
							$("#t_2").show();
							$("#t_1, #t_1_a, #t_3").hide();
						}else if(inf == 3){
							$("#l_1, #l_2").hide();
							$("#l_3").show();							
							$("#t_3").show();
							$("#t_1, #t_1_a, #t_2").hide();
						}
					}else{
						$("#l_1, #l_2, #l_3, #t_1, #t_1_a, #t_2, #t_3").hide();	
						var str_msg_swal = 'Debe seleccionar un Informe para poder ver las opciones.'
						Swal.fire({
							title: 'Información',
							text: str_msg_swal,
							type: 'warning',
							confirmButtonText: 'Aceptar',
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false
						});
					}
				}); 
				$('#fae').change(function(){
					var fae = $(this).val();
					var est2 = $('#est2').val();
					if(fae){
						$("#l_1").show();
						$("#l_2, #l_3").hide();
						if (est2 == 1){
							$("#t_1_a").show();
							$("#t_1, #t_2, #t_3").hide();
						}else{
							$("#t_1").show();
							$("#t_1_a, #t_2, #t_3").hide();
						}	
					}	
				});
				$('#est2').change(function(){
					var est2 = $(this).val();
					$("#l_1").show();
					$("#l_2, #l_3").hide();
					if (est2 == 1){
						$("#t_1_a").show();
						$("#t_1, #t_2, #t_3").hide();
					}else{
						$("#t_1").show();
						$("#t_1_a, #t_2, #t_3").hide();
					}
				});
				var _url="vws/ajax_search_faenas.php";
				$.ajax({
					url: _url,
					type: "GET",
					dataType: "JSON",
					success: function(data){
						if(data.status){
							faenas = data.selector_fae;
							$(".fae").html(faenas);
							$("#fae").prop("disabled", false);
							$(".fae2").html(faenas);
							$("#fae2").prop("disabled", false);
							$(".fae3").html(faenas);
							$("#fae3").prop("disabled", false);
						}else {
							$("#fae").prop("disabled", true);
							$("#fae2").prop("disabled", true);
							$("#fae3").prop("disabled", true);
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
						console.log(str_msg_swal);
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
							$(".tipoe2").html(data.selector_te);
						}else {
							$("#tipoe").prop("disabled", true);
						}
					},
					error: function (){
						$("#tipoe").prop("disabled", true);
						$("#tipoe2").prop("disabled", true);
					}
				});
            });
			
			function initiateTable(tipo, arg1, arg2, arg3){
				var tipo = tipo;
				if(tipo == 1){
					if(table){
						table.clear().draw();
						table.destroy();
					}
					var fae = arg1;
					var tipoe = arg2;
					var est2 = arg3;
					var _url = 'vws/ajax_infs.php?tipo='+tipo+'&fae='+fae+'&tipoe='+tipoe+'&est2='+est2;					
				}else if(tipo == 2){
					var fae = arg1;
					//var bod = arg2;
					var _url = 'vws/ajax_infs.php?tipo='+tipo+'&fae='+fae;
				}else if(tipo == 3){
					var fae = arg1;
					var f_des = arg2;
					var f_has = arg3;
					var _url = 'vws/ajax_infs.php?tipo='+tipo+'&fae='+fae+'&f_des='+f_des+'&f_has='+f_has;
				}
				//console.log('url: '+_url);
				if(tipo == 1){
					if(est2 == 1){
						table = $('#inf_table_1_a').DataTable({
							dom: 'Bfrtip',
							buttons: [
								{
									extend: 'excelHtml5',
									autoFilter: true,
									sheetName: 'Exported data',
									text: 'Descargar Excel'
								}
							],
							"columns": [
								{ "orderable": true },
								{ "orderable": true },
								{ "orderable": true },
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
						     /*destroy: true,*/
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
					}else{
						table = $('#inf_table_1').DataTable({
							dom: 'Bfrtip',
							buttons: [
								{
									extend: 'excelHtml5',
									autoFilter: true,
									sheetName: 'Exported data',
									text: 'Descargar Excel'
								}
							],
							"columns": [
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
							  /*destroy: true,*/
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
					}
				}else if(tipo == 2){
					if(table){
						table.clear().draw();
						table.destroy();
					}
					table = $('#inf_table_2').DataTable({
						dom: 'Bfrtip',
						buttons: [
							{
								extend: 'excelHtml5',
								autoFilter: true,
								sheetName: 'Exported data',
								text: 'Descargar Excel'
							}
						],
						"columns": [							
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
						 /*destroy: true,*/
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
				}else if(tipo == 3){
					if(table){
						table.clear().draw();
						table.destroy();
					}
					table = $('#inf_table_3').DataTable({
						dom: 'Bfrtip',
						buttons: [
							{
								extend: 'excelHtml5',
								autoFilter: true,
								sheetName: 'Exported data',
								text: 'Descargar Excel'
							}
						],
						"columns": [
							{ "orderable": true },
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
						 /*destroy: true,*/
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
				}
			};
			$('#epps_table').on('processing.dt', function ( e, settings, processing ){
				$('#btn_tbl').prop( 'disabled', processing ? true : false );
				$('#btn_rld').prop( 'disabled', processing ? true : false );
			});
			
			function reload_table(){
				table.ajax.reload(null,false); //reload datatable ajax 
			};
			
			function search_epp(){
				var codigo = $('#codigo').val();
				if($("#codigo").valid() == true && codigo){
					$(".search_user").prop("disabled", true);
					var _url="vws/ajax_search_epp2.php?cod="+codigo;
					//console.log(_url);
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
				$('#codigo').val('');
				$('#idepp').val('');
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
			
			$('#epps_table').on('processing.dt', function ( e, settings, processing ){
				$('#btn_tbl').prop( 'disabled', processing ? true : false );
				$('#btn_rld').prop( 'disabled', processing ? true : false );
			});
			
			$(document).on("click", ".rld-tbl", function(){
				//var tipoe = $('#tipoe').val();
				if(table){
					reload_table();
				}
			});
			$(document).on("click", ".add-tbl", function(){
				var inf = $('#inf').val();
				if(inf){
					if(inf == 1){
						if($("#myform1").valid()){
							var fae = $('#fae').val();
							var tipoe = $('#tipoe').val();
							if (tipoe == '' || typeof tipoe === 'undefined') {
								tipoe = '';
							}
							var est2 = $('#est2').val();
							if (est2 == '' || typeof est2 === 'undefined') {
								est2 = '';
							}
							initiateTable(1, fae, tipoe, est2);
						}else{
							Swal.fire({
								title: 'Error',
								html: 'Debe seleccionar algún dato para poder generar el Informe.',
								type: 'error',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: false,
								allowEscapeKey: false,
								allowEnterKey: false
							});
							return false;
						}
					}else if(inf == 2){
						if($("#myform2").valid()){
							var fae = $('#fae2').val();
							if (fae == '' || typeof fae === 'undefined') {
								fae = '';
							}
							initiateTable(2, fae, '', '');
						}else{
							Swal.fire({
								title: 'Error',
								html: 'Debe seleccionar algún dato para poder generar el Informe.',
								type: 'error',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: false,
								allowEscapeKey: false,
								allowEnterKey: false
							});
							return false;
						}
					}else if(inf == 3){
						if($("#myform3").valid()){
							var fae = $('#fae3').val();
							var f_des = $('#f_des').val();
							var f_has = $('#f_has').val();
							initiateTable(3, fae, f_des, f_has);
						}else{
							Swal.fire({
								title: 'Error',
								html: 'Debe ingresar la Fecha Desde y Fecha Hasta para generar el Informe.',
								type: 'error',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: false,
								allowEscapeKey: false,
								allowEnterKey: false
							});
							return false;
						}
					}	
				}else{
					$("#l_1").hide();
					$("#l_2").hide();
					$("#l_3").hide();
					$("#t_1").hide();
					$("#t_1_a").hide();
					$("#t_2").hide();
					$("#t_3").hide();
					var str_msg_swal = 'Debe seleccionar un Informe para poder ver las opciones.'
					Swal.fire({
						title: 'Información',
						text: str_msg_swal,
						type: 'warning',
						confirmButtonText: 'Aceptar',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false
					});				
				}
			});
		</script>
	</body>
</html>