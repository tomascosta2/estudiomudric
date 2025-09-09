<?php 
$posts = new WP_Query(
	array(
		'type' => 'post',
	)
);
$banner = get_field('banner');

get_header(); ?>

<section class="max-w-[1200px] mx-auto py-[10px]">
	<p class="mb-0 py-[10px]"><a href="/">Home</a> > <?php echo $post->post_title ?></p>
</section>
<section class="max-w-[1200px] mx-auto pt-[30px] pb-[100px]">
	<h1 class="font-bold text-4xl text-center mb-10">Blog</h1>
	<div>
		<div class="grid grid-cols-3 gap-[20px]">
			<?php
				while ( $posts->have_posts() ) {
					$posts->the_post();
					echo '<a href="' . get_the_guid() . '" class="flex flex-col justify-end relative h-[280px] bg-cover w-full p-4 rounded-lg" style="background-image: url(' . get_the_post_thumbnail_url() . ');">';
					echo 	'<span class="text-white">' . get_the_category()[0]->name . '</span>';
					echo 	'<p class="text-white">' . get_the_date() . '</p>';
					echo	'<h4 class="font-bold text-2xl text-white">' . get_the_title() . '</h4>';
					echo '</a>';
				}
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>