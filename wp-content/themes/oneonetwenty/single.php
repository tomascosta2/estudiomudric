<?php 

$related_posts = new WP_Query(
	array(
		'type' => 'post',
		'posts_per_page' => 3
	)
);

get_header(); ?>

<section class="max-w-[1200px] mx-auto py-[20px] px-4">
	<p class="mb-0"><a href="/">Home</a> > <?php echo $post->post_title ?></p>
</section>
<section class="tcp-post__body px-4">
	<div class="max-w-[1200px] mx-auto">
		<h1><?php echo get_the_title(); ?></h1>
		<p class="tcp-post__times">
			<?php echo get_the_date(); ?>
			<i class="fa-solid fa-arrow-right-long"></i>
			<?php echo get_field('tiempo_de_lectura'); ?>
		</p>
		<img class="tcp-post__thumbnail" src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title(); ?>">
		<div class="relative">
			<nav class="tcp-post__share">
				<!-- TODO: Cmabiar img por iconos de fontawesome -->
				<a href=""><img src="/wp-content/themes/rem/assets/images/share-linkedin.svg" alt="Compartir en linkedin"></a>
				<a href=""><img src="/wp-content/themes/rem/assets/images/share-instagram.svg" alt="Compartir en instagram"></a>
				<a href=""><img src="/wp-content/themes/rem/assets/images/share-facebook.svg" alt="Compartir en facebook"></a>
				<a href=""><img src="/wp-content/themes/rem/assets/images/share-twitter.svg" alt="Compartir en twitter"></a>
				<a href=""><img src="/wp-content/themes/rem/assets/images/share-link.svg" alt="Compartir"></a>
			</nav>
			<p class="tcp-post__author"><?php echo get_the_author_meta('display_name', $post->post_author); ?></p>
			<div class="tcp-post__content">
				<?php echo the_content(); ?>
			</div>
		</div>
	</div>
	<div class="tcp-post__related">
		<div class="max-w-[1200px] mx-auto">
			<div class="tcp-post__related-inner">
				<h2>Ultimas publicaciones</h2>
				<div class="tcp-post__related-list">
					<?php
						while ( $related_posts->have_posts() ) {
							$related_posts->the_post();
							echo '<a href="' . get_the_guid() . '" class="tcp-blog__card" style="background-image: url(' . get_the_post_thumbnail_url() . ');">';
							echo 	'<span>' . get_the_category()[0]->name . '</span>';
							echo 	'<p>' . get_the_date() . '</p>';
							echo	'<h4>' . get_the_title() . '</h4>';
							echo '</a>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>