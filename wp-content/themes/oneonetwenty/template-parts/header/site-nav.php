<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<nav id="menuNav" class="tcp-navigation">
		<div class="flex lg:d-none justify-between items-center">	
			<div class="tcp-navigation__logo">
				<?php the_custom_logo(); ?>
			</div>
			<button id="menuCloser" class="tcp-navigation__closer">
				<svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M11.2511 8.23721L18.8176 0.67074C19.555 -0.0667054 20.7507 -0.0667054 21.4881 0.67074C22.2256 1.40819 22.2256 2.60382 21.4881 3.34127L13.9217 10.9077L21.488 18.4741C22.2255 19.2115 22.2255 20.4072 21.488 21.1446C20.7506 21.8821 19.5549 21.8821 18.8175 21.1446L11.2511 13.5783L3.68461 21.1448C2.94717 21.8822 1.75153 21.8822 1.01409 21.1448C0.276641 20.4073 0.276642 19.2117 1.01409 18.4743L8.5806 10.9077L1.01398 3.34112C0.276536 2.60367 0.276536 1.40803 1.01398 0.670589C1.75143 -0.0668571 2.94706 -0.0668571 3.68451 0.670589L11.2511 8.23721Z" fill="#161318"/>
				</svg>
			</button>
		</div>
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'tcp-navigation__container',
				'items_wrap'      => '<ul class="tcp-navigation__list">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
		?>
	</nav>
	<?php
endif;
