<?php global $session; ?>
<!-- Sidebar -->
<ul class="sidebar navbar-nav toggled">
	<li class="nav-item active_not">
		<a class="nav-link" href="<?php echo path_home; ?>admin/">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
	</li>
	
	
	<li class="nav-item dropdown no-arrow mx-1">
		<a class="nav-link dropdown-toggle" href="#" id="locationsSubdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-cog"></i>
			<span>Opciones</span>
			<!-- // <span class="badge badge-danger"></span> -->
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="locationsSubdropdown">
			<!--
			<a href="javascript: window.open('#/SettingsApp/TermsAndConditions/Edit')"><i class="fa fa-id-badge"></i> Terminos y Condiciones del Servicio </a>
			<a href="javascript: window.open('#/SettingsApp/proposalLetter/Edit')"><i class="fa fa-id-badge"></i> Modelo de Carta Propuestas </a>
			-->
			<a class="dropdown-item" href="/admin/settings-app/">Configuracion</a>
			<div class="dropdown-divider"></div>
		</div>
	</li>
</ul>

