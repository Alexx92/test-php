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
						<h5>Retorno de EPP</h5></br>
						<form id="myform" action="#" method="">
							<input type="hidden" name="p" id="p" value="<?php echo $_SESSION['idrol']; ?>">
							<input type="hidden" name="b" id="b" value="<?php echo $_SESSION['idbodega']; ?>">
							<input type="hidden" name="b_txt" id="b_txt" value="<?php echo $_SESSION['nombodega']; ?>">
							<input type="hidden" name="idusr" id="idusr" value="">
							<input type="hidden" name="nmusr" id="nmusr" value="">
							<input type="hidden" name="idop" id="idop" value="">
							<input type="hidden" name="neppusr" id="neppusr" value="">
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
								<div class="col-sm-8"><h5>Listado de EPP para retornar</h5></div>
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary btn-sm return" id="btn_repp" disabled><i class="fas fa-download"></i> Retornar EPPs seleccionados</button>
								</div>
							</div>
							<div class="row">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th id="i_tr">#</th>
											<th>Código Barra</th>
											<th>Descripción</th>
											<th>MAC-TAG</th>
											<th><input type="checkbox" class="del_all" id="del_all" data-toggle="tooltip" data-placement="top" title="Seleccionar todos"></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="row">
							</div>
						</form>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
				</div>
			</div>
		</div>
		<script>
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
						}/*,						
						bodega: {
							required: true
						}	*/   
					},
					messages : {
						rut: {
							required: "*Debe ingresar un RUT."
						}
					}
				}); 
				$('[data-toggle="tooltip"]').tooltip();
				$('#del_all').change(function(){
					if (this.checked == true) {
						$('input:checkbox').prop('checked', true);
						$('[data-toggle="tooltip"], .tooltip').tooltip("hide");
						$('[data-toggle="tooltip"]').tooltip();
						$(this).attr('title', 'Desmarcar todos');
					}else{
						$('input:checkbox').prop('checked', false);
						$('[data-toggle="tooltip"], .tooltip').tooltip("hide");
						$('[data-toggle="tooltip"]').tooltip();					
						$(this).attr('title', 'Seleccionar todos');
					}
				});
				$(document).on("click", ".return", function(){
					console.log('RETURN EPPs!!');
					if($("#myform").valid()){
						var id_epps = '';
						var epps = '';
						var mac_tags = '';
						var count_epps_sel = 0;
						$('table tbody').find('input[type=checkbox][id=sel_epp]:checked').each(function(){
							id_epp = $(this).val();
							id_epps = id_epps + id_epp + '|';
							count_epps_sel++;
							
							epp = $(this).closest('tr').find('td[id=cbarra_td]').text();
							epps = epps + epp + '|';
							
							mac_tag = $(this).closest('tr').find('td[id=cod_td]').text();
							if(mac_tag == '')
								mac_tag = '0';
							mac_tags = mac_tags + mac_tag + '|';
						});	
						if(count_epps_sel > 0){
							var idusr = $('#idusr').val();
							var nmusr = $('#nmusr').val();
							//var idop = $('#idop').val();
							var neppusr = $('#neppusr').val();
							var rut = String($('#rut').val());
							var rutt = rut.replace(/\./g,'');
							var bodega = $('#b').val();
							var bodega_text = $('#b_txt').val();
							var _url="vws/ajax_return_epp.php";							
							$.ajax({
									url : _url,
									type: "GET",
									data: {
										idusr: idusr,
										nmusr: nmusr,
										neppusr: neppusr,
										rut: rutt,
										bod: bodega,
										id_epps: id_epps,
										epps: epps,
										mac_tags: mac_tags,
										count_epps_sel: count_epps_sel
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
											console.log("exito!!");
											Swal.fire({
												title: 'EPPs retornados',
												html: 'Los EPPs han sido retornados correctamente a la bodega <b>'+ bodega_text +'</b>.',
												type: 'success',
												confirmButtonText: 'Aceptar',
												allowOutsideClick: false,
												allowEscapeKey: false,
												allowEnterKey: false
											});
										}else {
											console.log("fail!!");
											Swal.fire({
												title: 'Error',
												text: data.error_msg,
												type: 'error',
												confirmButtonText: 'Aceptar',
												allowOutsideClick: false,
												allowEscapeKey: false,
												allowEnterKey: false
											});
										}
										$('#idusr').val('');
										$('#nmusr').val('');
										$('#rut').val('');
										$('#fecha_hora').val('');
										$('#nombre').val('');
										$("#btn_repp").prop("disabled", true);
										$('table tbody').empty();
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
										$('#idusr').val('');
										$('#nmusr').val('');
										$('#rut').val('');
										$('#fecha_hora').val('');
										$('#nombre').val('');
										$("#btn_repp").prop("disabled", true);
										$('table tbody').empty();
									}
								});	
							return false;
						}else{
							Swal.fire({
								title: '',
								text: 'Debe seleccionar EPPs para retornar.',
								type: 'warning',
								confirmButtonText: 'Aceptar',
								allowOutsideClick: false,
								allowEscapeKey: false,
								allowEnterKey: false
							});
						}
					}else{
						Swal.fire({
							title: '',
							text: 'Debe ingresar un RUT.',
							type: 'warning',
							confirmButtonText: 'Aceptar',
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false
						});
						return false;
					}					
					return false;
				});
				
			});	
			
			function search_user(){
				var p = $('#p').val();
				var b = $('#b').val();
				var rut = String($('#rut').val());
				var rutt = rut.replace(/\./g,'');
				if(rut){
					$(".search").prop("disabled", true);
					var _url="vws/ajax_search_user2.php?rut="+rutt+"&p="+p+"&b="+b;
					console.log('_url: '+ _url);
					var fh = fechaHoraHoy();				
					$.ajax({
						url: _url,
						type: "GET",
						dataType: "JSON",
						success: function(data){
							$(".search").prop("disabled", false);
							if(data.status){
								if(data.statusr == 'S'){
									$('table tbody').empty();
									$("#btn_repp").prop("disabled", false);
									$('#fecha_hora').val(fh);
									$('#nombre').val(data.nombre);
									$('#idusr').val(data.id);
									$('#nmusr').val(data.nombre);
									$('#neppusr').val(data.count_epps_asig);
									var i;
									var count_epps_asig = data.count_epps_asig;
									for(i = 0; i < count_epps_asig; i++){
										var id = data.epps_asignados[i][0];
										var cb = data.epps_asignados[i][2];
										var ds = data.epps_asignados[i][3];
										var mt = data.epps_asignados[i][5];
										var idop = data.epps_asignados[i][6];
										var id_idop = id + '#' + idop;
										var row = '<tr>' +
													'<input type="hidden" name="idepp" id="idepp" value="'+ id +'">' +
													'<td id="i_td"><b>'+ (i+1) +'</b></td>' +
													'<td id="cbarra_td">'+ cb +'</td>' +
													'<td id="desc_td">'+ ds +'</td>' +
													'<td id="cod_td">'+ mt +'</td>' +
													'<td><input type="checkbox" class="sel_epp" id="sel_epp" value="'+ id_idop +'"></td>'
												'</tr>';
										$("table").append(row);	
									}
								}else{
									Swal.fire({
										title: 'Información',
										text: 'El RUT ingresado se encuentra inactivo.',
										type: 'warning',
										confirmButtonText: 'Aceptar',
										allowOutsideClick: false,
										allowEscapeKey: false,
										allowEnterKey: false
									});
								}
							}else {
								if(data.error_code == 3){
									Swal.fire({
										title: '',
										html: 'El RUT <b>'+ rut +'</b> no tiene EPPs asignados',
										type: 'warning',
										confirmButtonText: 'Aceptar',
										allowOutsideClick: false,
										allowEscapeKey: false,
										allowEnterKey: false
									});							
								}else if(data.error_code == 5){
									Swal.fire({
											title: 'Información',
											text: 'El RUT ingresado se encuentra inactivo.',
											type: 'warning',
											confirmButtonText: 'Aceptar',
											allowOutsideClick: false,
											allowEscapeKey: false,
											allowEnterKey: false
										});								
								}else{
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
								$('#idusr').val('');
								$('#nmusr').val('');
								$('#rut').val('');
								$('#fecha_hora').val('');
								$('#nombre').val('');
								$("#btn_repp").prop("disabled", true);
								$('table tbody').empty();
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
							$('#idusr').val('');
							$('#nmusr').val('');
							$('#rut').val('');
							$('#fecha_hora').val('');
							$('#nombre').val('');
							$("#btn_repp").prop("disabled", true);
							$('table tbody').empty();
						}
					});
				}else{
					$('.rut').addClass("error");
					Swal.fire({
						title: 'Error',
						html: 'Debe ingresar un RUT',
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
				
				$('#idusr').val('');
				$('#nmusr').val('');
				$('#idop').val('');
				$('#rut').val('');
				$('#fecha_hora').val('');
				$('#nombre').val('');
				$("#btn_repp").prop("disabled", true);
				$('.table tbody').empty();
			});
			
			$('#rut').on('input', function() { 
				//console.log('on input!!');
				var rut = $('#rut').val();
				var rutt = rut.replace("'", "");
				$('#rut').val(rutt);
				
				if (!this.value) {
					console.log('rut vacio');
					$('#idusr').val('');
					$('#nmusr').val('');
					$('#idop').val('');
					$('#rut').val('');
					$('#fecha_hora').val('');
					$('#nombre').val('');
					$('#bodega').val('');
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