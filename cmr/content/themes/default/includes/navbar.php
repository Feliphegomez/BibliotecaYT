<?php global $session, $site; ?>
<div class="header navbar navbar-expand-lg navbar-dark static-top">
	<div class="col-sm-8 header-left">
		<div class="logo">
			<a href="/index.html">
				<img src="<?php echo path_homeTheme; ?>images/logo.png" alt=""/>
			</a>
		</div>
		<div class="menu">
			<a class="toggleMenu" href="#"><img src="<?php echo path_homeTheme; ?>images/nav.png" alt="" /></a>
			<ul id="nav" class="nav_ pull-right" style="text-align: right_;">
				<!--
					<li class="active"><a href="index.html">Reality</a></li>
					<li><a href="living.html">Living</a></li>
					<li><a href="education.html">Education</a></li>
					<div class="clearfix"></div>
				-->
				<li><a href="/">Inicio</a></li>
				<?php $session->itemsNavbarTheme(); ?>
			</ul>
		</div>	
		<!-- start search -->
		<div class="search-box">
			<!--
			<div id="sb-search" class="sb-search">
				<form action="javascript:downVideoYT('search-youtube-vid');">
					<input class="sb-search-input" placeholder="Agregar Video Youtube" type="search" name="search" id="search-youtube-vid">
					<input class="sb-search-submit" type="submit" onclick="javascript:downVideoYT('search-youtube-vid');" value="">
					<span class="sb-icon-search"> </span>
				</form>
			</div>-->
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-sm-4 header_right">
		<div id="loginContainer">
			<?php $this->dropdownUserNavbar(); ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>

<?php /*
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
	<a class="navbar-brand mr-1" href="<?php echo path_home; ?>admin/"><?php echo title_sm; ?></a>
	<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
		<i class="fas fa-bars"></i>
	</button>
	<?php $session->itemsNavbarTheme(); ?>
</nav>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
	<a class="navbar-brand mr-1" href="<?php echo path_home; ?>admin/"><?php echo title_sm; ?></a>
	<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
		<i class="fas fa-bars"></i>
	</button>
	<ul class="nav" id="nav">
	<?php $session->itemsNavbarTheme(); ?>
	</ul>
</nav>
*/
?>
