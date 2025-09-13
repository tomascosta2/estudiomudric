<?php

/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= (true === get_theme_mod('display_title_and_tagline', true)) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu('primary') ? ' has-menu' : '';
?>

<div class="sticky top-0 z-50">
	<div class="bg-gradient-to-r flex items-center justify-center gap-8 text-white from-[#132148] to-[#2E50AE] p-2">
		<span>direccion</span>
		<span>direccion</span>
		<span>direccion</span>
	</div>
	<header class="tcp-header max-w-[1110px] mx-auto h-[71px] relative z-50 px-4">
		<div class="max-w-[1200px] mx-auto px-4 xl:px-0">
			<div class="tcp-header__wrapper">
				<button id="menuOpener" class="tcp-header__toggler">
					<svg width="27" height="19" viewBox="0 0 27 19" fill="none" xmlns="http://www.w3.org/2000/svg">
						<line x1="2.50781" y1="1.33105" x2="24.0078" y2="1.33105" stroke="#F5F5F5" stroke-width="2.5" stroke-linecap="round" />
						<line x1="2.50781" y1="9.33105" x2="24.0078" y2="9.33105" stroke="#F5F5F5" stroke-width="2.5" stroke-linecap="round" />
						<line x1="2.50781" y1="17.3311" x2="24.0078" y2="17.3311" stroke="#F5F5F5" stroke-width="2.5" stroke-linecap="round" />
					</svg>
				</button>
				<div class="tcp-header__logo">
					<?php the_custom_logo(); ?>
				</div>
				<?php get_template_part('template-parts/header/site-nav'); ?>
			</div>
		</div>
	</header>
</div>