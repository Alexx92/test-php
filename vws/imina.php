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

		<link rel="stylesheet" href="styles/bootstrap.min.css">
		<link rel="stylesheet" href="styles/style.css">
		<link rel="stylesheet" href="styles/all.css">

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
						<h5>Ingreso Central Mina</h5></br>
						<form id="myform" action="#" method="">
							<input type="hidden" name="p" id="p" value="<?php echo $_SESSION['idrol']; ?>">
							<input type="hidden" name="b" id="b" value="<?php echo $_SESSION['idbodega']; ?>">
							<input type="hidden" name="b_txt" id="b_txt" value="<?php echo $_SESSION['nombodega']; ?>">
							<input type="hidden" name="idusr_login" id="idusr_login" value="<?php echo $_SESSION['idusr']; ?>">
							<input type="hidden" name="idusr" id="idusr" value="">
							<input type="hidden" name="nmusr" id="nmusr" value="">
							<input type="hidden" name="idfusr" id="idfusr" value="<?php echo $_SESSION['idfaena']; ?>">
							<input type="hidden" name="neppusr" id="neppusr" value="">
							<input type="hidden" name="lampc" id="lampc" value="0">
							<input type="hidden" name="epps" id="epps" value="0">
							<div class="form-group row">
								<label for="rut" class="col-sm-1 col-form-label col-form-label-sm">RUT</label>
								<div class="col-sm-3">
									<input type="text" class="form-control form-control-sm rut" name="rut" id="rut">
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-primary btn-sm search_user"><i class="fas fa-search"></i></button>
									<button type="button" class="btn btn-primary btn-sm clean_user"><i class="fas fa-backspace"></i></button>
								</div>
								<label for="fecha_hora" class="col-sm-1 col-form-label col-form-label-sm">Fecha/Hora</label>
								<div class="col-sm-5">
									<input type="text" class="form-control form-control-sm" name="fecha_hora" id="fecha_hora" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label for="nombre" class="col-sm-1 col-form-label col-form-label-sm">Nombre</label>
								<div class="col-sm-4">
									<input type="text" class="form-control form-control-sm" name="nombre" id="nombre" disabled>
								</div>
								<label for="faena" class="col-sm-1 col-form-label col-form-label-sm">Faena</label>
								<div class="col-sm-3">
									<select id="faena" class="form-control form-control-sm faena" name="faena" disabled>
										<option value="">Seleccione la Faena</option>
									</select>
								</div>
								<label for="nivel" class="col-sm-1 col-form-label col-form-label-sm">Nivel</label>
								<div class="col-sm-2">
									<select id="nivel" class="form-control form-control-sm nivel" name="nivel" disabled>
										<option value="">Seleccione el Nivel</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="destino" class="col-sm-1 col-form-label col-form-label-sm">Destino</label>
								<div class="col-sm-4">
									<select id="destino" class="form-control form-control-sm destino" name="destino" disabled>
										<option value="">Seleccione el Destino</option>
									</select>
								</div>
								<?php
								 if($_SESSION['idrol'] == 0 || $_SESSION['idrol'] == 1 || $_SESSION['idrol'] == 2|| $_SESSION['idrol'] == 3){
								 ?>
									<div class="col-sm-3">
										<button type="button" class="btn btn-primary btn-sm add-aut" id="btn_aut" disabled><i class="fas fa-id-card"></i> Autorizar y  Asignar EPPs</button>
									</div>

									<div class="col-sm-2">
										<button type="button" class="btn btn-primary btn-sm add-aut2" id="btn_aut2" disabled><i class="fas fa-user-check"></i> Autorizar</button>
									</div>
									<div class="col-sm-2 ">
										<button type="submit" class="btn btn-primary btn-sm add-epp cancel" id="btn_aepp" disabled><i class="fas fa-list"></i> Asignar EPPs</button>
									</div>
								 <?php
								 }
								 ?>
							</div>
							<div class="dropdown-divider"></div>
							<div class="row">
								<div class="col-sm-9"><h5>Listado de EPP para asignar</h5></div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-primary btn-sm add-new" id="btn_epp" disabled><i class="fas fa-plus"></i> Agregar EPP a Listado</button>
								</div>
							</div>
							<div class="row">
								<table class="table table-bordered table-hover" id="table_epp1">
									<thead>
										<tr>
											<th>#</th>
											<th>Código Barra</th>
											<th>Descripción</th>
											<th>MAC-TAG</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="dropdown-divider"></div>
							<div class="row">
								<div class="col-sm-10"><h5>Dispone de los siguientes EPPs</h5></div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered table-hover" id="table_epp2">
											<thead>
												<tr>
													<th>#</th>
													<th>Código Barra</th>
													<th>Descripción</th>
													<th>MAC-TAG</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
				</div>
			</div>
		</div>
		<script>
			var stat_edit = 0;
			$(document).ready(function(){
				function validateStrings(string) {
					var pattern = /^[0-9a-zA-Z@_-]+$/;
					return $.trim(string).match(pattern) ? true : false;
				}
				$.validator.addMethod("rut", function(value, element){
					return this.optional(element) || $.Rut.validar(value);
				}, "*Debe ingresar un rut válido.");
                $('#rut').Rut({
					validation: false
				});
				$('#myform').validate({
					rules :{
						rut: {
							required: true,
							normalizer: function(value) {
								return $.trim(value);
							}
						},
						faena: {
							required: true
						},
						nivel: {
							required: true
						}
					},
					messages : {
						rut: {
							required: "*Debe ingresar un RUT."
						},
						faena: {
							required: "*Debe seleccionar la Faena."
						},
						nivel: {
							required: "*Debe seleccionar el Nivel."
						}
					}
				});
				/***********************************************************/

				$('[data-toggle="tooltip"]').tooltip();
				var actions = $("#table_epp1 td:last-child").html();
				var i;
				$(".add-new").click(function(){
					var bodega = $('#b').val();
					var rowCount = $('#table_epp1 tbody tr').length;
					if(rowCount == 0){
						$(this).attr("disabled", "disabled");
						var index = $("#table_epp1 tbody tr:last-child").index();
						i = index + 2;
						var row = '<tr>' +
							'<input type="hidden" name="idepp" id="idepp" value="">' +
							'<input type="hidden" name="cdepp" id="cdepp" value="">' +
							'<td id="i_td"><b>'+ i +'</b></td>' +
							'<td id="cbarra_td"><input type="text" class="form-control" name="cbarra" id="cbarra"></td>' +
							'<td id="desc_td"><input type="text" class="form-control" name="desc" id="desc" disabled></td>' +
							'<td id="cod_td"><input type="text" class="form-control" name="cod" id="cod" disabled></td>' +
							'<td>' +
								'<a class="add" data-toggle="tooltip" data-placement="top" title="Agregar datos"><i class="fas fa-plus-square"></i></a>' +
								'<a class="edit" data-toggle="tooltip" data-placement="top" title="Editar datos"><i class="fas fa-edit"></i></a>' +
								'<a class="delete" data-toggle="tooltip" data-placement="top" title="Borrar fila"><i class="fas fa-trash-alt"></i></a>' +
							'</td>'
						'</tr>';
						$("#table_epp1").append(row);
						$("#table_epp1 tbody tr").eq(index + 1).find(".add, .edit").toggle();
						$('[data-toggle="tooltip"]').tooltip();
						$('input[name=cbarra]').focus();
					}else{
						var val_last_child = $('#table_epp1 tbody tr:last-child td:nth-child(2) input').attr('id');
						var val_last_child2 = '#table_epp1 tbody tr:last-child';
						if(val_last_child == 'cbarra'){ //ultimo hijo en modo input
							var empty = false;
							var input = $(val_last_child2).find('#cbarra');
							var input2 = $(val_last_child2).find('#desc');
							var input3 = $(val_last_child2).find('#cod');
							var input4 = $(val_last_child2).find('#idepp');
							var input5 = $(val_last_child2).find('#cdepp');
							console.log('stat_edit 2: '+stat_edit);
							console.log('cbarra validation: '+validateStrings(input.val()));
							if(stat_edit == 0){
								input.each(function(){
								if(!$(this).val()){
										console.log('here 2');
										$(this).addClass("error");
										empty = true;
									} else{
										$(this).removeClass("error");
									}
								});
							}
							$(this).parents("tr").find(".error").first().focus();
							if(!empty){
								input5.each(function(){
									$(this).parent("input").val($(this).val());
								});
								input4.each(function(){
									$(this).parent("input").val($(this).val());
								});
								input.each(function(){
									$(this).parent("td").html($(this).val());
								});
								input2.each(function(){
									$(this).parent("td").html($(this).val());
								});
								input3.each(function(){
									$(this).parent("td").html($(this).val());
								});
								$(val_last_child2).find(".add, .edit").toggle();
								var index = $("#table_epp1 tbody tr:last-child").index();
								i = index + 2;
								var row = '<tr>' +
									'<input type="hidden" name="idepp" id="idepp" value="">' +
									'<input type="hidden" name="cdepp" id="cdepp" value="">' +
									'<td id="i_td"><b>'+ i +'</b></td>' +
									'<td id="cbarra_td"><input type="text" class="form-control" name="cbarra" id="cbarra"></td>' +
									'<td id="desc_td"><input type="text" class="form-control" name="desc" id="desc" disabled></td>' +
									'<td id="cod_td"><input type="text" class="form-control" name="cod" id="cod" disabled></td>' +
									'<td>' +
										'<a class="add" data-toggle="tooltip" data-placement="top" title="Agregar datos"><i class="fas fa-plus-square"></i></a>' +
										'<a class="edit" data-toggle="tooltip" data-placement="top" title="Editar datos"><i class="fas fa-edit"></i></a>' +
										'<a class="delete" data-toggle="tooltip" data-placement="top" title="Borrar fila"><i class="fas fa-trash-alt"></i></a>' +
									'</td>'
								'</tr>';
								$("#table_epp1").append(row);
								$("#table_epp1 tbody tr").eq(index + 1).find(".add, .edit").toggle();
								$('[data-toggle="tooltip"]').tooltip();
								$('input[name=cbarra]').focus();
							}
						}else{
							$(this).attr("disabled", "disabled");
							var index = $("#table_epp1 tbody tr:last-child").index();
							i = index + 2;
							var row = '<tr>' +
								'<input type="hidden" name="idepp" id="idepp" value="">' +
								'<input type="hidden" name="cdpp" id="cdepp" value="">' +
								'<td id="i_td"><b>'+ i +'</b></td>' +
								'<td id="cbarra_td"><input type="text" class="form-control" name="cbarra" id="cbarra"></td>' +
								'<td id="desc_td"><input type="text" class="form-control" name="desc" id="desc" disabled></td>' +
								'<td id="cod_td"><input type="text" class="form-control" name="cod" id="cod" disabled></td>' +
								'<td>' +
									'<a class="add" data-toggle="tooltip" data-placement="top" title="Agregar datos"><i class="fas fa-plus-square"></i></a>' +
									'<a class="edit" data-toggle="tooltip" data-placement="top" title="Editar datos"><i class="fas fa-edit"></i></a>' +
									'<a class="delete" data-toggle="tooltip" data-placement="top" title="Borrar fila"><i class="fas fa-trash-alt"></i></a>' +
								'</td>'
							'</tr>';
							$("#table_epp1").append(row);
							$("#table_epp1 tbody tr").eq(index + 1).find(".add, .edit").toggle();
							$('[data-toggle="tooltip"]').tooltip();
							$('input[name=cbarra]').focus();
						}
					}
				});

				function new_row(){
					var bodega = $('#b').val();
					var bodega_text = $('#b_txt').val();
					var empty = false;
					var input = $(this).parents("tr").find('#cbarra');
					var input2 = $(this).parents("tr").find('#desc');
					var input3 = $(this).parents("tr").find('#cod');
					var input4 = $(this).parents("tr").find('input[type="hidden"][id="idepp"]');
					var input5 = $(this).parents("tr").find('input[type="hidden"][id="cdepp"]');
					var tr = $(this).parents("tr");
					if (stat_edit <= 0){
						input.each(function(){
							if(!$(this).val()){
								console.log('here');
								$(this).addClass("error");
								empty = true;
							} else{
								$(this).removeClass("error");
							}
						});
						$(this).parents("tr").find(".error").first().focus();
					}
					if(!empty){
						cb = $(input).val().toUpperCase();
						var check_string = validateStrings(cb);
						//console.log('cb: '+cb);
						cd_ant = $(input5).val();
						//console.log('cd_ant: '+cd_ant);
						var val_epp = [];
						var k = 0;
						$("#table_epp1 tbody").find("tr").each(function(){
							var cbarra_td = $(this).find('td[id="cbarra_td"]');
							if(cbarra_td.find('input[type="text"]').attr('id') == 'cbarra'){ //modo input
								val_epp[k] = cbarra_td.find('input').val();
								k++;
							}else{
								val_epp[k] = cbarra_td.text();
								k++;
							}
						});
						var sorted_arr = val_epp.slice().sort();
						var results = [];
						for (var i = 0; i < sorted_arr.length - 1; i++) {
							if (sorted_arr[i + 1] == sorted_arr[i]) {
								results.push(sorted_arr[i]);
							}
						}
						if(results.length > 0){
							Swal.fire({
								title: '',
								text: 'EPP duplicado, elimine o ingrese otro EPP',
								type: 'warning',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: true,
								allowEscapeKey: true,
								allowEnterKey: true
							});
							input.addClass("error");
						}else if(check_string == false){
							Swal.fire({
								title: '',
								text: 'Ingrese un EPP válido.',
								type: 'warning',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: true,
								allowEscapeKey: true,
								allowEnterKey: true
							});
							input.addClass("error");
						}else{
							var _url="vws/ajax_search_epp.php?epp="+cb+'&bod='+bodega;
							//console.log(_url);
							$.ajax({
								url: _url,
								type: "GET",
								dataType: "JSON",
								success: function(data){
									if(data.status){
										if(data.stt == 0){ // 0 epp no asignado
											stat_edit--;
											$("#btn_aepp").prop("disabled", false);
											input.each(function(){
												$(this).parent("td").html(cb);
											});
											ds = data.ds;
											cd = data.cd;
											mt = data.mt;
											id = data.id;
											input2.each(function(){
												$(this).parent("td").html(ds);
											});
											input3.each(function(){
												$(this).parent("td").html(mt);
											});
											input4.each(function(){
												$(this).val(id);
											});
											input5.each(function(){
												$(this).val(cd);
											});
											tr.each(function(){
												$(this).find(".add, .edit").toggle();
												if($(this).is('#table_epp1 tr:last')){
													var index = $("#table_epp1 tbody tr:last-child").index();
													i = index + 2;
													var row = '<tr>' +
														'<input type="hidden" name="idepp" id="idepp" value="">' +
														'<input type="hidden" name="cdepp" id="cdepp" value="">' +
														'<td id="i_td"><b>'+ i +'</b></td>' +
														'<td id="cbarra_td"><input type="text" class="form-control" name="cbarra" id="cbarra"></td>' +
														'<td id="desc_td"><input type="text" class="form-control" name="desc" id="desc" disabled></td>' +
														'<td id="cod_td"><input type="text" class="form-control" name="cod" id="cod" disabled></td>' +
														'<td>' +
															'<a class="add" data-toggle="tooltip" data-placement="top" title="Agregar datos"><i class="fas fa-plus-square"></i></a>' +
															'<a class="edit" data-toggle="tooltip" data-placement="top" title="Editar datos"><i class="fas fa-edit"></i></a>' +
															'<a class="delete" data-toggle="tooltip" data-placement="top" title="Borrar fila"><i class="fas fa-trash-alt"></i></a>' +
														'</td>'
													'</tr>';
													$("#table_epp1").append(row);
													$("#table_epp1 tbody tr").eq(index + 1).find(".add, .edit").toggle();
													$('[data-toggle="tooltip"]').tooltip();
												}
											});
											var element = $("#table_epp1 tbody tr:last-child").index() + 1;
											//console.log('cd 1: '+cd);
											if(cd_ant != ''){
												var cant_epp = parseInt($('#epps').val()) - 1;
												$('#epps').val(cant_epp);
												if(cd_ant == 'LAMPCC' || cd_ant == 'LAMPPR'){
													var cant_lamp = parseInt($('#lampc').val()) - 1;
													$('#lampc').val(cant_lamp);
												}
											}
											if(cd == 'LAMPCC' || cd == 'LAMPPR'){
												var cant_lamp = parseInt($('#lampc').val()) + 1;
												$('#lampc').val(cant_lamp);
												if(cant_lamp > 0){
													$("#btn_aut").prop("disabled", false);
												}else{
													$("#btn_aut").prop("disabled", true);
												}
												var cant_epp = parseInt($('#epps').val()) + 1;
												$('#epps').val(cant_epp);
												if(cant_epp > 0){
													$("#btn_aepp").prop("disabled", false);
												}else{
													$("#btn_aepp").prop("disabled", true);
												}
											}else{
												var cant_epp = parseInt($('#epps').val()) + 1;
												$('#epps').val(cant_epp);
												if(cant_epp > 0){
													$("#btn_aepp").prop("disabled", false);
												}else{
													$("#btn_aepp").prop("disabled", true);
												}
											}
										}else if(data.stt == 1){
											if(data.ope != '')
												var str_msg_swal = 'El EPP <b>'+ cb +'</b> ya se encuentra asignado en la bodega <b>'+ bodega_text +'</b> a <b>'+ data.ope +'</b>, asigne otro EPP o elimínelo.';
											else
												var str_msg_swal = 'El EPP <b>'+ cb +'</b> ya se encuentra asignado en la bodega <b>'+ bodega_text +'</b>, asigne otro EPP o elimínelo.';
											Swal.fire({
												title: 'Error',
												html: str_msg_swal,
												type: 'error',
												confirmButtonText: 'Aceptar',
												allowOutsideClick: true,
												allowEscapeKey: true,
												allowEnterKey: true
											});
											input.each(function(){
												$(this).addClass("error");
											});
										}else if(data.stt == 2){
											Swal.fire({
												title: 'Error',
												html: 'El EPP <b>'+ cb +'</b> está dado de baja, asigne otro EPP o elimínelo.',
												type: 'error',
												confirmButtonText: 'Aceptar',
												allowOutsideClick: true,
												allowEscapeKey: true,
												allowEnterKey: true
											});
											input.each(function(){
												$(this).addClass("error");
											});
										}else if(data.stt == 3){
											Swal.fire({
												title: 'Error',
												html: 'El EPP <b>'+ cb +'</b> está inactivo, asigne otro EPP o elimínelo.',
												type: 'error',
												confirmButtonText: 'Aceptar',
												allowOutsideClick: true,
												allowEscapeKey: true,
												allowEnterKey: true
											});
											input.each(function(){
												$(this).addClass("error");
											});
										}else if(data.stt == 4){
											Swal.fire({
												title: 'Error',
												html: 'El EPP <b>'+ cb +'</b> está en reparación, asigne otro EPP o elimínelo.',
												type: 'error',
												confirmButtonText: 'Aceptar',
												allowOutsideClick: true,
												allowEscapeKey: true,
												allowEnterKey: true
											});
											input.each(function(){
												$(this).addClass("error");
											});
										}
									}else {
										if (typeof data.stt !== 'undefined') {
											if(data.stt == 0){
												Swal.fire({
													title: 'Error',
													html: 'El EPP <b>'+ cb +'</b> se encuentra disponible en la bodega </br><b>'+ data.bod +'</b>.',
													type: 'error',
													confirmButtonText: 'Aceptar',
													allowOutsideClick: true,
													allowEscapeKey: true,
													allowEnterKey: true
												});
												input.each(function(){
													$(this).addClass("error");
												});
											}else if(data.stt == 1){
												if(data.ope != '')
													var str_msg_swal = 'El EPP <b>'+ cb +'</b> se encuentra asignado en la bodega </br><b>'+ data.bod +'</b> a <b>'+ data.ope +'</b>.';
												else
													var str_msg_swal = 'El EPP <b>'+ cb +'</b> se encuentra asignado en la bodega </br><b>'+ data.bod +'</b>.';
												Swal.fire({
													title: 'Error',
													html: str_msg_swal,
													type: 'error',
													confirmButtonText: 'Aceptar',
													allowOutsideClick: true,
													allowEscapeKey: true,
													allowEnterKey: true
												});
												input.each(function(){
													$(this).addClass("error");
												});
											}else if(data.stt == 2){
												Swal.fire({
													title: 'Error',
													html: 'El EPP <b>'+ cb +'</b> está dado de baja, asigne otro EPP o elimínelo.',
													type: 'error',
													confirmButtonText: 'Aceptar',
													allowOutsideClick: true,
													allowEscapeKey: true,
													allowEnterKey: true
												});
												input.each(function(){
													$(this).addClass("error");
												});
											}else if(data.stt == 3){
												Swal.fire({
													title: 'Error',
													html: 'El EPP <b>'+ cb +'</b> está inactivo, asigne otro EPP o elimínelo.',
													type: 'error',
													confirmButtonText: 'Aceptar',
													allowOutsideClick: true,
													allowEscapeKey: true,
													allowEnterKey: true
												});
												input.each(function(){
													$(this).addClass("error");
												});
											}else if(data.stt == 4){
												Swal.fire({
													title: 'Error',
													html: 'El EPP <b>'+ cb +'</b> está en reparación, asigne otro EPP o elimínelo.',
													type: 'error',
													confirmButtonText: 'Aceptar',
													allowOutsideClick: true,
													allowEscapeKey: true,
													allowEnterKey: true
												});
												input.each(function(){
													$(this).addClass("error");
												});
											}
										}else{
											Swal.fire({
												title: 'Error',
												html: 'El EPP no se encuentra.',
												type: 'error',
												confirmButtonText: 'Aceptar',
												allowOutsideClick: true,
												allowEscapeKey: true,
												allowEnterKey: true
											});
											input.each(function(){
												$(this).addClass("error");
											});
										}
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
										allowOutsideClick: true,
										allowEscapeKey: true,
										allowEnterKey: true
									});
								}
							});
						}
					}
				};
				$(document).on("click", ".add", new_row);
				$(document).on("blur", "#cbarra", new_row);

				$(document).on("click", ".edit", function(){
					stat_edit++;
					$(this).parents("tr").find('#cbarra_td').each(function(){
						$(this).html('<input type="text" class="form-control" name="cbarra" id="cbarra"  value="' + $(this).text() + '">');
					});

					$(this).parents("tr").find('#desc_td').each(function(){
						$(this).html('<input type="text" class="form-control" name="desc" id="desc" disabled value="' + $(this).text() + '">');
					});

					$(this).parents("tr").find('#cod_td').each(function(){
						$(this).html('<input type="text" class="form-control" name="cod" id="cod" disabled value="' + $(this).text() + '">');
					});
					$(this).parents("tr").find(".add, .edit").toggle();
					$(".add-new").attr("disabled", "disabled");
					var element = $("#table_epp1 tbody tr:last-child").index() + 1;
					if(element == 1){
						$("option").prop("disabled", false);
					}
				});
				$(document).on("click", ".delete", function(){
					var p = String($('#p').val());
					$(this).parents("tr").remove();
					var val_del = $(this).parents("tr").find('#cdepp').val();
					//console.log('en delete cdepp: '+val_del);
					if(val_del != ''){
						var cant_epp = parseInt($('#epps').val()) - 1;
						$('#epps').val(cant_epp);
						if(cant_epp > 0){
							$("#btn_aepp").prop("disabled", false);
						}else{
							$("#btn_aepp").prop("disabled", true);
						}
						if(val_del == 'LAMPCC' || val_del == 'LAMPPR'){
							var cant_lamp = parseInt($('#lampc').val()) - 1;
							$('#lampc').val(cant_lamp);
							if(cant_lamp > 0){
								$("#btn_aut").prop("disabled", false);
							}else{
								$("#btn_aut").prop("disabled", true);
							}
						}
					}
					$(".add-new").removeAttr("disabled");
					$('[data-toggle="tooltip"], .tooltip').tooltip("hide");
					var indice = 1;
					$('#table_epp1 tbody tr td[id="i_td"] b').each(function(){
						$(this).text(indice++);
					});
					if(indice == 1){
						$("#btn_aepp").prop("disabled", true);
					}
				});
				/***********************************************************/
				$('#faena').change(function(){
					var fae = $(this).val();
					$(".nivel").html('<option value="">Seleccione el Nivel</option>');
					$("#nivel").prop("disabled", true);
					$(".destino").html('<option value="">Seleccione el Destino</option>');
					$("#destino").prop("disabled", true);
					if(fae){
						var _url="vws/ajax_niveles.php?fae="+fae;
						var niveles;
						$.ajax({
							url: _url,
							type: "GET",
							dataType: "JSON",
							success: function(data){
								if(data.status){
									niveles = data.selector_niv;
									$(".nivel").html(niveles);
									$("#nivel").prop("disabled", false);
								}else {
									$("#nivel").prop("disabled", true);
									$("#destino").prop("disabled", true);
								}
							},
							error: function (){
								$("#nivel").prop("disabled", true);
								$("#destino").prop("disabled", true);
							}
						});
					}else{
						$("#nivel").prop("disabled", true);
						$("#destino").prop("disabled", true);
					}
				});

				$('#nivel').change(function(){
					var niv = $(this).val();
					var fae = $('#faena').val();
					if(fae && niv){
						var _url="vws/ajax_destinos.php?fae="+fae+"&niv="+niv;
						var destinos;
						$.ajax({
							url: _url,
							type: "GET",
							dataType: "JSON",
							success: function(data){
								if(data.status){
									destinos = data.selector_des;
									$(".destino").html(destinos);
									$("#destino").prop("disabled", false);
								}else {
									$("#destino").prop("disabled", true);
								}
							},
							error: function (){
								$("#destino").prop("disabled", true);
							}
						});
					}else{
						$(".destino").html('<option value="">Seleccione el Destino</option>');
						$("#destino").prop("disabled", true);
					}
				});

				$(document).on("click", ".add-aut", function(){
					var cant_lamp = parseInt($('#lampc').val());
					if($("#myform").valid() && cant_lamp > 0){
						var editable_registers = $("#table_epp1 tbody").find(".add:visible").length;
						var rowCount = $('#table_epp1 tbody tr').length;
						//console.log('cant_lamp: '+ cant_lamp);

						var idusr = $('#idusr').val();
						var nmusr = $('#nmusr').val();
						var rut = String($('#rut').val());
						var rutt = rut.replace(/\./g,'');
						var bodega = $('#b').val();
						var bodega_text = $('#b_txt').val();
						var op_url;
						var id_epps = '';
						var epps = '';
						var mac_tags = '';

						var fae = $('#faena').val();
						var fae_text = $('#faena option:selected').text();
						var niv = $('#nivel').val();
						var des = $('#destino').val();
						if (des == '' || typeof des === 'undefined') {
							des = '';
						}
						var des_text = $('#destino option:selected').text();
						var b = $('#b').val();
						var idusr_login = $('#idusr_login').val();

						if((rowCount == 1 && editable_registers == 1) || (rowCount == 2 && editable_registers == 2)){ //lamparas solo vienen de los epp cargados anteriormente
							op_url = 1;
						}else{
							op_url = 2;
							$('#table_epp1 tbody').find('td[id=cbarra_td]').each(function(){
								epp = $(this).text();
								epps = epps + epp + '|';
							});
							$('#table_epp1 tbody').find('td[id=cod_td]').each(function(){
								mac_tag = $(this).text();
								if(mac_tag == ''){
									mac_tag = '0';
								}
								mac_tags = mac_tags + mac_tag + '|';
							});
							$('#table_epp1 tbody').find('input[id=idepp]').each(function(){
								id_epp = $(this).val();
								id_epps = id_epps + id_epp + '|';
							});
						}
						/*
						console.log('fae: '+fae);
						console.log('niv: '+niv);
						console.log('des: '+des);
						console.log('b: '+b);
						console.log('rut: '+rutt);
						console.log('idusr_login: '+idusr_login);
						console.log('id_epps: '+id_epps);
						console.log('epps: '+epps);
						console.log('mac_tags: '+mac_tags);
						console.log('op_url: '+op_url);
						console.log('idusr: '+idusr);
						console.log('nmusr: '+nmusr);
						console.log('bodega: '+bodega);
						*/
						//se verifica disponibilidad de los EPPs seleccionados
						var _url="vws/ajax_check_epp_status.php";
						//console.log('_url: '+_url);
						$.ajax({
							url: _url,
							type: "GET",
							data: {
								id_epps: id_epps,
								epps: epps,
								mac_tags: mac_tags
							},
							dataType: "JSON",
							success: function(data){
								if(data.status){
									var _url="vws/ajax_authorize_user.php";
									//console.log('_url: '+_url);
									$.ajax({
										url: _url,
										type: "GET",
										data: {
											fae: fae,
											niv: niv,
											des: des,
											b: b,
											rut: rutt,
											idusr_login: idusr_login,
											id_epps: id_epps,
											epps: epps,
											mac_tags: mac_tags,
											op_url: op_url,
											idusr: idusr,
											nmusr: nmusr,
											bodega: bodega

										},
										dataType: "JSON",
										success: function(data){
											if(data.status){
												var str_msg_swal;
												if(des != '')
													str_msg_swal = 'Se ha autorizado el ingreso a <b>'+rut+'</b> a la Mina/Faena <b>'+fae_text+'</b>, Nivel <b>'+niv+'</b>, Destino <b>'+des_text+'</b>. </br>ID de Acceso <b>'+data.ACC_NM_ID+'</b>.';
												else
													str_msg_swal = 'Se ha autorizado el ingreso a <b>'+rut+'</b> a la Mina/Faena <b>'+fae_text+'</b>, Nivel <b>'+niv+'</b>. </br>ID de Acceso <b>'+data.ACC_NM_ID+'</b>.';
												Swal.fire({
													title: 'Ingreso autorizado',
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
									$('#idusr').val('');
									$('#nmusr').val('');
									$('#rut').val('');
									$('#fecha_hora').val('');
									$('#nombre').val('');
									$("#btn_aut").prop("disabled", true);
									$("#btn_aut2").prop("disabled", true);
									$("#btn_aepp").prop("disabled", true);
									$(".faena").html('<option value="">Seleccione la Faena</option>');
									$("#faena").prop("disabled", true);
									$(".nivel").html('<option value="">Seleccione el Nivel</option>');
									$("#nivel").prop("disabled", true);
									$(".destino").html('<option value="">Seleccione el Destino</option>');
									$("#destino").prop("disabled", true);
									$('#table_epp2 tbody').empty();
									$("#btn_epp").prop("disabled", true);
									$('#table_epp1 tbody').empty();
									$('[data-toggle="tooltip"], .tooltip').tooltip("hide");
								}else {
									var str_msg_swal;
									if(data.code_error == '1'){
										str_msg_swal = 'Alguno(s) de lo(s) EPP(s) seleccionados(s) ya fueron asignados en otra operación.</br>'+data.error_msg+'.';
									}else{
										str_msg_swal = data.error_msg;
									}
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
						return false;
					}else{
						var str_msg_swal = '';
						if(!$("#myform").valid()){
							str_msg_swal = 'Debe ingresar todos los datos del Formulario.</br>';
						}
						if(!cant_lamp > 0){
							str_msg_swal = str_msg_swal +'Debe tener al menos un EPP LAMPCC asignado o por asignar para registrar el Acceso.</br>';
						}
						Swal.fire({
							title: 'Error',
							html: str_msg_swal,
							type: 'error',
							confirmButtonText: 'Aceptar',
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false
						});
						return false;
					}
				});

				$(document).on("click", ".add-aut2", function(){
					if($("#myform").valid()){
						var fae = $('#faena').val();
						var fae_text = $('#faena option:selected').text();
						var niv = $('#nivel').val();
						var des = $('#destino').val();
						if (des == '' || typeof des === 'undefined') {
							des = '';
						}
						var des_text = $('#destino option:selected').text();
						var b = $('#b').val();
						var idusr_login = $('#idusr_login').val();
						var rut = String($('#rut').val());
						var rutt = rut.replace(/\./g,'')
						var _url="vws/ajax_authorize_user2.php";
						$.ajax({
							url: _url,
							type: "GET",
							data: {
								fae: fae,
								niv: niv,
								des: des,
								b: b,
								rut: rutt,
								idusr_login: idusr_login,
							},
							dataType: "JSON",
							success: function(data){
								if(data.status){
									var str_msg_swal;
									if(des != '')
										str_msg_swal = 'Se ha autorizado el ingreso a <b>'+rut+'</b> a la Mina/Faena <b>'+fae_text+'</b>, Nivel <b>'+niv+'</b>, Destino <b>'+des_text+'</b>. </br>ID de Acceso <b>'+data.ACC_NM_ID+'</b>.';
									else
										str_msg_swal = 'Se ha autorizado el ingreso a <b>'+rut+'</b> a la Mina/Faena <b>'+fae_text+'</b>, Nivel <b>'+niv+'</b>. </br>ID de Acceso <b>'+data.ACC_NM_ID+'</b>.';
									Swal.fire({
										title: 'Ingreso autorizado',
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

						$('#idusr').val('');
						$('#nmusr').val('');
						$('#rut').val('');
						$('#fecha_hora').val('');
						$('#nombre').val('');
						$("#btn_aut").prop("disabled", true);
						$("#btn_aut2").prop("disabled", true);
						$("#btn_aepp").prop("disabled", true);
						$(".faena").html('<option value="">Seleccione la Faena</option>');
						$("#faena").prop("disabled", true);
						$(".nivel").html('<option value="">Seleccione el Nivel</option>');
						$("#nivel").prop("disabled", true);
						$(".destino").html('<option value="">Seleccione el Destino</option>');
						$("#destino").prop("disabled", true);
						$('#table_epp2 tbody').empty();
						$("#btn_epp").prop("disabled", true);
						$('#table_epp1 tbody').empty();
						$('[data-toggle="tooltip"], .tooltip').tooltip("hide");
						return false;
					}else{
						Swal.fire({
							title: 'Error',
							html: 'Debe ingresar todos los datos para poder realizar el Ingreso.',
							type: 'error',
							confirmButtonText: 'Aceptar',
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false
						});
						return false;
					}
				});

				$(document).on("click", ".add-epp", function(){
					var cant_epp = parseInt($('#epps').val());
					var idusr = $('#idusr').val();
					var nmusr = $('#nmusr').val();
					var rut = String($('#rut').val());
					var rutt = rut.replace(/\./g,'');
					var bodega = $('#b').val();
					var bodega_text = $('#b_txt').val();
					if(cant_epp > 0 && rut != '' && idusr != '' && nmusr != ''){
						var editable_registers = $("#table_epp1 tbody").find(".add:visible").length;
						var rowCount = $('#table_epp1 tbody tr').length;
						//console.log('cant_epp: '+ cant_epp);
						var op_url;
						var id_epps = '';
						var epps = '';
						var mac_tags = '';
						var b = $('#b').val();
						var idusr_login = $('#idusr_login').val();

						$('#table_epp1 tbody').find('td[id=cbarra_td]').each(function(){
							epp = $(this).text();
							epps = epps + epp + '|';
						});
						$('#table_epp1 tbody').find('td[id=cod_td]').each(function(){
							mac_tag = $(this).text();
							if(mac_tag == ''){
								mac_tag = '0';
							}
							mac_tags = mac_tags + mac_tag + '|';
						});
						$('#table_epp1 tbody').find('input[id=idepp]').each(function(){
							id_epp = $(this).val();
							id_epps = id_epps + id_epp + '|';
						});
						/*
						console.log('b: '+b);
						console.log('rut: '+rutt);
						console.log('idusr_login: '+idusr_login);
						console.log('id_epps: '+id_epps);
						console.log('epps: '+epps);
						console.log('mac_tags: '+mac_tags);
						console.log('op_url: '+op_url);
						console.log('idusr: '+idusr);
						console.log('nmusr: '+nmusr);
						console.log('bodega: '+bodega);
						*/
						//se verifica disponibilidad de los EPPs seleccionados
						var _url="vws/ajax_check_epp_status.php";
						//console.log('_url: '+_url);
						$.ajax({
							url: _url,
							type: "GET",
							data: {
								id_epps: id_epps,
								epps: epps,
								mac_tags: mac_tags
							},
							dataType: "JSON",
							success: function(data){
								if(data.status){
									//se asignan EPPs
									var _url="vws/ajax_add_epp.php";
									//console.log('_url: '+_url);
									$.ajax({
										url: _url,
										type: "GET",
										data: {
											rut: rutt,
											idusr_login: idusr_login,
											id_epps: id_epps,
											epps: epps,
											mac_tags: mac_tags,
											idusr: idusr,
											nmusr: nmusr,
											bodega: bodega
										},
										dataType: "JSON",
										success: function(data){
											if(data.status){
												var str_msg_swal = 'Se ha realizado la asignación de EPPs de para  <b>'+rut+'</b>';
												Swal.fire({
													title: 'EPPs asignados',
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
									$('#idusr').val('');
									$('#nmusr').val('');
									$('#rut').val('');
									$('#fecha_hora').val('');
									$('#nombre').val('');
									$("#btn_aut").prop("disabled", true);
									$("#btn_aut2").prop("disabled", true);
									$("#btn_aepp").prop("disabled", true);
									$(".faena").html('<option value="">Seleccione la Faena</option>');
									$("#faena").prop("disabled", true);
									$(".nivel").html('<option value="">Seleccione el Nivel</option>');
									$("#nivel").prop("disabled", true);
									$(".destino").html('<option value="">Seleccione el Destino</option>');
									$("#destino").prop("disabled", true);
									$('#table_epp2 tbody').empty();
									$("#btn_epp").prop("disabled", true);
									$('#table_epp1 tbody').empty();
									$('[data-toggle="tooltip"], .tooltip').tooltip("hide");
								}else {
									var str_msg_swal;
									if(data.code_error == '1'){
										str_msg_swal = 'Alguno(s) de lo(s) EPP(s) seleccionados(s) ya fueron asignados en otra operación.</br>'+data.error_msg+'.';
									}else{
										str_msg_swal = data.error_msg;
									}
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
						return false;
					}else{
						Swal.fire({
							title: 'Error',
							html: 'Debe ingresar todos los datos para poder realizar la asignación de EPPs.',
							type: 'error',
							confirmButtonText: 'Aceptar',
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false
						});
					}
					return false;
				});
			});

			function search_niveles(faena){
				var _url="vws/ajax_niveles.php?fae="+faena;
				var niveles;
				$.ajax({
					url: _url,
					type: "GET",
					dataType: "JSON",
					success: function(data){
						if(data.status){
							niveles = data.selector_niv;
						}else {
							niveles = false;
						}
					},
					error: function (){
						niveles = false;
					}
				});
				return niveles;
			};
			function search_user(){
				var rut = String($('#rut').val());
				var fae = String($('#idfusr').val());
				var rutt = rut.replace(/\./g,'');
				if($("#myform").validate().element("#rut")){
					$(".search").prop("disabled", true);
					$('#table_epp1 tbody').empty();
					$('#table_epp2 tbody').empty();
					var _url="vws/ajax_search_user3.php?rut="+rutt;
					var fh = fechaHoraHoy();
					$.ajax({
						url: _url,
						type: "GET",
						dataType: "JSON",
						success: function(data){
							$(".search").prop("disabled", false);
							if(data.status){
								if(data.statusr == 'S'){
									$("#btn_aut2").prop("disabled", false);
									var i;
									var count_epps_asig = data.count_epps_asig;
									var count_lampcc_asig = data.count_lampcc_asig;
									$('#fecha_hora').val(fh);
									$('#nombre').val(data.nombre);
									$('#idusr').val(data.id);
									$('#nmusr').val(data.nombre);
									$('#neppusr').val(data.count_epps_asig);
									$("#faena").prop("disabled", false);
									$(".faena").html(data.selector_fae);
									$(".faena").val(fae);
									var _url2="vws/ajax_niveles.php?fae="+fae;
									var niveles;
									$.ajax({
										url: _url2,
										type: "GET",
										dataType: "JSON",
										success: function(data){
											if(data.status){
												niveles = data.selector_niv;
												$(".nivel").html(niveles);
												$("#nivel").prop("disabled", false);
											}else {
												$("#nivel").prop("disabled", true);
											}
										},
										error: function (){
											$("#nivel").prop("disabled", true);
										}
									});

									/*agregar primera fila por defecto*/
									$(".add-new").attr("disabled", "disabled");
									var index = $("#table_epp1 tbody tr:last-child").index();
									var row = '<tr>' +
												'<input type="hidden" name="idepp" id="idepp" value="">' +
												'<input type="hidden" name="cdepp" id="cdepp" value="">' +
												'<td id="i_td"><b>1</b></td>' +
												'<td id="cbarra_td"><input type="text" class="form-control" name="cbarra" id="cbarra"></td>' +
												'<td id="desc_td"><input type="text" class="form-control" name="desc" id="desc" disabled></td>' +
												'<td id="cod_td"><input type="text" class="form-control" name="cod" id="cod" disabled></td>' +
												'<td>' +
													'<a class="add" data-toggle="tooltip" data-placement="top" title="Agregar datos"><i class="fas fa-plus-square"></i></a>' +
													'<a class="edit" data-toggle="tooltip" data-placement="top" title="Editar datos"><i class="fas fa-edit"></i></a>' +
													'<a class="delete" data-toggle="tooltip" data-placement="top" title="Borrar fila"><i class="fas fa-trash-alt"></i></a>' +
												'</td>'
											'</tr>';
									$("#table_epp1").append(row);
									$("#table_epp1 tbody tr").eq(index + 1).find(".add, .edit").toggle();
									$('[data-toggle="tooltip"]').tooltip();
									$('input[name=cbarra]').focus();

									if(count_epps_asig > 0){
										$('#table_epp2 tbody').empty();
										var lamp = 0;
										for(i = 0; i < count_epps_asig; i++){
											var id = data.epps_asignados[i][0];
											var tipo = data.epps_asignados[i][1];
											var cb = data.epps_asignados[i][2];
											var ds = data.epps_asignados[i][3];
											var mt = data.epps_asignados[i][5];
											if(mt == null)
												mt = '';
											var idop = data.epps_asignados[i][6];
											var id_idop = id + '#' + idop;
											var row = '<tr>' +
														'<input type="hidden" name="idepp" id="idepp" value="'+ id +'">' +
														'<input type="hidden" name="cdepp" id="cdepp" value="'+ id +'">' +
														'<td id="i_td"><b>'+ (i+1) +'</b></td>' +
														'<td id="cbarra_td">'+ cb +'</td>' +
														'<td id="desc_td">'+ ds +'</td>' +
														'<td id="cod_td">'+ mt +'</td>'
													'</tr>';
											$("#table_epp2").append(row);
										}
										var cant_lamp = parseInt($('#lampc').val()) + count_lampcc_asig;
										$('#lampc').val(cant_lamp);
										if(cant_lamp > 0){
											$("#btn_aut").prop("disabled", false);
										}else{
											$("#btn_aut").prop("disabled", true);
										}
									}
								}else{
									$("#btn_aut").prop("disabled", true);
									$("#btn_aut2").prop("disabled", true);
									$("#btn_aepp").prop("disabled", true);
									Swal.fire({
										title: 'Información',
										text: 'El RUT ingresado se encuentra inactivo.',
										type: 'warning',
										confirmButtonText: 'Aceptar',
										allowOutsideClick: true,
										allowEscapeKey: true,
										allowEnterKey: true
									});
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
								$('#rut').val('');
								$('#idusr').val('');
								$('#nmusr').val('');
								$("#neppusr").val('');
								$("#lampc").val('0');
								$("#epps").val('0');
								$("#fecha_hora").val('');
								$("#nombre").val('');
								$(".faena").val('');
								$(".nivel").val('');
								$(".destino").val('');

								$("#btn_aut").prop("disabled", true);
								$("#btn_aut2").prop("disabled", true);
								$("#btn_epp").prop("disabled", true);
								$("#btn_aepp").prop("disabled", true);

								$('#table_epp1 tbody').empty();
								$('#table_epp2 tbody').empty();

								$(".faena").html('<option value="">Seleccione la Faena</option>');
								$("#faena").prop("disabled", true);
								$(".nivel").html('<option value="">Seleccione el Nivel</option>');
								$("#nivel").prop("disabled", true);
								$(".destino").html('<option value="">Seleccione el Destino</option>');
								$("#destino").prop("disabled", true);
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
							$('#rut').val('');
							$('#idusr').val('');
							$('#nmusr').val('');
							$("#neppusr").val('');
							$("#lampc").val('0');
							$("#epps").val('0');
							$("#fecha_hora").val('');
							$("#nombre").val('');
							$(".faena").val('');
							$(".nivel").val('');
							$(".destino").val('');

							$("#btn_aut").prop("disabled", true);
							$("#btn_aut2").prop("disabled", true);
							$("#btn_epp").prop("disabled", true);
							$("#btn_aepp").prop("disabled", true);

							$('#table_epp1 tbody').empty();
							$('#table_epp2 tbody').empty();

							$(".faena").html('<option value="">Seleccione la Faena</option>');
							$("#faena").prop("disabled", true);
							$(".nivel").html('<option value="">Seleccione el Nivel</option>');
							$("#nivel").prop("disabled", true);
							$(".destino").html('<option value="">Seleccione el Destino</option>');
							$("#destino").prop("disabled", true);
						}
					});
				}else{
					Swal.fire({
						title: 'Error',
						html: 'Debe ingresar un RUT',
						type: 'error',
						confirmButtonText: 'Aceptar',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false
					});
					$('#idusr').val('');
					$('#nmusr').val('');
					$("#neppusr").val('');
					$("#lampc").val('0');
					$("#epps").val('0');
					$("#fecha_hora").val('');
					$("#nombre").val('');
					$(".faena").val('');
					$(".nivel").val('');
					$(".destino").val('');

					$("#btn_aut").prop("disabled", true);
					$("#btn_aut2").prop("disabled", true);
					$("#btn_epp").prop("disabled", true);
					$("#btn_aepp").prop("disabled", true);

					$('#table_epp1 tbody').empty();
					$('#table_epp2 tbody').empty();

					$(".faena").html('<option value="">Seleccione la Faena</option>');
					$("#faena").prop("disabled", true);
					$(".nivel").html('<option value="">Seleccione el Nivel</option>');
					$("#nivel").prop("disabled", true);
					$(".destino").html('<option value="">Seleccione el Destino</option>');
					$("#destino").prop("disabled", true);
				}
			};

			$('.search_user').click(search_user);
			$('.rut').blur(search_user);

			$("#rut").on("paste", function(){
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
				$('#idusr').val('');
				$('#nmusr').val('');
				$("#neppusr").val('');
				$("#lampc").val('0');
				$("#epps").val('0');
				$("#fecha_hora").val('');
				$("#nombre").val('');
				$(".faena").val('');
				$(".nivel").val('');
				$(".destino").val('');

				$("#btn_aut").prop("disabled", true);
				$("#btn_aut2").prop("disabled", true);
				$("#btn_epp").prop("disabled", true);
				$("#btn_aepp").prop("disabled", true);

				$('#table_epp1 tbody').empty();
				$('#table_epp2 tbody').empty();

				$(".faena").html('<option value="">Seleccione la Faena</option>');
				$("#faena").prop("disabled", true);
				$(".nivel").html('<option value="">Seleccione el Nivel</option>');
				$("#nivel").prop("disabled", true);
				$(".destino").html('<option value="">Seleccione el Destino</option>');
				$("#destino").prop("disabled", true);
			});

			$('#rut').on('input', function() {
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
				if (!this.value) {
					$('#rut').val('');
					$('#idusr').val('');
					$('#nmusr').val('');
					$("#neppusr").val('');
					$("#lampc").val('0');
					$("#epps").val('0');
					$("#fecha_hora").val('');
					$("#nombre").val('');
					$(".faena").val('');
					$(".nivel").val('');
					$(".destino").val('');

					$("#btn_aut").prop("disabled", true);
					$("#btn_aut2").prop("disabled", true);
					$("#btn_epp").prop("disabled", true);
					$("#btn_aepp").prop("disabled", true);

					$('#table_epp1 tbody').empty();
					$('#table_epp2 tbody').empty();

					$(".faena").html('<option value="">Seleccione la Faena</option>');
					$("#faena").prop("disabled", true);
					$(".nivel").html('<option value="">Seleccione el Nivel</option>');
					$("#nivel").prop("disabled", true);
					$(".destino").html('<option value="">Seleccione el Destino</option>');
					$("#destino").prop("disabled", true);
				}
			});

			$('#rut').keypress(function(e){
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
			});

			function clean_user(){
				$('#rut').val('');
				$('#idusr').val('');
				$('#nmusr').val('');
				$("#neppusr").val('');
				$("#lampc").val('0');
				$("#epps").val('0');
				$("#fecha_hora").val('');
				$("#nombre").val('');
				$(".faena").val('');
				$(".nivel").val('');
				$(".destino").val('');

				$("#btn_aut").prop("disabled", true);
				$("#btn_aut2").prop("disabled", true);
				$("#btn_epp").prop("disabled", true);
				$("#btn_aepp").prop("disabled", true);

				$('#table_epp1 tbody').empty();
				$('#table_epp2 tbody').empty();

				$(".faena").html('<option value="">Seleccione la Faena</option>');
				$("#faena").prop("disabled", true);
				$(".nivel").html('<option value="">Seleccione el Nivel</option>');
				$("#nivel").prop("disabled", true);
				$(".destino").html('<option value="">Seleccione el Destino</option>');
				$("#destino").prop("disabled", true);

				$("label.error").hide();
				$(".error").removeClass("error");
			};

			$('.clean_user').click(clean_user);

			var meses = new Array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
			function fechaHoraHoy() {
				var currentDate = new Date()
				var day = currentDate.getDate();
				var month = meses[currentDate.getMonth()];
				var year = currentDate.getFullYear();

				var curHour = currentDate.getHours() > 12 ? currentDate.getHours() - 12 : (currentDate.getHours() < 10 ? "0" + currentDate.getHours() : currentDate.getHours());
				var curMinute = currentDate.getMinutes() < 10 ? "0" + currentDate.getMinutes() : currentDate.getMinutes();
				var curSeconds = currentDate.getSeconds() < 10 ? "0" + currentDate.getSeconds() : currentDate.getSeconds();
				var curMeridiem = currentDate.getHours() > 12 ? "PM" : "AM";
				return ("" + day + "-" + month + "-" + year + "  " +curHour +":" +curMinute+":" +curSeconds+" " +curMeridiem);
			}

			$('#table_epp1').on('keydown', function (e) {
			    if (e.keyCode == 13) {
			        return false;
			    }
			});
		</script>
	</body>
</html>
