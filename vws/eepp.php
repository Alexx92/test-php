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
						<h5>Entrega de EPP</h5></br>
						<form id="myform" action="#" method="">
							<input type="hidden" name="p" id="p" value="<?php echo $_SESSION['idrol']; ?>">
							<input type="hidden" name="b" id="b" value="<?php echo $_SESSION['idbodega']; ?>">
							<input type="hidden" name="b_txt" id="b_txt" value="<?php echo $_SESSION['nombodega']; ?>">
							<input type="hidden" name="idusr" id="idusr" value="">
							<input type="hidden" name="nmusr" id="nmusr" value="">
							<div class="form-group row">
								<label for="rut" class="col-sm-1 col-form-label col-form-label-sm">RUT</label>
								<div class="col-sm-3">
									<input type="text" class="form-control form-control-sm rut" name="rut" id="rut">
								</div>
								<div class="col-sm-1">
									<button type="button" class="btn btn-primary btn-sm search_user"><i class="fas fa-search"></i></button>
								</div>
								<label for="fecha_hora" class="col-sm-1 col-form-label col-form-label-sm">Fecha/Hora</label>
								<div class="col-sm-6">
									<input type="text" class="form-control form-control-sm" name="fecha_hora" id="fecha_hora" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label for="nombre" class="col-sm-1 col-form-label col-form-label-sm">Nombre</label>
								<div class="col-sm-4">
									<input type="text" class="form-control form-control-sm" name="nombre" id="nombre" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-10"><h5>Listado de EPP para asignar</h5></div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-primary btn-sm add-new" id="btn_epp" disabled><i class="fas fa-plus"></i> Agregar EPP</button>
								</div>
							</div>
							<div class="row">
								<table class="table table-bordered table-hover">
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
							<div class="row">
								<div class="col-sm-2 offset-sm-10">
									<button type="submit" class="btn btn-primary btn-sm assign" id="btn_aepp" disabled><i class="fas fa-list aria-hidden="true"></i> Asignar EPPs</button>
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
						}  
					},
					messages : {
						rut: {
							required: "*Debe ingresar un RUT."
						}
					}
				}); 
				$('[data-toggle="tooltip"]').tooltip();
				var actions = $("table td:last-child").html();
				var i;
				$(".add-new").click(function(){
					var bodega = $('#b').val();
					var rowCount = $('table tbody tr').length;
					if(rowCount == 0){
						$(this).attr("disabled", "disabled");
						var index = $("table tbody tr:last-child").index();
						i = index + 2;
						var row = '<tr>' +
							'<input type="hidden" name="idepp" id="idepp" value="">' +
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
						$("table").append(row);		
						$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
						$('[data-toggle="tooltip"]').tooltip();
						$('input[name=cbarra]').focus();							
					}else{
						var val_last_child = $('table tbody tr:last-child td:nth-child(2) input').attr('id');
						var val_last_child2 = 'table tbody tr:last-child';
						if(val_last_child == 'cbarra'){ //ultimo hijo en modo input
							var empty = false;
							var input = $(val_last_child2).find('#cbarra');
							var input2 = $(val_last_child2).find('#desc');
							var input3 = $(val_last_child2).find('#cod');
							var input4 = $(val_last_child2).find('#idepp');
							console.log('stat_edit 2: '+stat_edit);
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
								var index = $("table tbody tr:last-child").index();
								i = index + 2;
								var row = '<tr>' +
									'<input type="hidden" name="idepp" id="idepp" value="">' +
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
								$("table").append(row);		
								$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
								$('[data-toggle="tooltip"]').tooltip();
								$('input[name=cbarra]').focus();
							}
						}else{
							$(this).attr("disabled", "disabled");
							var index = $("table tbody tr:last-child").index();
							i = index + 2;
							var row = '<tr>' +
								'<input type="hidden" name="idepp" id="idepp" value="">' +
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
							$("table").append(row);		
							$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
							$('[data-toggle="tooltip"]').tooltip();
							$('input[name=cbarra]').focus();
						}
					}
				});
				//$(document).on("click", ".add", function(){
				function new_row(){
					console.log('en new_row, stat_edit: '+stat_edit);
					//if (stat_edit == 0){
					//console.log('new_row function!!');	
					var bodega = $('#b').val();
					var bodega_text = $('#b_txt').val();
					var empty = false;
					var input = $(this).parents("tr").find('#cbarra');
					var input2 = $(this).parents("tr").find('#desc');
					var input3 = $(this).parents("tr").find('#cod');
					var input4 = $(this).parents("tr").find('input[type="hidden"]');
					var tr = $(this).parents("tr");
					console.log(input);
					if (stat_edit == 0){
						console.log('add error');
						input.each(function(){
							if(!$(this).val()){
								//console.log('here');
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
						var val_epp = [];
						var k = 0;
						$("table tbody").find("tr").each(function(){
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
						}else{
							var _url="vws/ajax_search_epp.php?epp="+cb+'&bod='+bodega;
							console.log(_url);
							$.ajax({
								url: _url,
								type: "GET",
								dataType: "JSON",
								success: function(data){
									if(data.status){
										if(data.stt == 0){ // 0 epp no asignado
											stat_edit--;
											//console.log('cambiar estado');
											$("#btn_aepp").prop("disabled", false);
											input.each(function(){
												$(this).parent("td").html(cb);
											});
											ds = data.ds;
											cd = data.mt;
											id = data.id;
											input2.each(function(){
												$(this).parent("td").html(ds);
											});	
											input3.each(function(){
												$(this).parent("td").html(cd);
											});	
											input4.each(function(){
												$(this).val(id);
											});	
											tr.each(function(){
												$(this).find(".add, .edit").toggle();
												if($(this).is('tr:last')){
													var index = $("table tbody tr:last-child").index();
													i = index + 2;
													var row = '<tr>' +
														'<input type="hidden" name="idepp" id="idepp" value="">' +
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
													$("table").append(row);		
													$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
													$('[data-toggle="tooltip"]').tooltip();
													//$('input[name=cbarra]').focus();
												}/*else{
													console.log('2');
												}*/
											});
											var element = $("table tbody tr:last-child").index() + 1;
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
											if(data.stt == 0){ // 0 epp no asignado
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
					}/*else{
						console.log('vacio 1');
					}*/
					//}
				};
				//console.log('antes de eventos, stat_edit: '+stat_edit);
				//if(stat_edit == 0){
					$(document).on("click", ".add", new_row);
					$(document).on("blur", "#cbarra", new_row);
				//}
				
			
				$(document).on("click", ".edit", function(){
					stat_edit++;
					console.log('en edit, stat_edit: '+stat_edit);
					$(this).parents("tr").find('#cbarra_td').each(function(){
						$(this).html('<input type="text" class="form-control" name="cbarra" id="cbarra"  value="' + $(this).text() + '">');
					//	$('input[name=cbarra]').focus();
					});	
					
					$(this).parents("tr").find('#desc_td').each(function(){
						$(this).html('<input type="text" class="form-control" name="desc" id="desc" disabled value="' + $(this).text() + '">');
					});	
					
					$(this).parents("tr").find('#cod_td').each(function(){
						$(this).html('<input type="text" class="form-control" name="cod" id="cod" disabled value="' + $(this).text() + '">');
					});
					$(this).parents("tr").find(".add, .edit").toggle();
					$(".add-new").attr("disabled", "disabled");
					var element = $("table tbody tr:last-child").index() + 1;
					if(element == 1){   
						$("option").prop("disabled", false);
					}
				});
				$(document).on("click", ".delete", function(){
					$(this).parents("tr").remove();
					$(".add-new").removeAttr("disabled");
					$('[data-toggle="tooltip"], .tooltip').tooltip("hide");
					var indice = 1;
					$('table tbody tr td[id="i_td"] b').each(function(){
						$(this).text(indice++);
					});
					if(indice == 1){
						$("#btn_aepp").prop("disabled", true);
					}
				});
				
				$(document).on("click", ".assign", function(){
					var editable_registers = $("table tbody").find(".add:visible").length;
					var rowCount = $('table tbody tr').length;
					if($("#myform").valid() && rowCount > 0){
						if(editable_registers == 0){
							var id_epps = '';
							var epps = '';
							var mac_tags = '';
							$('table tbody').find('td[id=cbarra_td]').each(function(){
								epp = $(this).text();
								epps = epps + epp + '|';
							});	
							$('table tbody').find('td[id=cod_td]').each(function(){
								mac_tag = $(this).text();
								if(mac_tag == ''){
									mac_tag = '0';
								}
								mac_tags = mac_tags + mac_tag + '|';
							});	
							$('table tbody').find('input[id=idepp]').each(function(){
								id_epp = $(this).val();
								id_epps = id_epps + id_epp + '|';
							});	
							var idusr = $('#idusr').val();
							var nmusr = $('#nmusr').val();
							var rut = String($('#rut').val());
							var rutt = rut.replace(/\./g,'');
							var bodega = $('#b').val();
							var bodega_text = $('#b_txt').val();
							console.log('mac_tags: '+mac_tags);
							var _url="vws/ajax_assign_epp.php?idusr="+idusr+"&nmusr="+nmusr+"&rut="+rutt+'&bod='+bodega;
							console.log('_url' + _url);
							$.ajax({
								url : _url,
								type: "GET",
								data: {
									id_epps: id_epps,
									epps: epps,
									mac_tags: mac_tags,
								},
								dataType: "JSON",
								beforeSend: function(){
									$('#imgSpinner').show();
								},
								complete: function(){
									$('#imgSpinner').hide();
								},
								success: function(data){
									if(data.status){
										Swal.fire({
											title: 'EPPs asignados',
											html: 'Los EPPs han sido asignados correctamente a la bodega <b>'+ bodega_text +'</b>.',
											type: 'success',
											confirmButtonText: 'Aceptar',
											allowOutsideClick: true,
											allowEscapeKey: true,
											allowEnterKey: true
										});
										$('#idusr').val('');
										$('#nmusr').val('');
										$('#rut').val('');
										$('#fecha_hora').val('');
										$('#nombre').val('');
										$("#btn_epp").prop("disabled", true);
										$("#btn_aepp").prop("disabled", true);
										$('table tbody').empty();
										$('[data-toggle="tooltip"], .tooltip').tooltip("hide");
									}else {
										Swal.fire({
											title: 'Error',
											text: data.error_msg,
											type: 'error',
											confirmButtonText: 'Aceptar',
											allowOutsideClick: true,
											allowEscapeKey: true,
											allowEnterKey: true
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
										allowOutsideClick: true,
										allowEscapeKey: true,
										allowEnterKey: true
									});
								}
							});			
							return false;
						}else if(editable_registers == 1){
							if(rowCount == 1){
								Swal.fire({
									title: '',
									text: 'Debe ingresar al menos un EPP',
									type: 'warning',
									confirmButtonText: 'Aceptar',
									allowOutsideClick: true,
									allowEscapeKey: true,
									allowEnterKey: true
								});
								return false;
							}else{
								var val_last_child = $('table tbody tr:last-child td:nth-child(3) input[type="text"]').attr('id');
								if(val_last_child == 'cbarra'){ //ultimo hijo en modo input
									var last_input =  $('table tbody tr:last-child td input[name=cbarra]').val();
									if(last_input == ''){
										var id_epps = '';
										var epps = '';
										var mac_tags = '';
										$('table tbody').find('td[id=cbarra_td]').each(function(){
											epp = $(this).text();
											epps = epps + epp + '|';
										});	
										$('table tbody').find('td[id=cod_td]').each(function(){
											mac_tag = $(this).text();
											if(mac_tag == ''){
												mac_tag = '0';
											}
											mac_tags = mac_tags + mac_tag + '|';
										});	
										$('table tbody').find('input[id=idepp]').each(function(){
											id_epp = $(this).val();
											id_epps = id_epps + id_epp + '|';
										});	
										var idusr = $('#idusr').val();
										var nmusr = $('#nmusr').val();
										var rut = String($('#rut').val());
										var rutt = rut.replace(/\./g,'');
										var bodega = $('#b').val();
										console.log('mac_tags: '+mac_tags);
										var _url="vws/ajax_assign_epp.php?idusr="+idusr+"&nmusr="+nmusr+"&rut="+rutt+'&bod='+bodega;
										console.log('_url' + _url);
										$.ajax({
											url : _url,
											type: "GET",
											data: {
												id_epps: id_epps,
												epps: epps,
												mac_tags: mac_tags,
											},
											dataType: "JSON",
											beforeSend: function(){
												$('#imgSpinner').show();
											},
											complete: function(){
												$('#imgSpinner').hide();
											},
											success: function(data){
												if(data.status){
													Swal.fire({
														title: 'EPPs asignados',
														text: 'Los EPPs han sido asignados correctamente.',
														type: 'success',
														confirmButtonText: 'Aceptar',
														allowOutsideClick: true,
														allowEscapeKey: true,
														allowEnterKey: true
													});
													$('#idusr').val('');
													$('#nmusr').val('');
													$('#rut').val('');
													$('#fecha_hora').val('');
													$('#nombre').val('');
													$("#btn_epp").prop("disabled", true);
													$("#btn_aepp").prop("disabled", true);
													$('table tbody').empty();
													$('[data-toggle="tooltip"], .tooltip').tooltip("hide");
												}else {
													Swal.fire({
														title: 'Error',
														text: data.error_msg,
														type: 'error',
														confirmButtonText: 'Aceptar',
														allowOutsideClick: true,
														allowEscapeKey: true,
														allowEnterKey: true
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
													allowOutsideClick: true,
													allowEscapeKey: true,
													allowEnterKey: true
												});
											}
										});	
										return false;
									}else{
										Swal.fire({
											title: '',
											text: 'Debe agregar los EPPs antes de asignarlos.',
											type: 'warning',
											confirmButtonText: 'Aceptar',
											allowOutsideClick: true,
											allowEscapeKey: true,
											allowEnterKey: true
										});
										$('table tbody tr:last-child td:nth-child(3) input[type="text"]').addClass("error");
										return false;
									}
								}else{
									console.log('else');
								}
							}
						}else{
							Swal.fire({
								title: '',
								text: 'Debe agregar los EPPs antes de asignarlos.',
								type: 'warning',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: true,
								allowEscapeKey: true,
								allowEnterKey: true
							});
							return false;
						}
					}else{
						if(!$("#myform").valid()){
							Swal.fire({
								title: '',
								text: 'Debe ingresar un RUT y seleccionar una bodega.',
								type: 'warning',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: true,
								allowEscapeKey: true,
								allowEnterKey: true
							});
						}
						if (rowCount == 0) {
							Swal.fire({
								title: '',
								text: 'Debe ingresar al menos un EPP.',
								type: 'warning',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: true,
								allowEscapeKey: true,
								allowEnterKey: true
							});
						}
						return false;
					}
				});
            });
			
			function search_user(){
				//console.log('search_user funcion!!');
				var p = $('#p').val();
				var b = $('#b').val();
				var rut = String($('#rut').val());
				var rutt = rut.replace(/\./g,'');
				if(rut){
					$(".search").prop("disabled", true);
					var _url="vws/ajax_search_user.php?rut="+rutt+"&p="+p+"&b="+b;
					var fh = fechaHoraHoy();
					$.ajax({
						url: _url,
						type: "GET",
						dataType: "JSON",
						success: function(data){
							$(".search").prop("disabled", false);
							if(data.status){
								//console.log('data.statusr: '+data.statusr);
								if(data.statusr == 'S'){
									$("#btn_epp").prop("disabled", false);
									$('#fecha_hora').val(fh);
									$('#nombre').val(data.nombre);
									$('#idusr').val(data.id);
									$('#nmusr').val(data.nombre);
									$('#usr_nepp').val(0);
									$('.table tbody').empty();
									
									/*agregar primera fila por defecto*/
									$(".add-new").attr("disabled", "disabled");
									var index = $("table tbody tr:last-child").index();
									var row = '<tr>' +
												'<input type="hidden" name="idepp" id="idepp" value="">' +
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
									$("table").append(row);		
									$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
									$('[data-toggle="tooltip"]').tooltip();
									$('input[name=cbarra]').focus();								
								}else{
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
									text: 'El RUT ingresado no se encuentra o ha sido ingresado de forma incorrecta.',
									type: 'error',
									confirmButtonText: 'Aceptar',
									allowOutsideClick: true,
									allowEscapeKey: true,
									allowEnterKey: true
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
								allowOutsideClick: true,
								allowEscapeKey: true,
								allowEnterKey: true
							});
						}
					});
				}else{
					$('.rut').addClass("error");
					Swal.fire({
						title: 'Error',
						html: 'Debe ingresar un RUT',
						type: 'error',
						confirmButtonText: 'Aceptar',
						allowOutsideClick: true,
						allowEscapeKey: true,
						allowEnterKey: true
					});
				}
			};
			
			$('.search_user').click(search_user);
			$('.rut').blur(search_user);
			/*
			$('.rut').keydown(function(e) {
				var code = e.keyCode || e.which;
				if (code === 9) {  
					e.preventDefault();
					search_user();
				}
			});
			*/
			$("#rut").on("paste", function(){
				//console.log('on paste!!');
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
				
				$('#idusr').val('');
				$('#nmusr').val('');
				$('#rut').val('');
				$('#fecha_hora').val('');
				$('#nombre').val('');
				$("#btn_epp").prop("disabled", true);
				$("#btn_aepp").prop("disabled", true);
				$('.table tbody').empty();
			});
			
			$('#rut').on('input', function() { 
				//console.log('on input!!');
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
				
				if (!this.value) {
					$('#idusr').val('');
					$('#nmusr').val('');
					$('#rut').val('');
					$('#fecha_hora').val('');
					$('#nombre').val('');
					$("#btn_epp").prop("disabled", true);
					$("#btn_aepp").prop("disabled", true);
					$('.table tbody').empty();
				}
			});
			
			$('#rut').keypress(function(e){
				//console.log('on keypress!!');
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
			});
			
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
		</script>
	</body>
</html>