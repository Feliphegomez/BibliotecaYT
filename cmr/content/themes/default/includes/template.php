<?php
	global $session;
	global $site;
	ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<?php $site->getHeadGlobal(); ?>
		<?php $session->getHeadTheme(); ?>
	</head>
<?php 
	echo "<body id=\"page-top\" class=\"sidebar-toggled\">";
	# echo "<body>";
			$session->getNavbarTheme();
		#$session->getSidebarTheme();
		echo "<div class=\"content_middle\">";
				echo "<div class=\"container\"><br>";
					$session->getBreadcrumbTheme();
				echo "</div>";
				
				echo "<div class=\"container\">";
					$session->getContentRoute();
				echo "</div>";
				$session->getDebugBlock();
		echo "</div>";
		$session->getModalsTheme();
		$session->getFooterTheme();
		$site->getScriptsGlobal();
		$session->getScriptsTheme();
	echo "</body>";
echo "</html>";