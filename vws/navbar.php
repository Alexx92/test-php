<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="images/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
    SAM - Sistema de Control de Seguridad de Acceso a Mina
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
		<li class="nav-item active">
			<a class="nav-link" href="index.php?p=inicio">Inicio <span class="sr-only"></span></a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="index.php?p=inicio" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Panel
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<a class="dropdown-item" href="index.php?p=imina">Ingreso a Mina / Entrega EPP</a>
				<a class="dropdown-item" href="index.php?p=smina">Salida a Mina / Retorno EPP</a>
				<a class="dropdown-item" href="index.php?p=inf">Informes</a>
			</div>
		</li>
		<?php
		if($_SESSION['idrol'] == 0){
		?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Mantenedores
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="index.php?p=usrs">Usuarios</a>
					<a class="dropdown-item" href="index.php?p=stck">Stocks EPP</a>
				</div>
			</li>
		<?php
		}
		?>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Perfil
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<div class="dropdown-item">
					<?php
						echo '<i class="fas fa-user-circle"></i> '.$_SESSION['usuario'].'</br>';
						echo 'Rol: '.$_SESSION['nomrol'].'</br>';
						echo 'En: '.$_SESSION['nombodega'].'</br>';
					?>
				</div>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="index.php?p=update_bod"><i class="fab fa-houzz"></i> Actualizar Bodega</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="index.php?p=close_session">Cerrar sesión</a>
			</div>
		</li>
	</ul>
  </div>
</nav>